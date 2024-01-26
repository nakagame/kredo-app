<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;


class StudentsController extends Controller
{
    private $classroom;

    public function __construct(Classroom $classroom) {
        $this->classroom = $classroom;
    }

    public function index() {
        $my_classes        = $this->classroom
                                ->where('student_id', Auth::user()->id)
                                ->orderBy('date')
                                ->orderBy('start_time')
                                ->paginate(4, ['*'], 'my_classes');

        $available_classes = $this->classroom
                                  ->whereNull('student_id')
                                  ->orderBy('date')
                                  ->orderBy('start_time')
                                  ->paginate(4, ['*'], 'available_classes');

        return view('students.index')
                ->with('my_classes', $my_classes)
                ->with('available_classes', $available_classes);
    }

    public function show() {
        $my_finished_classes = $this->classroom
                                    ->withTrashed()
                                    ->where('student_id', Auth::user()->id)
                                    ->where('deleted_at', '!=', null)
                                    ->orderBy('date')
                                    ->orderBy('start_time')
                                    ->paginate(7);

        return view('students.history')
                ->with('my_finished_classes', $my_finished_classes);
    }
    

    public function update($id) {
        $class = $this->classroom->findOrFail($id);

        $class->student_id = Auth::user()->id;
        $class->save();

        return redirect()->back();
    }

    public function cancel($id) {
        $class = $this->classroom->findOrFail($id);
        
        $class->student_id = null;
        $class->save();

        return redirect()->back();
    }
}
