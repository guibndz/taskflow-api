<?php

namespace App\Http\Controllers;

use App\Services\TaskTagService;

class TaskTagController extends Controller
{
    public function __construct(protected TaskTagService $taskTagService) {}

    public function attach($taskId, $tagId)
    {
        $result = $this->taskTagService->attachTag($taskId, $tagId);

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], $result['status']);
        }

        return response()->json(['message' => $result['message']], 200);
    }

    public function detach($taskId, $tagId)
    {
        $result = $this->taskTagService->detachTag($taskId, $tagId);

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], $result['status']);
        }

        return response()->json(['message' => $result['message']], 200);
    }
}