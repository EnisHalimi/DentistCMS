<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;
use App\Pacient;
use App\Treatment;

class Report extends Model
{
    public function treatment()
    {
        return $this->belongsTo('App\Treatment');
    }

    public static function getTotal($id)
    {
        $report = Report::find($id);
        $pacient = Pacient::find($report->pacient_id);
        $treatment = Treatment::find($report->treatment_id);
        $services = $treatment->services()->get();
        $price = 0;
        foreach($services as $service)
        {
            $price = $price + ($service->price - ($service->price * ($service->discount /100)));
        }
        return $price;
    }
}
