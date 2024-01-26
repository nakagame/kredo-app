<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\User;

class ClassroomController extends Controller
{
    private $classroom;
    private $course;
    private $user;

    public function __construct(Classroom $classroom, Course $course, User $user) {
        $this->classroom = $classroom;
        $this->course    = $course;
        $this->user      = $user;
    }

    public function index() {
        $all_classes = $this->classroom->orderBy('date')->orderBy('start_time')->paginate(8);

        return view('admin.classrooms.index')
                ->with('all_classes', $all_classes);
    }

    public function create() {
        $all_courses = $this->course->all();
        $teachers    = $this->user->where('role_id', 2)->orderBy('name')->get();

        return view('admin.classrooms.create')
                ->with('all_courses', $all_courses)
                ->with('teachers', $teachers);
    }

    public function show() {
        $all_finished_classes = $this->classroom
                                    ->withTrashed()
                                    ->where('deleted_at', '!=', null)
                                    ->orderBy('date')
                                    ->orderBy('start_time')
                                    ->paginate(3);
    
        return view('admin.classrooms.history')
            ->with('all_finished_classes', $all_finished_classes);
    }

    public function store(Request $request) {
        $request->validate([
            'course'     => 'required',
            'teacher'    => 'required',
            'date'       => 'required|date|after_or_equal:today',
            'start_time' => 'required'
        ]);

        $this->classroom->course_id  = $request->course;
        $this->classroom->teacher_id = $request->teacher;
        $this->classroom->date       = $request->date;
        $this->classroom->start_time = $request->start_time;
        $this->classroom->save();

        return redirect()->back()->with('success', 'Class created successfully.');
    }
}
