<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'offices';
    protected $fillable = ['description', 'access', 'active'];

    /**
     * Filter Offices
     */
    public function search($filter = null)
    {
        $results = $this->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('description', 'RLIKE', $filter);
            }
        })->paginate(5)->onEachSide(0);

        return $results;
    }
}
