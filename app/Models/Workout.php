<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function exercise() {
        return $this->belongsTo(Exercise::class, 'ex_id', 'ex_id');
}
}
