<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(protected TagService $tagService) {}

    // GET /api/tags (Listar todas)
    public function index()
    {
        $tags = $this->tagService->getAllTags();
        
        return response()->json([
            'data' => $tags
        ], 200);
    }

    // POST /api/tags (Criar uma nova)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:tags|max:255',
            'color' => 'nullable|string|max:7', // Formato Hexadecimal, ex: #FF0000
        ]);

        $tag = $this->tagService->createTag($validatedData);

        return response()->json([
            'data' => $tag,
            'message' => 'Tag criada com sucesso.'
        ], 201); // 201 Created
    }
}