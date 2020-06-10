<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'start',
    ];

    //Relationships
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
    }

    //Validate
    public static function validation($data)
    {
        $data = request()->validate(
            [
                'name' => 'required|min:6|max:255',
                'description' => 'required| min:6 | max:255',
                'date' => 'date',
            ],
            [
                'name.required' => 'Debes colocar un nombre',
                'name.min' => 'El nombre es muy corto',
                'name.max' => 'El nombre es muy largo',
                'description.required' => 'Debes colocar una description',
                'description.min' => 'La descripcion es muy corta',
                'description.max' => 'La descripcion es muy larga',
                'date.date' => 'Ingresa una fecha valida',

            ]
        );

        return $data;
    }

    //Accessors

    public function getFirstLevelIdAttibutte()
    {
        return $this->levels->first()->id;
    }
}
