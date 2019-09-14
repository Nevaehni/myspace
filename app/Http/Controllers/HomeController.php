<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relation;
use App\User;
use App\Like;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            'relations' => Relation::all(),
            'users' => User::orderBy('first_name')->get()
            ]);
    }   

    public function likedUser($id)
    {
        if(Auth::id() != $id)
        {
            $inTable = Like::where('liked_user_id', $id)->where('user_id', Auth::id())->get();
            if(count($inTable) == 0 )
            {
                $newLike = new Like;
                $newLike->user_id = Auth::id();
                $newLike->liked_user_id = $id;
                $newLike->save();

                return 'liked';
            }
            else
            {
                Like::where('liked_user_id', $id)->where('user_id', Auth::id())->delete();
                return 'unliked';
            }
        }
        else
        {
            return 'you cant like yourself';
        }
    }
    
    public function getUser($id)
    {       
        return view('home')->with([
            'relations' => Relation::all(),
            'users' => User::orderBy('first_name')->get(),
            'findUser' => User::find($id),
            'likes' => Like::all(),
        ]);
    }
}
