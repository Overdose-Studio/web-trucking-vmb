<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Index: show all users
    public function index()
    {
        $users = User::all()->sortBy('name');
        return view('admin.user.index', compact('users'));
    }

    // Create: show the form to create new user
    public function create()
    {
        return view('admin.user.create');
    }

    // Store: when user submit the form to create new user
    public function store(Request $request)
    {
        // Validate the form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required'
        ]);

        // Create new user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        // Redirect to user index
        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    // Edit: show the form to edit user
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    // Update: when user submit the form to edit user
    public function update(Request $request, $id)
    {
        // Validate the form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'role' => 'required'
        ]);

        // Update user
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        // Redirect to user index
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    // Delete: when user want to delete user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        // Redirect to user index
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
