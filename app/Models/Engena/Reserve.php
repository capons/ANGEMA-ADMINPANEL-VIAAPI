<?php

namespace App\Models\Engena;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $table      = 'tblreserves';
    protected $primaryKey = 'ID';
    protected $fillable   = ['RegionID','ReserveName', 'DayPassCost', 'YearPassCost', 'Admin_Email'];
    public $timestamps    = false;

    public function region()
    {
        return $this->belongsTo('App\Models\Engena\Region', 'RegionID', 'ID');
    }

    public function activities()
    {
        return $this->belongsToMany('App\Models\Engena\Activity', 'tblreserveactivities', 'ReserveID', 'ActivityID');
    }

    public function passes()
    {
        return $this->hasMany('App\Models\Engena\ReservePass', 'reserve_id', 'ID');
    }

    public function addReserve(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $row  = [
            'RegionID'     => $data['RegionID'],
            'ReserveName'  => $data['ReserveName'],
            'Admin_Email'  => $data['Admin_Email'],
        ];

        if (!$reserve = $this->create($row)) {
            return false;
        }

        if ( isset($data['activities']) && sizeof($data['activities'] > 0)) {
            foreach($data['activities'] as $activity) {
                $reserve->activities()->attach($activity);
            }
        }

        if ( isset($data['passes']) && sizeof($data['passes'] > 0)) {
            foreach($data['passes'] as $key => $pass) {
                $newPass = new ReservePass($pass);
                $reserve->passes()->save($newPass);
            }
        }

        return $reserve;
    }

    public function updateReserve(array $data = array())
    {
        $data = $data ?: app('request')->all();
        $id   = $data['ID'];

        $reserve              = $this->find($id);
        $reserve->RegionID    = $data['RegionID'];
        $reserve->ReserveName = $data['ReserveName'];
        $reserve->Admin_Email = $data['Admin_Email'];
        $reserve->save();

        if ( isset($data['activities']) && sizeof($data['activities'] > 0)) {
            $reserve->activities()->detach();
            foreach($data['activities'] as $activity) {
                $reserve->activities()->attach($activity);
            }
        }

        if ( isset($data['passes']) && sizeof($data['passes'] > 0)) {
            $reserve->passes()->delete();
            foreach($data['passes'] as $key => $pass) {
                $newPass = new ReservePass($pass);
                $reserve->passes()->save($newPass);
            }
        }

        return true;
    }

    public function deleteReserve($id)
    {
        $reserve = $this->findOrFail($id);
        $reserve->activities()->detach();
        $reserve->passes()->delete();
        $reserve->delete();

        return true;
    }
}
