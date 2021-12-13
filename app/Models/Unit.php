<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
//    protected $appends = ['subject'];
//    public function getSubjectAttribute()
//    {
//        return $this->chapters();
//    }
    public function subjects() {
        return $this->belongsTo(Subject::class);
    }

}
