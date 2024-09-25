<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        return User::all()->reverse();
    }

    /**
     * Show the form for creating a new resource.
     */
    public static function create($email, $mailing = 0, $how, $role = null, $name = null, $password = null)
    {
        switch ($how) {
            case 'guest':
                $user = new User([
                    'email' => $email,
                    'mailing' => $mailing,
                ]);
                return $user->saveOrFail();
            case 'full':
                break;
        }
    }

    public static function change()
    {
       User::updateOrCreate();
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
