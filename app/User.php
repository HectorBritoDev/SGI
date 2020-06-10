<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationships
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    //accessors
    public function getIsAdminAttribute()
    {
        return $this->role == 0;
    }

    public function getIsSupportAttribute()
    {
        return $this->role == 1;
    }

    public function getIsClientAttribute()
    {
        return $this->role == 2;
    }

    public function getListOfProjectsAttribute()
    {

        if ($this->role == 1) {
            return $this->projects;
        } else {
            return Project::all();
        }
    }

    public function getAvatarPathattribute()
    {
        if ($this->is_client) {
            return '/images/client.png';
        }
        return '/images/support.png';

    }

    //funciones adicionales

    public function canTake(Incident $incident)
    {
        return ProjectUser::where('user_id', $this->id)->where('level_id', $incident->level_id)->first();
    }

}
