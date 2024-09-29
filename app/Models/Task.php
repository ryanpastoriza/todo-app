<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Priority;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task';
    protected $primaryKey = "task_id";
    protected $dateFormat = 'Y-m-d';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'description',
    	'completed',
        'completed_at',
    	'order',
    	'priority',
    	'due_date'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'priority' => Priority::class,
            'completed' => boolean,
            'completed_at' => 'timestamp'
        ];
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Task $task): void {
            if (blank($task->order)) {
                $task->setAttribute('order', 1);
            }

            $lastOrder = 1;

            if( auth()->user() ) 
            {
            	$lastOrder = (int) auth()->user()->taskCounter();
            }

            $task->setAttribute('order', ++$lastOrder);
        });
    }

    /**
     * The relationship to the owning user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
    * The tags that belong to the task.
    */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'task_tag', 'task_id', 'tag_id');
    }

    public function scopeDueDateBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('due_date', [$startDate, $endDate]);
    }

    public function scopeCreatedAtBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeDeletedAtBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeCompletedAtBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeSearch($query, $search)
    {
        if( $search == null ) return $query;
        return $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
    }

    public function scopePriority($query, $priority)
    {
        // if( $search == null ) return $query;
        // return $query->where('title', 'LIKE', "%{$search}%");
        //             ->orWhere('description', 'LIKE', "%{$search}%");
    }

    // public function sort($query, $column = '', $order = 'ASC'): void
    // {
    //     if ($value) {
    //         $this->builder->where('title', 'like', "%{$value}%")
    //             ->orWhere('description', 'like', "%{$value}%");
    //     }
    // }

    public function scopeIncomplete()
    {
       return $this->where('completed', false);
    }

    public function scopeCompleted()
    {
       return $this->where('completed', true);
    }

    public function scopeArchived()
    {
        return $this->onlyTrashed();
    }

    public function setIncomplete()
    {
        return $this->update(['completed' => false, 'completed_at' => null ]);// return $this->onlyTrashed();
    }

    public function setCompleted()
    {
        return $this->update(['completed' => true, 'completed_at' => Carbon::now()->toDateString() ]);// return $this->onlyTrashed();
    }

    public function setArchive()
    {
        return $this->delete();// return $this->onlyTrashed();
    }

    public function deletePermanently()
    {
        $this->forceDelete();
    }
}
