<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Unit;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function index () {
        $data = [];
        $data['classroom'] = ClassRoom::all();
        $data['chapter'] = Chapter::all();
        $data['subject'] = Subject::all();
        $data['unit'] = Unit::all();

        return $this->response($data);
    }
}
