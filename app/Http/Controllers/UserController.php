<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return "List of users";
    }
    public function create()
    {
        return view() -> make('users.create');
    }
     public function store(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        return "User created";
    }
    public function edit($id)
    {
        return "Edit user form with id: $id";
    }
    public function show($id)
    {
        return "User with id: $id";
    }
    public function update(Request $request, $id)
    {
        return "User with id: $id updated";
    }
    public function destroy($id)
    {
        return "User with id: $id deleted";
    }
}

