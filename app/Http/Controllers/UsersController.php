<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('data', User::all());
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';

        $user->save();

        session()->flash('success', 'Berhasil Mengubah Role');

        return redirect(route('users.index'));
    }

    public function edit()
    {
        return view('users.edit')->with('data', auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $users = auth()->user();

        $users->update([
            'name' => $request->name,
            'about' => $request->about
        ]);

        session()->flash('success', 'Berhasil Menyimpan Perubahan');

        return redirect()->back();
    }
}
