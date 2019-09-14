<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Relation;

class EditPageController extends Controller
{
    public function profileindex()
    {
        if(Auth::user() != null)
        {
            return view('editProfile')->with([
                'relations' => Relation::all()
                ]);
        }
        else
        {
            return redirect()->route('home');

        }
        
    }

    public function updateUser(request $request)
    {
        $user = Auth::user();
        $user->first_name = $request->first_name;
        // $user->save();

        dd('maak je EditPageController af');

           
    }
}
