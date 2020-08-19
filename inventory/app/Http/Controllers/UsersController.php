<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {   
        $page = 'users';
        $search = $request->get('search');
        $users = User::where('username', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->orWhere('role', 'LIKE', '%' . $search . '%')->paginate(5);
        return view('users.index', compact('users', 'page'));
    }
    
    public function index()
    {   
        $page = 'users';
        $users = User::orderBy('id', 'DESC')->get();
        return view('users.index', compact('users', 'page'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'users';
        return view('users.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'role' => 'required|string',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('rahasia'.$request->role),
        ]);
        
        return redirect('/users')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $page = "users";
        return view('users.show', compact('user', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        $page = "Users";
        return view('users.edit', compact('user', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'role' => 'required|string',
        ]);

        User::where('id', $user->id)
        ->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect('/users')->with('update', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/users')->with('delete', ' Data berhasil dihapus');
    }
}
