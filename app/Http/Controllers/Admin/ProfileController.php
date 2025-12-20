<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function dashboard(){
        $admin = Auth::guard('admin')->user();
        //return view('admin.dashboard', compact('admin'));
        return view('admin.students.index', compact('admin'));
    }

    public function profile(){
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function edit(){
        $admin = Auth::guard('admin')->user();
        return view('admin.edit_profile', compact('admin'));
    }

    public function update(Request $request){
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        if($request->password){
            $admin->password = Hash::make($request->password);
        }


        //if($request->hasFile('photo')){
           // $file = $request->file('photo');
            //$path = $file->store('admins','public');
            //$admin->photo = $path;
        //}
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pictures'), $filename);
            $admin->photo = 'uploads/profile_pictures/' . $filename;
        }


        $admin->save();

        return redirect()->route('admin.profile')->with('success','Profile updated successfully!');
    }
}