<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseCountroller extends Controller
{
    public function all()
    {
        return view("admin.courses.index");
    }

    public function save($locale, $id)
    {
        $course = null;

        if ($id != 0) {
            $course = Course::with("category")->find($id);

            if (!$course) {
                return redirect()->route("admin.courses.index")
                    ->with("error", __("messages.course_no_found"));
            }
        }

        return view("admin.courses.save", compact("course"));
    }
}
