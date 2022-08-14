<?php

namespace App\Http\Controllers\freelancer;

use App\Http\Controllers\Controller;
use App\Models\freelancer;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function edit()
    {

        $user = Auth::user();
        $profile = $user->freelancer;
        return view('freelancer.profile.edit',[
            'user'=> $user,
            'profile'=>$user->freelancer
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name'=> ['required'],
        ]);
        $user = Auth::user();
        $user->freelancer()->updateOrCreate([],$request->all());
        return redirect()->route('freelancer.profile.edit')->with('success','profile updated');
    }
}
