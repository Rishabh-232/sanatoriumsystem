<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Lab;
use App\Models\TOW;
use App\Models\Note;
use Illuminate\Http\Request;
use Auth;

class NoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user() && Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4) {
                return $next($request);
            }
            return redirect()->route('home'); // Replace 'home' with the actual route name of your home page
        });
    }

    /**
     * Show the note list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function notelist()
    {
        $list = Note::all();
        return view('note/notelist', ['notelist' => $list]);
    }

    public function noteadd()
    {
        return view('note/noteadd');
    }

    public function addNote(Request $request) {
        $note = new Note;
        $note->note                    = $request->note; 
        // $note->created_at              = $request->created_at; 
        $res = $note->save();
        $lastId = $note->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    public function noteview($id)
    {
        $details = Note::find($id);
        return view('note/noteview', ['noteDetails' => $details]);
    }

    public function noteedit($id)
    {
        $details = Note::find($id);
        return view('note/noteedit', ['noteDetails' => $details]);
    }


    public function updateNote(request $request, $id) {
        $note = Note::find($id);

        $note->note             = $request->note; 
        $res = $note->save();
        return response()->json(['result' => $res]);
    }

    public function deletenotedata(request $request) {
        $note = Note::find($request->noteid);
        $res =$note->delete();
        return response()->json(['result' => $res]);  
    }
   
}