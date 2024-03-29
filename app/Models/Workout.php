<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static whereRelation(string $string, string $string1, string $string2, $id)
 * @method static findOrFail(mixed $input)
 * @property mixed $ex_id
 * @property mixed $count1
 * @property mixed $count2
 * @property mixed $weight1
 * @property mixed $weight2
 */
class Workout extends Model
{
    use HasFactory;

    protected $table = 'workouts';
    protected $primaryKey = 'w_id';

    protected $attributes = [
        'weight1' => 0,
        'weight2' => 0,
        'count1' => 0,
        'count2' => 0,
    ];

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class, 'ex_id', 'ex_id');
}
}
