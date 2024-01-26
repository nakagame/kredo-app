<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $role_id = Auth::user()->role_id;

        if($role_id === User::ADMIN_ROLE_ID) {
            return redirect()->route('admin.classroom');
        } elseif($role_id === User::TEACHER_ROLE_ID) {
            return redirect()->route('teacher.index');
        } elseif($role_id === User::STUDENT_ROLE_ID) {
            return redirect()->route('student.index');
        } 
        
        return view('home');
    }

    public function show() {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('profile')->with('user', $user);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:255',
            'email' => 'required|min:1|max:255|email|unique:users,email,'. Auth::user()->id,
            'avatar' => 'max:1048|mimes:png,jpg,jpeg,gif',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = $this->user->findOrFail(Auth::user()->id);
        
        $user->name  = $request->name;
        $user->email = $request->email;
        
        if($request->avatar) {
            $user->avatar = 'data:image'. $request->avatar->extension(). ';base64,'. base64_encode(file_get_contents($request->avatar));
        }
        $user->save();
    
        return redirect()->back();
    }
}
