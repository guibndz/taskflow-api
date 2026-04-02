<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    // Lista todas as tarefas de um projeto específico (Eager Loading já está no Service!)
    public function index($projectId)
    {
        $tasks = $this->taskService->getTasksByProject($projectId);
        
        return response()->json([
            'data' => $tasks
        ], 200);
    }

    // Cria uma nova tarefa dentro de um projeto
    public function store(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:pending,in_progress,done',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        // Injeta o ID do projeto que veio da URL para garantir a integridade
        $validatedData['project_id'] = $projectId;

        $task = $this->taskService->createTask($validatedData);

        return response()->json([
            'data' => $task,
            'message' => 'Tarefa criada com sucesso.'
        ], 201);
    }

    // O endpoint de PATCH (Exclusivo para mudar o status, exigência do PDF)
    public function updateStatus(Request $request, $projectId, $taskId)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,in_progress,done'
        ]);

        $task = $this->taskService->updateStatus($taskId, $validatedData['status']);

        if (!$task) {
            return response()->json([
                'message' => 'Tarefa não encontrada.',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $task,
            'message' => 'Status da tarefa atualizado com sucesso.'
        ], 200);
    }

    // Exibir tarefa específica (GET /api/projects/{id}/tasks/{taskId})
    public function show($projectId, $taskId)
    {
        $task = $this->taskService->getTaskById($taskId);

        // Verifica se a tarefa existe E se ela realmente pertence a este projeto
        if (!$task || $task->project_id != $projectId) {
            return response()->json(['message' => 'Tarefa não encontrada neste projeto.', 'status' => 404], 404);
        }

        return response()->json(['data' => $task], 200);
    }

    // Atualizar tarefa inteira (PUT /api/projects/{id}/tasks/{taskId})
    public function update(Request $request, $projectId, $taskId)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,in_progress,done',
            'priority' => 'sometimes|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $taskCheck = $this->taskService->getTaskById($taskId);
        if (!$taskCheck || $taskCheck->project_id != $projectId) {
            return response()->json(['message' => 'Tarefa não encontrada neste projeto.', 'status' => 404], 404);
        }

        $task = $this->taskService->updateTask($taskId, $validatedData);

        return response()->json(['data' => $task, 'message' => 'Tarefa atualizada com sucesso.'], 200);
    }

    // Remover tarefa (DELETE /api/projects/{id}/tasks/{taskId})
    public function destroy($projectId, $taskId)
    {
        $taskCheck = $this->taskService->getTaskById($taskId);
        if (!$taskCheck || $taskCheck->project_id != $projectId) {
            return response()->json(['message' => 'Tarefa não encontrada neste projeto.', 'status' => 404], 404);
        }

        $this->taskService->deleteTask($taskId);

        return response()->json(['message' => 'Tarefa excluída com sucesso.'], 200);
    }
}