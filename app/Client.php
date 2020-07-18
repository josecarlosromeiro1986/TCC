<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'rg',
        'birth',
        'cep',
        'address',
        'complement',
        'number',
        'neighborhood',
        'state',
        'city',
        'note',
        'active',
    ];

    /**
     * Filter Offices
     */
    public function search($filter = null)
    {
        $results = $this
            ->join('phones', 'clients.id', '=', 'phones.client_id')
            ->select('clients.*', 'phones.number AS phone')
            ->where([
                ['clients.name', 'RLIKE', $filter],
                ['clients.active', '=', 'Y'],
                ['phones.main', '=', 'Y']
            ])->orderByRaw('clients.name ASC')
            ->paginate(5)
            ->onEachSide(0);

        return $results;
    }
}
