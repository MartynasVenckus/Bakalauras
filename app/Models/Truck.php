<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Truck extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function add(Request $request){

        $truck = new Truck;
        
        $truck->brand = $request->input('brand');
        $truck->model = $request->input('model');
        $truck->technicalInspectionExpirationDate = $request->input('technicalInspectionExpirationDate');
        $truck->insurance = $request->input('insurance');
        $truck->licensePlate = $request->input('licensePlate');
        $truck->trailerNumber = $request->input('trailerNumber');
        $truck->fk_tdevice = $request->input('fk_tdevice');

        $truck->save();

        return $truck;
    }
    public static function updateMy(Request $request, $id){

        $truck = Truck::find($id);
        
        $truck->brand = $request->input('brand1');
        $truck->model = $request->input('model1');
        $truck->technicalInspectionExpirationDate = $request->input('technicalInspectionExpirationDate1');
        $truck->insurance = $request->input('insurance1');
        $truck->licensePlate = $request->input('licensePlate1');
        $truck->trailerNumber = $request->input('trailerNumber1');
        $truck->fk_tdevice = $request->input('fk_tdevice1');

        $truck->save();
    }
}
