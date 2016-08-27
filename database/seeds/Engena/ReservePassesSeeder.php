<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Engena\Pass;
use App\Models\Engena\PassDuration;
use Carbon\Carbon;

class ReservePassesSeeder extends Seeder
{
    public function run()
    {

        DB::table('passes')->truncate();
        DB::table('pass_durations')->truncate();
        // DB::table('reserve_passes')->truncate();

        $pass              = new Pass();
        $pass->name        = 'Single User Pass';
        $pass->description = 'Single User Pass';
        $pass->created_at  = Carbon::now();
        $pass->updated_at  = Carbon::now();
        $pass->save();

        $pass              = new Pass();
        $pass->name        = 'Family Pass';
        $pass->description = 'Family Pass';
        $pass->created_at  = Carbon::now();
        $pass->updated_at  = Carbon::now();
        $pass->save();

        $duration                  = new PassDuration();
        $duration->name            = '1 Day';
        $duration->description     = '1 Day';
        $duration->duration        = 1;
        $duration->duration_metric = 'day';
        $duration->created_at      = Carbon::now();
        $duration->updated_at      = Carbon::now();
        $duration->save();

        $duration                  = new PassDuration();
        $duration->name            = '1 Year';
        $duration->description     = '1 Year';
        $duration->duration        = 1;
        $duration->duration_metric = 'year';
        $duration->created_at      = Carbon::now();
        $duration->updated_at      = Carbon::now();
        $duration->save();
    }
}
