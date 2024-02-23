<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Plan;
use App\Models\Treatment;
use App\Models\RefTreatment;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application change password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changepassword()
    { 
        $user = User::find(Auth::id());
        $pakage = Plan::all();
        // print_r($user);exit();
        return view('user/changepassword', ['user' => $user,'pakagelist' => $pakage]);
    }

    /**
     * Show the user update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function updatePassword(request $request, $id) {
    //     $user = User::find($id);
    //     if (!(Hash::check($request->current_paswd, Auth::user()->password))) {
    //         // The passwords doesnt match
    //         return response()->json(['result' => false, 'passmatch' => true]);
    //     }
    //     else
    //     {
    //         $data = $request->except('_token');
    //         $user->password     =  Hash::make($request->new_pswrd);
    //         $res = $user->save();
    //         return response()->json(['result' => $res]);
    //     }
    // }

    public function userslist()
    {
        $list = User::join('plans','plans.id','=','users.package')->get(['users.*','plans.plan_name as package']); // Retrieve all records

        return view('user/userslist', ['userslist' => $list]);
    }
    public function userAdd()
    {
        $pakage = Plan::all();
        return view('user/usersadd', ['pakagelist' => $pakage]);
    }

    public function edituserslist($id)
    {
        $pakage = Plan::all();
        $details = User::find($id);
        $hidden = '2';
        return view('user/changepassword', ['user' => $details,'pakagelist' => $pakage,'hidden'=> $hidden]);
    }

    public function deleteuserslist (request $request) {
        $users = User::find($request->usersid);
        $res =$users->delete();
        return response()->json(['result' => $res]);  
    }

    public function adduser(Request $request) {
        $user = new User;
        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->password = Hash::make($request->password);
        $user->roleNo = $request->roleNo;
        $user->package = $request->package;
        
        $res = $user->save();
        
        return response()->json(['result' => $res]);
    }

    public function updatePassword(Request $request, $id) {
        $user = User::find($id);
        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->password = Hash::make($request->password);
        $user->roleNo = $request->roleNo;
        $user->package = $request->package;
        
        $res = $user->save();
        
        return response()->json(['result' => $res]);
    }

}