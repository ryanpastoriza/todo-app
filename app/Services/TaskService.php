<?php

namespace App\Services;

// use Exception;
use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\DB;
// use App\Exceptions\DBTransactionException;

class TaskService
{

    public function createTask(User $user, Array $attributes) : Task
    { 
      $task = $user->tasks()->create($attributes);
      
      return $task;
    }





}