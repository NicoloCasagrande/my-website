<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Field;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        $fields = Field::all();
        return view('admin.projects.create', compact('types', 'technologies', 'fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $new_project = new Project();
        $new_project->fill($data);
        $new_project->slug = Str::slug($new_project->title);

        if( isset($data['cover_image']) ){
            $new_project->cover_image = Storage::disk('public')->put('uploads', $data['cover_image']);
        }

        $new_project->save();

        if(isset($data['technologies'])){
            $new_project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('message', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        $fields = Field::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->fill($data);
        $project->slug = Str::slug($project->title);

        if ( isset($data['cover_image']) ) {
            if( $project->cover_image ) {
                Storage::delete($project->cover_image);
            }
            $project->cover_image = Storage::disk('public')->put('uploads', $data['cover_image']);
        }

        if( isset($data['no_image']) && $project->cover_image  ) {
            Storage::disk('public')->delete($project->cover_image);
            $project->cover_image = null;
        }
        
        $project->update();

        if(isset($data['technologies'])){
            $project->technologies()->sync($data['technologies']);
        }else{
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.index')->with('message', 'Progetto modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_title = $project->title;
        if($project->cover_image){
            Storage::disk('public')->delete($project->cover_image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "Il post $old_title è stato cancellato");
    }
}
