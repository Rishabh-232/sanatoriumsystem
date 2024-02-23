<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shades;
use Illuminate\Http\Request;
use Auth;

class ShadeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user() && Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3) {
                return $next($request);
            }
             return redirect()->route('home'); // Replace 'home' with the actual route name of your home page
        });
    }

    /**
     * Show the shade list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shadelist()
    {
        $list = Shades::all();
        return view('shades/shadelist', ['shadelist' => $list]);
    }

    public function addShade(Request $request) {
        $shade = new Shades;
        $shade->shade_name                    = $request->shade; 
        $res = $shade->save();
        $lastId = $shade->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    public function shadeview($id)
    {
        $details = Shades::find($id);
        return view('shades/shadeview', ['shadeDetails' => $details]);
    }

    public function shadeedit($id)
    {
        $details = Shades::find($id);
        return view('shades/shadeedit', ['shadeDetails' => $details]);
    }


    public function updateShade(request $request, $id) {
        $shade = Shades::find($id);
        $shade->shade_name                    = $request->shade; 
        $res = $shade->save();
        return response()->json(['result' => $res]);
    }

    public function deleteshadedata(request $request) {
        $shade = Shades::find($request->shadeid);
        $res =$shade->delete();
        return response()->json(['result' => $res]);  
    }
   
}