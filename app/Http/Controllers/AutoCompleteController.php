<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    function fetch(Request $request)
    {
        dd($request);
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = User::select('first_name', 'last_name')
            ->where('first_name', 'LIKE', "%{$query}%")
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                <li><a href="#">'.$row->country_name.'</a></li>';
            }
            $output .= '</ul>';
            return $output;
        }

        // $data = Company::select("name", "slug")
        //         ->where("name","LIKE","%{$request->input('query')}%")
        //         ->get();

		// return response()->json($data);
    }
}
