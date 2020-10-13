<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $fillable = [
        'collaborator_id',
        'name',
        'description',
        'active',
    ];
}
