<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recent_project = project::with('category','tags')->latest()->where('status','=','open')->limit(5)->get();
        return view('dashboard',[
            'recent_project' => $recent_project,
        ]);
    }
}
