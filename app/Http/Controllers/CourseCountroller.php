<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseCountroller extends Controller
{
    public function all()
    {
        $coursesCount = Course::count();
        
        return view("admin.courses.index", compact("coursesCount"));
    }
}
