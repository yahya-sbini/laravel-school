<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
//    protected $with = ['units', 'classRooms', 'subjects', 'chapters'];
   /* protected $casts = [
        'tests' => 'array'
    ];*/

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

}
