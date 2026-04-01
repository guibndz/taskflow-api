<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    // Eager Loading aqui! Trazendo o projeto e as tags junto com as tarefas
    public function getTasksByProject(int $projectId): Collection
    {
        return Task::with(['project', 'tags'])
                   ->where('project_id', $projectId)
                   ->get();
    }

    public function getTaskById(int $taskId): ?Task
    {
        return Task::with(['project', 'tags'])->find($taskId);
    }

    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateStatus(int $taskId, string $status): ?Task
    {
        $task = Task::find($taskId);
        if (!$task) return null;

        $task->update(['status' => $status]);
        return $task;
    }
}