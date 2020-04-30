<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Complaint;
use DB;

class ComplaintsController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::orderBy('created_at','desc')->paginate(10);
        return view('complaints.index')->with('complaints', $complaints);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        // Create Complaint
        $complaint = new Complaint;
        $complaint->title = $request->input('title');
        $complaint->description = $request->input('description');
        $complaint->user_id = auth()->user()->id;
        $complaint->save();

        return redirect('/complaints')->with('success', 'Complaint Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaint = Complaint::find($id);
        return view('complaints.show')->with('complaint',$complaint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaint = Complaint::find($id);
        
        //Check if complaint exists before deleting
        if (!isset($complaint)){
            return redirect('/complaints')->with('error', 'No Complaint Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$complaint->user_id){
            return redirect('/complaints')->with('error', 'Unauthorized Page');
        }

        return view('complaints.edit')->with('complaint', $complaint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
		$complaint = Complaint::find($id);

        // Update Complaint
        $complaint->title = $request->input('title');
        $complaint->description = $request->input('description');
        $complaint->save();

        return redirect('/complaints')->with('success', 'Complaint Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = Complaint::find($id);
        
        //Check if complaint exists before deleting
        if (!isset($complaint)){
            return redirect('/complaints')->with('error', 'No Complaint Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$complaint->user_id){
            return redirect('/complaints')->with('error', 'Unauthorized Page');
        }
        
        $complaint->delete();
        return redirect('/complaints')->with('success', 'Complaint Deleted');
    }
}
