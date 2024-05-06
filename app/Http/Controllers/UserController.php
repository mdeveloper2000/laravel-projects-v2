<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function create() {
        if(auth()->user() === null) {
            return view("users.register");
        }
        return redirect("/dashboards/index");
    }

    public function login() {
        if(auth()->user() === null) {
            return view("users.login");
        }
        return redirect("/dashboards/index");
    }

    public function authenticate(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        if(auth()->attempt($data)) {            
            $request->session()->regenerate();
            return redirect('/dashboards/index');
        }
        else {
            return back()->withInput()->with('error', 'E-mail and/or password incorrect');
        }        
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']            
        ]);
        $data['password'] = bcrypt($data['password']);
        if($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $user = User::create($data);
        auth()->login($user);
        return redirect('/users/login');
    }

    public function edit($id) {
        $user = User::select('id', 'name', 'photo')->where('id', $id)->where('id', auth()->user()->id)->first();
        if($user !== null) {            
            return view('users.edit', ['user' => $user]);
        }
        else {
            return redirect()->back();
        }
    }

    public function update(Request $request) {
        $user = User::select('id', 'name', 'photo')->where('id', $request->user_id)->where('id', auth()->user()->id)->first();
        if($user !== null) {
            $data = $request->validate([
                'name' => ['required', 'min:3']
            ]);
            if($request->hasFile('photo')) {
                if($user->photo !== null) {
                    if(Storage::disk('public')->exists($user->photo)) {
                        Storage::delete('public/'.$user->photo);
                    }
                    $data['photo'] = $request->file('photo')->store('uploads', 'public');
                }
                else {
                    $data['photo'] = $request->file('photo')->store('uploads', 'public');
                }
            }
            $user->update($data);
            return redirect('/dashboards/index');
        }
        else {
            return redirect()->back();
        }
        
    }

    public function settings() {        
        return view('users.settings');
    }

    public function password(Request $request) {
        $data = $request->validate([
            'password' => ['required', 'confirmed', 'min:6']            
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::where('id', auth()->user()->id);
        $user->update($data);
        return redirect('/dashboards/index');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/users/login');
    }

}
