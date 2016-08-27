<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    protected $table      = 'tbltrails';
    protected $primaryKey = 'ID';
    protected $fillable   = ['ReserveID','ActivityID', 'TrailName', 'TrailDescription', 'TrailMapURL'];
    public $timestamps    = false;

    public function reserve()
    {
        return $this->belongsTo('App\Models\Engena\Reserve', 'ReserveID', 'ID');
    }

    public function activity()
    {
        return $this->belongsTo('App\Models\Engena\Activity', 'ActivityID', 'ID');
    }

    public function addTrail(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'ReserveID'        => $data['ReserveID'],
            'ActivityID'       => $data['ActivityID'],
            'TrailName'        => $data['TrailName'],
            'TrailDescription' => $data['TrailDescription'],
            'TrailMapURL'      => $data['TrailMapURL'],
        ];

        // Disabling this as we are not going to upload mapdata, yet.
        // $urlPath           = url('/public/uploads/trails/');
        // $destinationFolder = base_path('/public/uploads/trails/');
        // $uploadedFile      = app('request')->file('RouteFile');
        // $extension         = $uploadedFile->guessExtension();
        // $fileName          = str_shuffle(sha1(microtime())) . "." . $extension;
        // $savedFile         = $uploadedFile->move($destinationFolder, $fileName);
        // $row['RouteFile']  = $fileName;

        if ($trail = $this->create($row)) {
            return $trail;
        }

        return false;
    }

    public function updateTrail(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $id   = $data['ID'];
        $row  = [
            'ReserveID'        => $data['ReserveID'],
            'ActivityID'       => $data['ActivityID'],
            'TrailName'        => $data['TrailName'],
            'TrailDescription' => $data['TrailDescription'],
            'TrailMapURL'      => $data['TrailMapURL'],
        ];

        $this->where('ID', $id)->update($row);

        return true;
    }

    public function deleteTrail($id)
    {
        $this->destroy($id);

        return true;
    }
}
