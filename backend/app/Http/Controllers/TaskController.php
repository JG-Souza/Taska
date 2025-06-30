<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $tasks = Task::where('user_id', $userId)->get();

        return response()->json([
            'tasks' => TaskResource::collection($tasks),
        ], 200);
    }

    public function show($taskId)
    {
        $userId = Auth::id();

        $task = Task::find($taskId);
        if (!$task){
            return response()->json([
                'message' => 'Tarefa não encontrada.',
            ], 404);
        }

        if ($task->user_id !== $userId) {
            return response()->json([
                'message' => 'Acesso não autorizado.'
            ], 403);
        }

        return response()->json([
            'task' => new TaskResource($task)
        ], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $task = Task::create($data);

        return response()->json([
            'Task' => new TaskResource($task),
        ], 201);
    }

    public function update(UpdateTaskRequest $request, $taskId)
    {
        $task = Task::find($taskId);

        if(!$task){
            return response()->json([
                'message' => 'Tarefa não encontrada.'
            ], 404);
        }

        if ($task->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Acesso não autorizado.'
            ], 403);
        }

        $task->update($request->validated());

        return response()->json([
            'message' => 'Tarefa atualizada com sucesso.',
            'task' => new TaskResource($task),
        ], 200);
    }

    public function destroy($taskId)
    {
        $task = Task::find($taskId);

        if(!$task){
            return response()->json([
                'message' => 'Tarefa não encontrada.'
            ], 404);
        }

        if ($task->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Acesso não autorizado.'
            ], 403);
        }

        $task->delete();

        return response()->json([
            'message' => 'Tarefa excluída com sucesso.'
        ],200);
    }
}
