<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;

class TeachersController extends Controller
{
    private $classroom;

    public function __construct(Classroom $classroom) {
        $this->classroom = $classroom;
    }

    public function index() {
        $my_classes = $this->classroom
                        ->where('teacher_id', Auth::user()->id)
                        ->where('student_id', '!=', null)
                        ->orderBy('date')
                        ->orderBy('start_time')
                        ->paginate(4, ['*'], 'my_classes_page');

$vacant_classes = $this->classroom
                    ->where('teacher_id', Auth::user()->id)
                    ->orderBy('date')
                    ->orderBy('start_time')
                    ->whereNull('student_id')
                    ->paginate(4, ['*'], 'vacant_classes_page');

        return view('teachers.index')
                ->with('my_classes', $my_classes)
                ->with('vacant_classes', $vacant_classes);
    }

    public function show() {
        $my_finished_classes = $this->classroom
                                    ->withTrashed()
                                    ->where('teacher_id', Auth::user()->id)
                                    ->where('deleted_at', '!=', null)
                                    ->orderBy('date')
                                    ->orderBy('start_time')
                                    ->paginate(7);
        return view('teachers.history')->with('my_finished_classes', $my_finished_classes);
    }

    public function revertClass($id) {
        $this->classroom->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    public function destroy($id) {
        $this->classroom->destroy($id);

        return redirect()->back();
    }
}
