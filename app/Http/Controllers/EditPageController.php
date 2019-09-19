<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Relation;
use Auth;
use Hash;

class EditPageController extends Controller
{
    //return the edit view
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
        //Validate request
        $request->validate([      
            'imageUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',  
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'relation' => ['required', 'integer', 'max:1'],
            'housenumber' => ['required', 'string', 'max:255'],
            'streetname' => ['required', 'string', 'max:255'],
            'housenumbersuffix' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'relation' => ['required', 'integer', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
            'password' => ['required', 'string', 'min:8']
        ]); 
            
        $user = Auth::user();
            
        //Check if password matches if not throw error
        if (!Hash::check($request->password, $user->password))
        {
            // $error = \Illuminate\Validation\ValidationException::withMessages([
            //     'password' => ['Password mismatch']
            // ]);

            // throw $error;
            return redirect()->back()->with('error', 'Password mismatch');
        }

        //Image upload
        if($request->hasFile('imageUpload'))
        {       
            $currentUser = Auth::user();
            $imageSize = $request->file('imageUpload')->getSize();
            $defaultImageName =  $request->file('imageUpload')->getClientOriginalName();
            $defaultPath = public_path('/images/users/');
            
            //Check if the user is uploading the same file.
            if($imageSize != $currentUser->image_size && $defaultImageName != $currentUser->image_original_name)
            {
                $image = $request->file('imageUpload');
                $imageName = time().Auth::id().'.'.$image->getClientOriginalExtension();                            
                $image->move($defaultPath, $imageName);
            }    
            //Check if the file still exists, if not upload the file. 
            else if(!is_file($defaultPath.date_format($currentUser->updated_at, 'U').$currentUser->id.'.'.$request->file('imageUpload')->getClientOriginalExtension()))
            {
                $image = $request->file('imageUpload');
                $imageName = time().Auth::id().'.'.$image->getClientOriginalExtension();                            
                $image->move($defaultPath, $imageName);
            }

            $user->image = $imageName;
            $user->image_size = $imageSize;
            $user->image_original_name = $defaultImageName;
        }         
        
        //Save data
        $user->first_name = $request->first_name;      
        $user->last_name = $request->last_name;      
        $user->username = $request->username;      
        $user->relation = $request->relation;      
        $user->streetname = $request->streetname;      
        $user->housenumbersuffix = $request->housenumbersuffix;      
        $user->zipcode = $request->zipcode;      
        $user->relation = $request->relation;      
        $user->email = $request->email;  
        $user->save();
           
        return redirect()->back()->with('success', 'updated successfully.');
    }
}
