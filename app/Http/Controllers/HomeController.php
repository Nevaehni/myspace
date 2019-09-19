<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relation;
use App\User;
use App\Like;
use Auth;
use DB;

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
    //Home view
    public function index()
    {
        return view('home')->with([
            'relations' => Relation::all(),
            'users' => User::orderBy('first_name')->get()
            ]);
    }   
    //Like/unlike system
    public function likedUser($id)
    {
        //if the liked id is not the same as the logged in user
        if(Auth::id() != $id)
        {
            $inTable = Like::where('liked_user_id', $id)->where('user_id', Auth::id())->get();
            if(count($inTable) == 0 )
            {
                $newLike = new Like;
                $newLike->user_id = Auth::id();
                $newLike->liked_user_id = $id;
                $newLike->save();

                return "You've liked this person";
            }
            else
            {
                Like::where('liked_user_id', $id)->where('user_id', Auth::id())->delete();
                
                return "You've unliked this person";
            }
        }
        else
        {
            return "You can't like yourself";
        }
    }
    
    //Get all users to show in the list
    public function getUser($id)
    {       
        return view('home')->with([
            'relations' => Relation::all(),
            'users' => User::orderBy('first_name')->get(),
            'findUser' => User::find($id),
            'likes' => Like::all(),
        ]);
    }

    public function searchUser(request $request)
    {        
        if($request->searchInput)
        {
            $query = $request->searchInput;
            $data = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%{$query}%")->get();
            $output = '';
            foreach($data as $d)
            {
                $output .= '<li style="list-style: none;"><a style="color:white;"href="'.route('home.getuser', [$d->id]). '">'.$d->first_name.' '.$d->last_name.'</a></li>';
            }           
            return $output;
        }
    }
}
