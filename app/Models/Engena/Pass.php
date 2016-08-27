<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    protected $table    = 'passes';
    protected $fillable = ['name', 'description', 'pass_duration_id', 'pass_type_id'];

    public function passType()
    {
        return $this->belongsTo('App\Models\Engena\PassType', 'pass_type_id', 'id');
    }

    public function passDuration()
    {
        return $this->belongsTo('App\Models\Engena\PassDuration', 'pass_duration_id', 'id');
    }

    public function addPass(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'name'             => $data['name'],
            'description'      => $data['description'],
            'pass_duration_id' => $data['pass_duration_id'],
            'pass_type_id'     => $data['pass_type_id'],
        ];

        if ($pass = $this->create($row)) {
            return $pass;
        }

        return false;
    }

    public function updatePass(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'name'        => $data['name'],
            'description' => $data['description'],
            'pass_duration_id' => $data['pass_duration_id'],
            'pass_type_id'     => $data['pass_type_id'],
        ];

        $this->where('ID', $data['id'])->update($row);

        return true;
    }

    public function deletePass($id)
    {
        $this->destroy($id);

        return true;
    }
}
