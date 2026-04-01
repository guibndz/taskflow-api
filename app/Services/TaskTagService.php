<?php

namespace App\Services;

use App\Models\Task;

class TaskTagService
{
    public function attachTag(int $taskId, int $tagId): array
    {
        $task = Task::find($taskId);
        
        if (!$task) {
            return ['success' => false, 'message' => 'Tarefa não encontrada.', 'status' => 404];
        }

        // Verifica se a tag JÁ ESTÁ na tarefa (Regra de negócio 5)
        if ($task->tags()->where('tag_id', $tagId)->exists()) {
            return ['success' => false, 'message' => 'Esta tag já está associada a esta tarefa.', 'status' => 409]; // 409 Conflict
        }

        // O método attach adiciona a relação na tabela pivot tag_task
        $task->tags()->attach($tagId);

        return ['success' => true, 'message' => 'Tag associada com sucesso!', 'status' => 200];
    }

    public function detachTag(int $taskId, int $tagId): array
    {
        $task = Task::find($taskId);
        
        if (!$task) {
            return ['success' => false, 'message' => 'Tarefa não encontrada.', 'status' => 404];
        }

        // O método detach remove a relação
        $task->tags()->detach($tagId);

        return ['success' => true, 'message' => 'Tag removida com sucesso.', 'status' => 200];
    }
}