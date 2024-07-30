<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Create a new user
     */
    public static function create($purpose, $email)
    {
        switch ($purpose) {
            case 'mail':
                User::createOrFirst([
                    'mailing' => true,
                    'email' => $email,
                ]);
        }
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
    public function show(User $user)
    {
        //
    }

    /**
     * Search the specified resource.
     * @return boolean
     */
    public static function search($email, $id = null)
    {
        $users = User::where('email', 'like', '%' . $email . '%')->limit(1)->get();
        foreach ($users as $user) {
            switch ($user->email == $email) {
                case true:
                    return true;
                case false:
                    return false;
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
