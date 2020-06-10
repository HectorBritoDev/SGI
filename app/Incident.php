<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'severity', 'title', 'description', 'client_id',
    ];

    //Validate

    public static function validation($data)
    {
        $data = request()->validate(
            [
                'category_id' => 'required|exists:categories,id',
                'severity' => 'required|in:M,N,A',
                'title' => 'required|min:5',
                'description' => 'required|min:15',

            ],
            [
                'category_id.required' => 'Debes seleccionar una categoria',
                'category_id.exists' => 'La categoria no coincide con ninguna en la base de datos',
                'severity.required' => 'Debes seleccionar la severidad',
                'severity.in' => 'La severidad debe ser Menor, Normal o Alta',
                'title.required' => 'Debes colocar un título',
                'title.min' => 'El titulo no puede ser tan corto',
                'description.required' => 'Debes colocar una descripción',
                'description.min' => 'La descripción no puede ser tan corta',
            ]
        );

        if ($data['category_id'] == "") {
            $data['category_id'] = null;

        }
        return $data;
    }

    //Relationships
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function support()
    {
        return $this->belongsTo('App\User', 'support_id');
    }
    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    //Accessors
    public function getSeverityFullNameAttribute()
    {
        switch ($this->severity) {
            case 'M':
                return 'Menor';

            case 'N':
                return 'Normal';

            default:
                return 'Alta';

        }
    }

    public function getTitleShortAttribute()
    {
        return mb_strimwidth($this->title, 0, 20, '...');
    }

    public function getSupportNameAttribute()
    {
        if ($this->support) {
            return $this->support->name;
        }
        return 'Sin Asignar';

    }

    public function getStateAttribute(Type $var = null)
    {
        if ($this->active == 0) {
            return 'Resuelto';
        }
        if ($this->support_id) {
            return 'Asignado';
        }
        return 'Pendiente';

    }
}
