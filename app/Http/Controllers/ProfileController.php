<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //This means if the the user's id is not equal to the id in the url, they should be redirected back
        if (auth()->user()->id != $id) {
        // abort(403, 'Unauthorized action.');
        return back();
        }

        $user = User::findOrFail($id);
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'role' => 'required',
            'profile_photo' => 'nullable|image|max:2048',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);
        $user = auth()->user();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'bio' => $request->bio,
            'profile_photo' => $request->file('profile_photo') 
                ? $request->file('profile_photo')->store('users', 'public') 
                : $user->profile_photo,
        ]);
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $user = auth()->user();
    
        if (!password_verify($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    
        $user->update(['password' => bcrypt($request->password)]);
    
        return back()->with('success', 'Password updated successfully.');
    }
    

}
