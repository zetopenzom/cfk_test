<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'Admin') {
            abort(403);
        }

        $users = User::whereNot('role', 'Admin')->latest('updated_at')->paginate(3);

        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        if (Auth::user()->role != 'Admin') {
            abort(403);
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $n = $request->name;
        $p = Hash::make($request->password);
        $e = $request->email;
        $r = $request->role;
        $d = date("Y-m-d H:i:s");

        DB::select("INSERT INTO users (name, password, email, role, remember_token, created_at, updated_at) VALUES ('$n', '$p', '$e', '$r', NULL, '$d', '$d')");

        return to_route('users.index')->with('success', 'User has been added');;
    }

    public function edit(User $user)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403);
        }

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $n = $request->name;
        $e = $request->email;
        $r = $request->role;
        $d = date("Y-m-d H:i:s");

        DB::select("UPDATE users SET name='$n', email='$e', role='$r', updated_at='$d' WHERE id='$user->id'");

        return to_route('users.index', $user)->with('success', 'Perubahan disimpan');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403);
        }

        $user->delete();

        return to_route('users.index')->with('success', 'Pengguna dihapus');
    }
}
