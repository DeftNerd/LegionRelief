<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{

	/**
	 * Display a user profile
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
    public function show($id)
    {
    	$user = User::findBySlugOrIdOrFail($id);
        return view('users.show')->with('user', $user);
    }

    /**
     * Display a user's submitted legionnaires
     * @return [type] [description]
     */
    public function legionnaires($username)
    {
    	$user = User::findBySlug($username);
        $legionnaires = $user->legionnaires()->withUnapproved()->orderBy('created_at', 'desc')->paginate();
        return view('users.legionnaires')
        	->withUser($user)
        	->withLegionnaires($legionnaires);
    }

    /**
     * Display a user's starred legionnaires
     * @return [type] [description]
     */
    public function stars($username)
    {
    	$user = User::findBySlug($username);
    	$legionnaires = $user->stars()->withUnapproved()->orderBy('created_at', 'desc')->paginate();
        return view('users.stars')
        	->withUser($user)
        	->withLegionnaires($legionnaires);

    }

}
