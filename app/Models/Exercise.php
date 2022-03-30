<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer user_id;
 * @property string ex_descr;
 * @property integer ex_type;
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static findOrFail(mixed $input)
 */
class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercises';
    protected $primaryKey = 'ex_id';
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class, 'ex_id', 'ex_id');
    }

    //protected $hidden = ['user_id'];
}
