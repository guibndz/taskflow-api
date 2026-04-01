<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getAllProjects(): Collection
    {
        return Project::withCount('tasks')->get();
    }

    public function createProject(array $data): Project
    {
        return Project::create($data);
    }

    public function getProjectById(int $id): ?Project
    {
        return Project::withCount('tasks')->find($id);
    }

    public function deleteProject(int $id): bool
    {
        $project = Project::find($id);
        
        if (!$project) {
            return false;
        }

        $project->delete();
        return true;
    }

    public function updateProject(int $id, array $data): ?Project
    {
        $project = Project::find($id);
        
        if (!$project) {
            return null;
        }

        $project->update($data);
        
        return $project;
    }
}