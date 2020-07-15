<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $table = 'collaborators';
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'rg',
        'birth',
        'office_id',
        'start',
        'end',
        'cep',
        'address',
        'complement',
        'number',
        'neighborhood',
        'state',
        'city',
        'user',
        'password',
        'note',
        'active',
    ];
}
