<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $users = User::where('email', "!=", auth()->user()->email)->get();
        $roles = Role::all();
        return view("admin.index", compact(["users", "roles"]));
    }

    public function create() {
        $roles = Role::all();
        return view("admin.create", compact(["roles"]));
    }

    public function store(Request $request){
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required",
            "role_id" => "required|integer",
        ]);
        User::firstOrCreate([
            "name" => $data["name"],
            "email" => $data['email'],
        ], [
            "name" => $data['name'],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
            "role_id" => $data["role_id"],
        ]);
        return redirect()->route('admin');
    }

    public function edit(User $user) {
        $roles = Role::all();
        return view('admin.edit', compact(['user', 'roles']));
    }

    public function update(Request $request, User $user) {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required",
            "role_id" => "integer",
        ]);
        $user->update([
            "name" => $data['name'],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
            "role_id" => $data["role_id"],
        ]);
        return redirect()->route('admin');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->back();
    }

    public function ban(User $user){
        $user->update([
            "isbanned" => !$user->isbanned
        ]);
        return redirect()->back();
    }
}
