<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    private $course;

    public function __construct(Course $course) {
        $this->course = $course;
    }

    public function index() {
        $all_courses = $this->course->withTrashed()->paginate(5);

        return view('admin.courses.index')->with('all_courses', $all_courses);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:1|max:255|unique:courses,title,'
        ]);

        $this->course->title = $request->title;
        $this->course->save();

        return redirect()->back()->with('success', 'New Course created successfully.');
    }

    public function show($id) {
        $this->course->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();  
    }

    public function hide($id) {
        $this->course->destroy($id);
        return redirect()->back();
    }
}
