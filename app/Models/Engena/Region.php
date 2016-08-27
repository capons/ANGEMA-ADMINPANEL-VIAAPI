<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table      = 'tblregions';
    protected $primaryKey = 'ID';
    protected $fillable   = ['Country', 'StateProvince', 'Region', 'enabled'];
    public $timestamps    = false;

    public function reserves()
    {
        return $this->hasMany('App\Models\Engena\Reserve', 'RegionID', 'ID');
    }

    public function addRegion(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'Country'           => $data['Country'],
            'StateProvince'     => $data['StateProvince'],
            'Region'            => $data['Region'],
            'enabled'           => $data['enabled'],
        ];

        if ($region = $this->create($row)) {
            return $region;
        }

        return false;
    }

    public function updateRegion(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $id   = $data['ID'];
        $row  = [
            'Country'           => $data['Country'],
            'StateProvince'     => $data['StateProvince'],
            'Region'            => $data['Region'],
            'enabled'           => $data['enabled'],
        ];

        $this->where('ID', $id)->update($row);

        return true;
    }

    public function deleteRegion($id)
    {
        $this->destroy($id);

        return true;
    }
}
