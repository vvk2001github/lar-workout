@servers(['lar' => ['-i ~/.ssh/deploy_kulyaginv -p 2022 deployer@kulyaginv.ru']])

@setup
	$releaseRotate = 5;
    $timezone = 'Europe/Moscow';
    $date = new datetime('now', new DateTimeZone($timezone));
	$gitBranch = 'main';
	$gitRepository = 'git@github.com:vvk2001github/lar-workout.git';
	$dirBase = '/srv/nginx/lar-workout';
	$dirShared = $dirBase . '/shared';
    $dirCurrent = $dirBase . '/current';
    $dirReleases = $dirBase . '/releases';
    $dirCurrentRelease = $dirReleases . '/' . $date->format('YmdHis');
@endsetup

@task('gitclone', ['on' => 'lar'])
	echo "# Gitclone task"
	
	mkdir -p {{$dirCurrentRelease}}
    git clone --depth 1 -b {{$gitBranch}} {{$gitRepository}} {{$dirCurrentRelease}}

    echo "# Repository has been cloned"
@endtask

@task('composer', ['on' => 'lar'])
    echo "# Composer task"

    cd {{$dirCurrentRelease}}
    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader

    echo "# Composer dependencies have been installed"
@endtask

@task('npm', ['on' => 'lar'])
    echo "# Npm task"

    cd {{$dirCurrentRelease}}
    npm install -only=production
    #npm audit fix
    #npm run dev

    echo "# Npm dependencies have been installed"
@endtask

@task('config_project', ['on' => 'lar'])
    echo "# Config project task";

    echo "# Linking storage directory";
    rm -rf {{$dirCurrentRelease}}/storage/app;
    cd {{$dirCurrentRelease}};
    ln -nfs {{$dirShared}}/storage/app storage/app;
    php artisan storage:link

    echo "# Linking .env file";
    cd {{$dirCurrentRelease}};
    ln -nfs {{$dirBase}}/.env .env;

    chgrp -R www-data {{$dirShared}};
    chgrp -R www-data {{$dirCurrentRelease}};
    chmod -R ug+rwx {{$dirShared}};
    chmod -R ug+rwx {{$dirCurrentRelease}};

    echo "# Optimising installation";
    php artisan clear-compiled --env={{$env}};
    php artisan optimize --env={{$env}};
    php artisan config:cache --env={{$env}};
    php artisan cache:clear --env={{$env}};
@endtask

@task('set_current', ['on' => 'lar'])
    echo '# Linking current release';
    ln -nfs {{$dirCurrentRelease}} {{$dirCurrent}};
@endtask

@task('releases_clean', ['on' => 'lar'])
    purging=$(ls -dt {{$dirReleases}}/* | tail -n +{{$releaseRotate}});

    if [ "$purging" != "" ]; then
        echo "# Purging old releases: $purging;"
        rm -rf $purging;
    else
        echo "# No releases found for purging at this time";
    fi
@endtask

@story('deploy')
    gitclone
    composer
	npm
	config_project
	set_current
	releases_clean
@endstory