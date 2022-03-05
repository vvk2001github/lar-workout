<?php $env = isset($env) ? $env : null; ?>
<?php $dirCurrentRelease = isset($dirCurrentRelease) ? $dirCurrentRelease : null; ?>
<?php $dirReleases = isset($dirReleases) ? $dirReleases : null; ?>
<?php $dirCurrent = isset($dirCurrent) ? $dirCurrent : null; ?>
<?php $dirShared = isset($dirShared) ? $dirShared : null; ?>
<?php $dirBase = isset($dirBase) ? $dirBase : null; ?>
<?php $gitRepository = isset($gitRepository) ? $gitRepository : null; ?>
<?php $gitBranch = isset($gitBranch) ? $gitBranch : null; ?>
<?php $date = isset($date) ? $date : null; ?>
<?php $timezone = isset($timezone) ? $timezone : null; ?>
<?php $releaseRotate = isset($releaseRotate) ? $releaseRotate : null; ?>
<?php $__container->servers(['lar' => ['-i ~/.ssh/deploy_kulyaginv -p 2022 deployer@kulyaginv.ru']]); ?>

<?php
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
?>

<?php $__container->startTask('gitclone', ['on' => 'lar']); ?>
	echo "# Gitclone task"
	
	mkdir -p <?php echo $dirCurrentRelease; ?>

    git clone --depth 1 -b <?php echo $gitBranch; ?> <?php echo $gitRepository; ?> <?php echo $dirCurrentRelease; ?>


    echo "# Repository has been cloned"
<?php $__container->endTask(); ?>

<?php $__container->startTask('composer', ['on' => 'lar']); ?>
    echo "# Composer task"

    cd <?php echo $dirCurrentRelease; ?>

    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader

    echo "# Composer dependencies have been installed"
<?php $__container->endTask(); ?>

<?php $__container->startTask('npm', ['on' => 'lar']); ?>
    echo "# Npm task"

    cd <?php echo $dirCurrentRelease; ?>

    npm install -only=production
    npm audit fix
    npm run dev

    echo "# Npm dependencies have been installed"
<?php $__container->endTask(); ?>

<?php $__container->startTask('config_project', ['on' => 'lar']]); ?>
    echo "# Config project task";

    echo "# Linking storage directory";
    rm -rf <?php echo $dirCurrentRelease; ?>/storage/app;
    cd <?php echo $dirCurrentRelease; ?>;
    ln -nfs <?php echo $dirShared; ?>/storage/app storage/app;
    php artisan storage:link

    echo "# Linking .env file";
    cd <?php echo $dirCurrentRelease; ?>;
    ln -nfs <?php echo $dirBase; ?>/.env .env;

    chgrp -R www-data <?php echo $dirShared; ?>;
    chgrp -R www-data <?php echo $dirCurrentRelease; ?>;
    chmod -R ug+rwx <?php echo $dirShared; ?>;
    chmod -R ug+rwx <?php echo $dirCurrentRelease; ?>;

    echo "# Optimising installation";
    php artisan clear-compiled --env=<?php echo $env; ?>;
    php artisan optimize --env=<?php echo $env; ?>;
    php artisan config:cache --env=<?php echo $env; ?>;
    php artisan cache:clear --env=<?php echo $env; ?>;
<?php $__container->endTask(); ?>

<?php $__container->startMacro('deploy'); ?>
    gitclone
    composer
	npm
	config_project
<?php $__container->endMacro(); ?>