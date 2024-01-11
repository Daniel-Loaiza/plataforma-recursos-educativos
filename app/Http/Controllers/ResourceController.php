<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class ResourceController extends Controller
{

    public function index()
    {
        // $resources = Resource::all();
        // return inertia('Index',compact('resources'));
        return Inertia::render('Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'resources'=>Resource::with('category')->latest()->get(),
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return inertia('Create');
    }

    // public function store(Request $request)
    public function store(StorePostRequest $request)
    {
        // $recurso = Resource::create($request->all());
        $recurso = Resource::create($request->validated());
        // Resource::create([
        //     'title'=>$request->title,
        //     'category_id'=>$request->category_id,
        //     'creator_id'=>$request->creator_id,
        //     'link'=>$request->link,
        //     'description'=>$request->description,
        // ]);

        return redirect()->route('resources')->with('message','Resource created successfully!');
    }

    public function show(Resource $resource)
    {
        //
    }

    public function edit($id)
    {
        $resource=Resource::findOrFail($id);
        return Inertia::render('Edit',compact('resource'));
    }


    public function update(Request $request, $id)
    {
        //
        // $request-> validate([
        //     'title'=>"required",
        //     'category_id'=>"required",
        //     'creator_id'=>"required",
        //     'link'=>"required",
        //     'description'=>"required",
        // ]);

        $resource = Resource::findOrFail($id);
        $resource->update($request->all());
        // $resource->setTitle($request->input('title'));
        // $resource->setCategory_id($request->input('category_id'));
        // $resource->setCreator_id($request->input('creator_id'));
        // $resource->setLink($request->input('link'));
        // $resource->setDescription($request->input('description'));

        // $resource->save();

        // $resource->update($request->all());
        // return redirect('/')->route('resources')->with("status","Nota Actualizada");
        return redirect()->route('resources');
    }

    public function destroy($id)
    {
        //
        $resource = Resource::findOrFail($id);
        $resource->delete();
        // Resource::destroy($id);
        // return response()->json(['message' => 'Resource deleted successfully']);
        // return $this->redirect('')->route('/');
        return Inertia::location(route('resources'));
        // return redirect('/')->route('resources');
        // return back();
        // return redirect()->route('resources')->with("status","Nota Actualizada");

    }

    public function search(Request $request) {

        return Resource::query()
        ->when(!empty($request->search),function($query) use ($request){
            return $query->where('title','like', "%$request->search%");
        })
        ->when(!empty($request->category),function($query) use ($request){
            return $query->where('category_id','like', $request->category);
        })        
        ->with('category')
        ->get();        
    }    
}
