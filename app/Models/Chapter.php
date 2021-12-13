<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
//    protected $appends = ['classRoom'];
//    public function getClassRoomAttribute()
//    {
//        return $this->classRooms();
//    }

    public function classRooms()
    {
        return $this->belongsTo(ClassRoom::class);
    }




}
