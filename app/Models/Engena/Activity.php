<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table      = 'tblactivities';
    protected $primaryKey = 'ID';
    protected $fillable   = ['Activity'];
    public $timestamps    = false;

}
