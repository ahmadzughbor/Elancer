<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = project::latest()->with(['category', 'user'])->paginate();
        return ProjectResource::collection($entries);
        //return $entries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $user = User::find(1);
        $data = $request->except('attachments');
        $project = $user->projects()->create($data);
        $tags = explode(',', $request->input('tags'));
        $project->syncTags($tags);

        return $project;
        return response($project, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        return new ProjectResource($project);
        //return $project->load('category');
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
        $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'type' => ['sometimes', 'required', 'in:hourly,fixed'],
            'budget' => ['nullable', 'numeric', 'min:0'],
        ]);
        $project = project::findOrFail($id);

        $project->update($request->all());

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        $user = Auth::guard('sanctum')->user();
        if(! $user->tokenCan('projects->delete'))
        {
            return Response::json([
                'message' => 'permission denied!'
            ],403);
        }
        $project->delete();
        if ($project->attachments) {
            foreach ($project->attachments as $file) {
                Storage::disk('publick')->delete($file);
            }
        }
        return [
            'message' => 'project deleted'
        ];
    }
}
