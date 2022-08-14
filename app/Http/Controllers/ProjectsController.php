<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = project::latest()->paginate();
        return view('projects.index',[
            'projects'=> $projects,

        ]);
    }
    public function show(project $project)
    {
        return view('projects.show',[
            'projects'=> $project,
            'units'=> Proposal::units(),
        ]);
    }
}
