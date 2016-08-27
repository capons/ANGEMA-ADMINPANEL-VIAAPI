<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class PassDuration extends Model
{
    protected $table    = 'pass_durations';
    protected $fillable = ['name', 'description', 'duration', 'duration_metric'];
    protected $metrics  = [ 'day' => 'day', 'week' => 'week', 'month' => 'month', 'year' => 'year' ];

    public function addPassDuration(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'name'            => $data['name'],
            'description'     => $data['description'],
            'duration'        => $data['duration'],
            'duration_metric' => $data['duration_metric'],
        ];

        if ($passDuration = $this->create($row)) {
            return $passDuration;
        }

        return false;
    }

    public function updatePassDuration(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'name'            => $data['name'],
            'description'     => $data['description'],
            'duration'        => $data['duration'],
            'duration_metric' => $data['duration_metric'],
        ];

        $this->where('ID', $data['id'])->update($row);

        return true;
    }

    public function deletePassDuration($id)
    {
        $this->destroy($id);

        return true;
    }
}
