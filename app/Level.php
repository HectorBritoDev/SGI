<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function validation($data)
    {
        $data = request()->validate(
            [
                'name' => 'required|min:3|max:50',
            ],
            [
                'name.required' => 'Debes ingresar un nombre',
                'name.min' => 'El nombre es muy corto',
                'name.max' => 'El nombre es muy corto',
            ]
        );
        return $data;
    }
}
