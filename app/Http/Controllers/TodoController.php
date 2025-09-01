<?php

// app/Http/Controllers/TodoController.php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TodoResource;
use App\Http\Requests\TodoStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TodoUpdateRequest;

class TodoController extends Controller
{
    // GET /todos
    public function index(Request $request): JsonResponse
    {
        $todos = $request->user()
            ->todos()
            ->latest('id')
            ->paginate(10);

        return TodoResource::collection($todos)->response();
    }

    // POST /todos
    public function store(TodoStoreRequest $request): JsonResponse
    {
        // Optional: ability gate
        // abort_unless($request->user()->tokenCan('todos:write'), 403);

        $data = $request->validated();


        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/todos', 'public');
        }

        $todo = $request->user()->todos()->create($data);

        return (new TodoResource($todo))
            ->response()
            ->setStatusCode(201);
    }

    // GET /todos/{id}
    public function show(Request $request, int $id): JsonResponse
    {
        $todo = $request->user()->todos()->findOrFail($id);
        return (new TodoResource($todo))->response();
    }

    // PUT/PATCH /todos/{id}
    public function update(TodoUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        // dd($request->all(), $request->hasFile('image'), $request->file('image'));

        $todo = $request->user()->todos()->findOrFail($id);
        if ($request->file('image')) {
            // optionally delete old image
            if ($todo->image && Storage::disk('public')->exists($todo->image)) {
                Storage::disk('public')->delete($todo->image);
            }
            $data['image'] = $request->file('image')->store('uploads/todos', 'public');
        }


        $todo->update($data);
        return TodoResource::make($todo->refresh())->response();
    }

    // DELETE /todos/{id}
    public function destroy(Request $request, int $id): JsonResponse
    {
        $todo = $request->user()->todos()->findOrFail($id);
        $todo->delete();

        return response()->json(['message' => 'Deleted']);
    }

    // PATCH /todos/{id}/toggle
    public function toggle(Request $request, int $id): JsonResponse
    {
        $todo = $request->user()->todos()->findOrFail($id);
        $todo->update(['is_done' => ! $todo->is_done]);

        return (new TodoResource($todo->refresh()))->response();
    }
}
