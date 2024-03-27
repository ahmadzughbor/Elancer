<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\project;
use App\Models\Proposal;
use App\Notifications\NewProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        $proposals =  $user->proposals()->with('project')->latest()->paginate();
        return view('freelancer.proposals.index', [
            'proposals'=>  $proposals,
            'projects'=> project::all(),
        ]);

    }
    public function received()
    {
        $user = Auth::guard('web')->user();
        // $proposals =  $user->with('projects.proposals')->paginate();
        $projects = project::Where('user_id',$user->id)->with('proposals')->paginate();
        // $proposals =  $user->proposals()->with('project')->latest()->paginate();
        return view('freelancer.proposals.receivedProp', [
            // 'proposals'=>  $proposals,
            'projects'=> $projects,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ( project $project )
    {
        return view('freelancer.proposals.create', [
            'proposal'=> new Proposal(),
            'project'=> $project,
            'units'=>Proposal::units(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$project_id)
    {
        $project =  project::findOrFail($project_id);
        
        // dd($project);
        if($project->status != 'open'){
            return  redirect()->route('freelancer.proposals.index')->with('error','you can not submit prposal to this porject');
        }
        $user= Auth::guard('web')->user();
        // if( $user->proposedProjects->find($project->id)){
        //     return  redirect()->route('freelancer.proposals.index')->with('error','you already submitted prposal to this porject');
        // }
        // dd($project);
        $validatedData  = $request->validate([
            'description' => ['required','string'],
            'cost' =>['required','numeric','min:1'],
            'duration' =>['required','int','min:1'],
            'duration_unit' =>['required','in:day,month,week,year'],
        ]);
    
        //dd($project);
        $validatedData['project_id' ]= $project_id;

        
        $proposal = $user->proposals()->updateOrCreate($validatedData);
        $project->user->notify(new NewProposalNotification($proposal,$user));
        $admins  = Admin::all();
        Notification::send($admins,new NewProposalNotification($proposal,$user));
        
        return redirect()->route('Home')->with('success',' your proposal has been submitted');
        // return redirect()->route('client.projects.show',$project->id )
        // ->with('success',' your proposal has been submitted');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project =  project::findOrFail($id);
        $proposal = Auth::user()->proposals()->where('project_id' , $id)->first();

        return view('freelancer.proposals.create', [
            'proposal'=> $proposal,
            'project'=> $project,
            'units'=> Proposal::units(),
        ]);



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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project)
    {
        $proposal = Auth::user()->proposals()->where('project_id' , $project)->first();
        if( $proposal != null){
            $proposal->delete();
            return redirect()->back()->with('success',' your proposal has been Deleted');
        }else{
            return redirect()->back()->with('error',' You have an error');
        }
    }
}
