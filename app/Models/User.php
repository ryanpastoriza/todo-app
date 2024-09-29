<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The relationship to the user's tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function taskCounter() {
        return $this->tasks()->count() + 1;
    }

    /**
     * @return mixed
     */
    public function tasksCompleted()
    {
        return $this->tasks()->completed()->get();
    }

    /**
     * @return mixed
     */
    public function tasksArchived()
    {
        return $this->tasks()->archived()->get();
    }

    /**
     * @param Carbon $date
     * @return mixed
     */
    // public function tasksCompletedByDueDate(Carbon $date)
    // {
    //     return $this->tasks()->dueDate($date)->orderBy('end_at')->get();
    // }
}
