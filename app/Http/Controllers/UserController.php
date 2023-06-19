<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        if ( $request->expectsJson())
        return response()->json($users);
        return view('users.index', compact('users'));

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if (!$request->role) {
            $user->role = 'Viewer';
        }else{

            $user->role = $request->role;
        }
        $user->save();
        if ( $request->expectsJson())
        return response()->json($user);


        return redirect()->route('users.index');
    }

    public function show(Request $request,string $id)
    {

        $users=User::findOrFail($id);
        if ( $request->expectsJson())
        return response()->json($users);
        return view('users.show', compact('user'));

    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user=User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role =$request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        if ( $request->expectsJson())
        return response()->json($user);
        return redirect()->route('users.index');
    }

    public function destroy(Request $request,string $id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        if ( $request->expectsJson())
        return response()->json("deleted sucssfully");
        return redirect()->route('users.index');
    }
}
