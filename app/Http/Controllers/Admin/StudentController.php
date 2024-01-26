<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StudentController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index() {
        $students = $this->user->withTrashed()->where('role_id', 3)->orderBy('name')->paginate(6);

        return view('admin.students.index')->with('students', $students);
    }

    public function create() {
        return view('admin.students.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'             => 'required|min:1|max:255',
            'email'            => 'required|min:1|max:255|email|unique:users,email,',
            'password'         => 'required|min:8|max:255',
            'confirm_password' => 'required|same:password'
        ]);

        if($request->password !== $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'The password and confirm password must match.']);
        }

        $this->user->name     = $request->name;
        $this->user->email    = $request->email;
        $this->user->password = Hash::make($request->password);
        $this->user->role_id  = 3;
        $this->user->save();

        return redirect()->back()->with('success', 'Student created successfully.');
    }

    public function inactive($id) {
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();  
    }

    public function deactive($id) {
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function search(Request $request) {
        $users = $this->user->withTrashed()
                            ->where('role_id', 3)
                            ->where('name', 'like', '%'. $request->search. '%')
                            ->paginate(5);

        return view('admin.students.search')
                ->with('users', $users)
                ->with('search', $request->search); 
    }
}
