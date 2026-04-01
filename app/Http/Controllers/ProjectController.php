<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Injeção de dependência: O Laravel instancia o ProjectService automaticamente para nós!
    public function __construct(protected ProjectService $projectService) {}

    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        
        // Padrão de Sucesso exigido no PDF
        return response()->json([
            'data' => $projects
        ], 200);
    }

    public function store(Request $request)
    {
        // Validação básica (o PDF pede para mostrar erro de validação)
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:open,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $project = $this->projectService->createProject($validatedData);

        return response()->json([
            'data' => $project,
            'message' => 'Projeto criado com sucesso.'
        ], 201); // 201 Created
    }

    public function show($id)
    {
        $project = $this->projectService->getProjectById($id);

        if (!$project) {
            // Padrão de Erro exigido no PDF
            return response()->json([
                'message' => 'Projeto não encontrado.',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $project
        ], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->projectService->deleteProject($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Projeto não encontrado.',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Projeto excluído com sucesso.' // A exclusão em cascata das tasks já está no banco de dados!
        ], 200);
    }
}