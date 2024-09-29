<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use Illuminate\Support\Facades\Auth;
// use App\Traits\JsonResponseWithStatus;
use App\Services\TaskService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Task;

/**
 * @OA\Info(
 *    title="Todo App Api",
 *    version="0.0.1",
 *    description="API for managing User Tasks."
 * )
 */
class TaskController extends Controller
{
    // use JsonResponseWithStatus;

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @OA\PathItem(path="/api/tasks")
     * @OA\Get(
     *     path="api/tasks/",
     *     summary="Get all incomplete tasks",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of incomplete tasks"
     *     )
     * )
     */
    public function index(Request $request)
    {   
       
        $query = $request->user()->tasks()->incomplete();

        if( $request->has('filters') ) {

            $filters = $request->filters;
            if( $filters['due_date'] )
            {
                $query->dueDateBetween(
                    $filters['due_date']['from'], 
                    $filters['due_date']['to']
                );
            }
        }


        $tasks = $query->paginate(6);

        return new TaskCollection($tasks);
       
    }

    /**
     * Display a listing of the resource.
     */
    public function completed(Request $request)
    {   
       $tasks = $request->user()->tasks()->completed()->paginate(6);

        return new TaskCollection($tasks);
       
    }

     /**
     * Display a listing of the resource.
     */
    public function archived(Request $request)
    {   
        $tasks = $request->user()->tasks()->archived()->paginate(6);

        return new TaskCollection($tasks);
       
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, TaskService $taskService) : JsonResponse
    {   
        $task = $taskService->createTask($request->user(), $request->validated());

        if( $request->has('tags') ) {
            $task->tags()->sync($request->tags, false);
        }

       return response()->json([new TaskResource($task)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Task $task) : JsonResponse
    {

        if (! Gate::allows('view-task', $task)) {
            return $this->unauthorized();
        }

        return response()->json([new TaskResource($task)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task) : JsonResponse
    {
        if (! Gate::allows('update-task', $task)) {
            return $this->unauthorized();
        }

        $task->update($request->validated());

        if( $request->has('tags') ) {
            $task->tags()->sync($request->tags, false);
        }

        return response()->json([new TaskResource($task)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        if (! Gate::allows('delete-task', $task)) {
            return $this->unauthorized();
        }

        $task->delete();

    return response()->json([], JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function toggleCompletedTask(Task $task)
    {
        if (! Gate::allows('update-task', $task)) {
            return $this->unauthorized();
        }

        if( $task->completed )
        {
            $task->setIncomplete();
        }else 
        {
            $task->setCompleted();
        }
        
        return response()->json([
            new TaskResource($task)
        ]);
    }
}
