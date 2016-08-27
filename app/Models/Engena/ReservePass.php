<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class ReservePass extends Model
{
    protected $table    = 'reserve_passes';
    protected $fillable = ['reserve_id', 'pass_id', 'name', 'description', 'price'];

    public function pass()
    {
        return $this->belongsTo('App\Models\Engena\Pass', 'pass_id', 'id');
    }

}
