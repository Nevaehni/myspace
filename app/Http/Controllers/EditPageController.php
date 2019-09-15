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
        // $yes = $request->validate([      
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',  
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255'],
        //     'relation' => ['required', 'integer', 'max:1'],
        //     'housenumber' => ['required', 'string', 'max:255'],
        //     'streetname' => ['required', 'string', 'max:255'],
        //     'housenumbersuffix' => ['required', 'string', 'max:255'],
        //     'zipcode' => ['required', 'string', 'max:255'],
        //     'relation' => ['required', 'integer', 'max:20'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
        // ]);     

        // $image = explode(".", $image_icon);
        // $image_name = $image[0];
        // $image_extension = array_slice($image , -1, 1);

        // $data['image'] = $image_name.time().'.'.$image_extension[0];
            
        dd('fix image upload');
        $user = Auth::user();
        $user->first_name = $request->first_name;      
        $user->last_name = $request->last_name;      
        $user->username = $request->username;      
        $user->relation = $request->relation;      
        $user->streetname = $request->streetname;      
        $user->housenumbersuffix = $request->housenumbersuffix;      
        $user->zipcode = $request->zipcode;      
        $user->relation = $request->relation;      
        $user->email = $request->email;      
        // $user->save();
           
        // return redirect()->back();
    }
}
