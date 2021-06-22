<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Driver extends Model
{
    public $timestamps = false;
    use HasFactory;

    public static function add(Request $request){

        $driver = new Driver;
        
        $driver->name = $request->input('name');
        $driver->surname = $request->input('surname');
        $driver->phone = $request->input('phone');
        $driver->status = "Laisvas";
        $driver->fk_truck = $request->input('fk_truck');

        $driver->save();

        return $driver;
    }
    public static function updateMy(Request $request, $id){

        $driver = Driver::find($id);
        
        $driver->name = $request->input('name1');
        $driver->surname = $request->input('surname1');
        $driver->phone = $request->input('phone1');
        $driver->status = $request->input('status1');
        $driver->fk_truck = $request->input('fk_truck1');

        $driver->save();
    }
}
