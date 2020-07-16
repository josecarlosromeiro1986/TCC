<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'offices';
    protected $fillable = ['description', 'access_id', 'active'];

    /**
     * Filter Offices
     */
    public function search($filter = null)
    {
        $results = $this
            ->join('access', 'offices.access_id', '=', 'access.id')
            ->select('offices.*', 'access.access')
            ->where([
                ['description', 'RLIKE', $filter],
                ['offices.active', '=', 'Y']
            ])
            ->orderByRaw('offices.description ASC')
            ->paginate(5)
            ->onEachSide(0);

        return $results;
    }
}
