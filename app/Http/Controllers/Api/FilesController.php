<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Project as ProjectResource;

class FilesController extends Controller
{
    public function store(FileRequest $request)
    {
        $project = Project::find($request->project_id);
        $this->authorize('upload', $project);
        $image = $request->file('image');
        $filename = 'project-' . time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/public', $filename);
        $project->image = $filename;
        $project->save();
        return new ProjectResource($project);
    }
}
