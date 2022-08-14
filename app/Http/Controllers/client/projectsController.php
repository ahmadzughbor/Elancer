<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\ProjectRequest;
use App\Models\category;
use App\Models\project;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Collection\Map\TypedMap;

class projectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        //$projects = project::where('user_id', '=', $user->id)->paginate();
        $projects = $user->projects()
            // ->withoutGlobalScope('active')
            // ->closed()
            // ->hourly()
            // ->filter(['type'=>'open','budget_min' =>1000])
            ->paginate();
        return view('client.projects.index', [
            'projects' => $projects,
        ]);
        // dd($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('client.projects.create', [
            'project' => new project(),
            'types' => project::types(),
            'status' => project::status(),
            'categories' => $this->categories(),
            'tags' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        // dd($request);
        $user = $request->user();
        $data = $request->except('attachments');
        $data['attachments'] = $this->uploadAttachments($request);


        $project = $user->projects()->with('category.parent', 'tags')->create($data);
        $tags = explode(',', $request->input('tags'));
        $project->syncTags($tags);
        return redirect()->route('client.projects.index')->with('success', 'project added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $project = $user->projects()->findOrFail($id);
        return view('client.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $project = $user->projects()->findOrFail($id);
        return view('client.projects.edit', [
            'project' => $project,
            'types' => project::types(),
            'categories' => $this->categories(),
            'status' => project::status(),
            'tags' => $project->tags()->pluck('name')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $user = Auth::user();
        $data = $request->except('attachments');
        $data['attachments'] = array_merge(($project->attachments ?? []), $this->uploadAttachments($request));
        $project = $user->projects()->findOrFail($id);
        $project->update($data);
        $tags = explode(',', $request->input('tags'));
        $project->syncTags($tags);


        return redirect()->route('client.projects.index')->with('success', 'project updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $project = $user->project()->findOrFail($id);
        $project->delete();
        foreach ($project->attachments as $file) {
            Storage::disk('public')->delete('file');
        }
        return redirect()->route('client.projects.index')->with('success', 'project deleted');
    }
    protected function categories()
    {
        // dd(category::pluck('name','id')->toArray());
        return category::pluck('name', 'id')->toArray();
    }
    protected function uploadAttachments(Request $request)
    {
        if (!$request->hasfile('attachments')) {
            return;
        }
        $files = $request->file('attachments');
        $attachments = [];
        foreach ($files as $file) {
            if ($file->isValid()) {
                $path = $file->store('/attachments', [
                    'disk' => 'uploads',
                ]);
                $attachments[] = $path;
            }
        }
        $data['attachments'] = $attachments;
        return $attachments;
    }
}
