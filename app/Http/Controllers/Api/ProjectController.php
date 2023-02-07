<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('field', 'type', 'technologies')->get();
                return $projects;
    }

    public function show($slug){
        try{
            $project = Project::where('slug', $slug)->with('field', 'type', 'technologies')->firstOrFail();
            return $project;
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response([
                'error' => '404 not found'
            ], 404);
        }
    }
}
