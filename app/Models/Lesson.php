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
    protected $casts = [
        'tests' => 'array'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function chapter() {
        return $this->belongsTo(Chapter::class);
    }
}
