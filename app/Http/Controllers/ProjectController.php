<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    
    public function index() {
        $projects = Project::select('id', 'title', 'description', 'progress')->where('user_id', '=', auth()->user()->id)->get();        
        return view('projects.index', ['projects' => $projects]);
    }

    public function create() {
        return view('projects.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $data["user_id"] = auth()->user()->id;
        if($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads', 'public');
        }
        Project::create($data);
        return redirect('/dashboards/index');
    }

    public function edit($id) {
        $project = Project::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if($project !== null) {
            return view('projects.edit', ['project' => $project]);
        }
        else {
            return redirect('/projects/index');
        }
    }

    public function update(Request $request) {
        $project = Project::where('user_id', auth()->user()->id)->where('id', $request->project_id)->first();
        if($project !== null) {
            $data = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'progress' => 'required'
            ]);
            if($request->hasFile('picture')) {
                if(!is_null($project->picture)) {
                    Storage::delete('public/'.$project->picture);
                }
                $data['picture'] = $request->file('picture')->store('uploads', 'public');                
            }
            $project->update($data);            
        }
        return redirect('/projects/index');        
    }

    public function destroy(Request $request) {        
        $project = Project::where('user_id', auth()->user()->id)->where('id', $request->project_id)->first();        
        if($project !== null) {
            if($project->picture !== null) {
                if(Storage::disk('public')->exists($project->picture)) {                    
                    Storage::delete('public/'.$project->picture);
                }
            }            
            $project->delete();
        }
        return redirect()->back();
    }

}
