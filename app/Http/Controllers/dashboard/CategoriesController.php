<?php

namespace App\Http\Controllers\dashboard;

use App\Models\category;
use App\Rules\filterRule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $rules =  [
        'name' => ['required', 'string', 'between:2,255', 'filter'],
        'parent_id' => ['nullable', 'int', 'exists:categories,id'],
        'description' => ['nullable', 'string'],
        'art_file' => ['nulable', 'image'],
    ];
    //Actions
    // public function __construct()
    // {
    //     $this->authorizeResource(category::class);
    // }
    public function index($id = 0)
    {
        // if(!Gate::allows('categories.view')){
        //     return abort(403);
        // };

        // $this->authorize('viewAny', category::class);
        //$categories =  DB::table('categories')->get();
        // $categories = category::get();
        $categories = category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])->paginate(4);
            $parent = category::all();
        $title = 'categories';
        // dd($categories);
        return view('categories.index', [
            'categories' => $categories,
            'parent' => $parent,
            'title' => 'categories',
            //'flashMassege'=>session('success')
        ]);
    }
    public function show(category $category)
    {
        //$category = DB::table('categories')->where('id', '=', $id)->first();

        //$category =category::where('id' , '=',$id)->first();
        // if ($category == null) {
        //     abort(404);
        // }
        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function create()
    {

        $this->authorize('create',category::class);
        $parents = category::all();
        $category = new category;
        return view('categories.create', compact('category', 'parents'));
    }

    public function store(Request $request)
    {
        $this->authorize('create',category::class);
        $clean = $request->validate($this->rules());
        $data = $request->all();
        if (!$data['slug']) {
            $data['slug'] = str::slug($data('name'));
        }
        $category = category::create($data);

        return response()->json([
            'status' => 200,
            'type' => '1'
        ]);
        // return  redirect()
        //     ->route('categories.index')
        //     ->with('success', 'category created');
    }
    public function edit(category $category)
    {

        // $this->authorize('update',$category);
        // $category = DB::table('categories')->where('id', '=', $id)->first();
        $parents = category::all();
        return view('categories.edit', compact('category', 'parents'));
    }
    public function update(Request $request, $category)
    {
        // $this->authorize('update',$category);
        $category1 =category::where('id',$category)->first();
        // $clean = $request->validate($this->rules);
        // $category->name = $request->input('name');
        // $category->description = $request->input('description');
        // $category->slug = str::slug($request->input('name'));
        // $category->parent_id = $request->input('parent_id');
        // $category->save();\
        // $categoryUp = category::where('id', $category);
        $category1->update($request->all());
        // $data = $request->all();
        // if( ! $data['slug'])
        // {
        //     $data['slug']=str::slug($data('name'));
        // }
        // $category = category::create($data);

        return response()->json([
            'data' => $category1,
            'status' => 200 ,
            'type' => '2'
        ]);
        // return  redirect()->route('categories.index')->with('success', 'category updated');
    }

    public function getById(Request $request, $category){
        // dd($category);

        $data = category::where('id',$category)->first();
        return response()->json($data);
    }

    public function trash()
    {
        $categories = category::onlyTrashed()->paginate();
        return view('categories.trash', [
            'categories' => $categories,
        ]);
    }

    public function restore(Request $request, $id)
    {
        $category = category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return  redirect()
            ->route('categories.trash')
            ->with('success', 'category restored');
    }

    public function forceDelete($id)
    {
        $category = category::withTrashed()->findOrFail($id);
        $category->forceDelete();
        return  redirect()
            ->route('categories.trash')
            ->with('success', 'category deleted for ever!');
    }

    public function destroy(category $category)
    {

        $this->authorize('view-any',$category);
        //category::destroy($category);
        $category->delete();
        return  redirect()->route('categories.index')->with('success', 'category deleted');
    }
    protected function rules()
    {
        $rules = $this->rules;
        return  $rules;
    }
}
