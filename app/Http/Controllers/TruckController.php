<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Tracking_device;
Use App\Models\gps;
use Illuminate\Support\Facades\DB;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::all();
        $tdevices = Tracking_device::all();

        $tdata = DB::table('trucks')
        ->select('trucks.*', 'tracking_devices.name AS name')
        ->leftJoin('tracking_devices', 'trucks.fk_tdevice', '=', 'tracking_devices.id')->paginate(10);

        return view('truck.list')->with('data', ['status' => '', 'trucks' => $trucks, 'tdevices' => $tdevices, 'tdata' => $tdata]);
    }

    public function getGPS()
    {
        $truck = Truck::where('fk_tdevice', 1)->get();
        $gps = gps::orderByDesc('date')->first()->get();

        return view('map.map')->with('data', ['gps' => $gps, 'truck' => $truck]);
    }

    public function getGPSData()
    {
        $gps = gps::orderByDesc('date')->first();

        echo json_encode($gps);
        exit;
    }


    public function searchTruck(Request $request)
    {
        $search = $request->get('search');

        $trucks = Truck::all();
        $tdevices = Tracking_device::all();

        $tdata = DB::table('trucks')
        ->select('trucks.*', 'tracking_devices.name AS name')
        ->leftJoin('tracking_devices', 'trucks.fk_tdevice', '=', 'tracking_devices.id')
        ->where('trucks.brand', 'like', '%'.$search.'%')
        ->paginate(10);

        if ($tdata->isEmpty()) { 
            return view('truck.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'trucks' => $trucks, 'tdevices' => $tdevices, 'tdata' => $tdata]);
        }
        else{
            return view('truck.list')->with('data', ['status' => '', 'trucks' => $trucks, 'tdevices' => $tdevices, 'tdata' => $tdata]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required',
            'model' => 'required',
            'technicalInspectionExpirationDate' => 'required',
            'licensePlate' => 'required',
            'trailerNumber' => '',
            'fk_tdevice' => '',
            'insurance' => 'required'
        ],
        [
            'brand.required' => 'Markė yra privaloma.',
            'model.required' => 'Modelis yra privalomas.',
            'technicalInspectionExpirationDate.required' => 'Techninės apžiūros pasibaigimo data yra privaloma.',
            'insurance.required' => 'Draudimas yra privalomas.',
            'licensePlate.required' => 'Valstybiniai numeriai yra privalomi.'  
        ]);

        Truck::add($request);

        return redirect()->route('truck');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'brand1' => 'required',
            'model1' => 'required',
            'technicalInspectionExpirationDate1' => 'required',
            'licensePlate1' => 'required',
            'trailerNumber1' => '',
            'fk_tdevice1' => '',
            'insurance1' => 'required'
        ],
        [
            'brand1.required' => 'Markė yra privaloma.',
            'model1.required' => 'Modelis yra privalomas.',
            'technicalInspectionExpirationDate.required1' => 'Techninės apžiūros pasibaigimo data yra privaloma.',
            'insurance.required1' => 'Draudimas yra privalomas.',
            'licensePlate.required1' => 'Valstybiniai numeriai yra privalomi.'  
        ]);

        Truck::updateMy($request, $request->input('truckid'));

        return redirect()->route('truck');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truck = Truck::find($id);
        $truck->delete();

        return redirect()->route('truck');
    }
}
