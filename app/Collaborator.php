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

    /**
     * Filter Offices
     */
    public function search($filter = null)
    {
        $results = $this
            ->join('offices', 'collaborators.office_id', '=', 'offices.id')
            ->join('phones', 'collaborators.id', '=', 'phones.collaborator_id')
            ->select('collaborators.*', 'offices.description AS office', 'phones.number AS phone')
            ->where([
                ['collaborators.name', 'RLIKE', $filter],
                ['collaborators.active', '=', 'Y'],
                ['phones.main', '=', 'Y']
            ])->orderByRaw('collaborators.name ASC')
            ->paginate(5)
            ->onEachSide(0);

        return $results;
    }
}
