<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class HomeController extends Controller 
{
    public function index()
    {
        $recent_project = project::with('category','tags','proposedFreelancers')->latest()->where('status','=','open')->paginate(6);
        // dd($recent_project[0]->proposedFreelancers[0]->getProfilePhotoUrlAttribute());
        return view('dashboard',[
            'recent_project' => $recent_project,
        ]);
    }
}
