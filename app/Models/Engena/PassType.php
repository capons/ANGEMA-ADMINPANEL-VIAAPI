<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class PassType extends Model
{
    protected $table    = 'pass_types';
    protected $fillable = ['name', 'description'];


    public function addPassType(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'name'        => $data['name'],
            'description' => $data['description'],
        ];

        if ($pass = $this->create($row)) {
            return $pass;
        }

        return false;
    }

    public function updatePassType(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'name'        => $data['name'],
            'description' => $data['description'],
        ];

        $this->where('ID', $data['id'])->update($row);

        return true;
    }

    public function deletePassType($id)
    {
        $this->destroy($id);

        return true;
    }
}
