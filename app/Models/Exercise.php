<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercises';
    protected $primaryKey = 'ex_id';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workouts() {
        return $this->hasMany(Workout::class, 'ex_id', 'ex_id');
    }

    //protected $hidden = ['user_id'];
}
