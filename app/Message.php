<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'user_id', 'incident_id',
    ];
    //VALIDATION

    public static function validation($data)
    {

        $data = request()->validate(
            [
                'message' => 'required|min:2|max:500',
                'user_id' => '',
                'incident_id' => '',

            ],
            [
                'message.required' => 'Debes escribir algún mensaje para poder enviar',
                'message.min' => 'El mensaje no puede ser tan corto',
                'message.max' => 'El mensaje no puede ser tan largo.',
            ]);

        return $data;
    }

    //RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
