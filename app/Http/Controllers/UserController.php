<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendWelcomeEmail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(12);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'profile_photo' => 'required|image|max:2048',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => true,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
            'profile_photo' => $request->file('profile_photo') ? $request->file('profile_photo')->store('users', 'public') : null,

        ]);
        event(new Registered($user));
        // SendWelcomeEmail::dispatch($user);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string',
            'is_active' => 'required|string',
            'date_of_birth'=> 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active'=> $request->is_active,
            'date_of_birth'=> $request->date_of_birth,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'profile_photo' => $request->file('profile_photo') ? $request->file('profile_photo')->store('users', 'public') : $user->profile_photo,
        ]);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function lock(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->is_active) {
            $user->is_active = false;
            $user->save();
            return back()->with('success', 'User locked successfully.');
        } else {
            $user->is_active = true;
            $user->save();
            return back()->with('success', 'User unlocked successfully.');
        }
    }

    public function change_password(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', $user->name. "'s". ' Password changed successfully.');
    }

}
