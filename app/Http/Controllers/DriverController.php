<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Truck;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        $trucks = Truck::all();

        $test = DB::table('drivers')
        ->select('drivers.*', 'trucks.brand AS brand', 'trucks.model AS model')
        ->leftJoin('trucks', 'drivers.fk_truck', '=', 'trucks.id')->paginate(10);

        return view('driver.list')->with('data', ['status' => '','drivers' => $drivers, 'driverdata' => $test, 'trucks' => $trucks]);
    }

    public function searchName(Request $request)
    {
        $search = $request->get('search');

        $drivers = Driver::all();
        $trucks = Truck::all();

        $test = DB::table('drivers')
        ->select('drivers.*', 'trucks.brand AS brand', 'trucks.model AS model')->where('drivers.name', 'like', '%'.$search.'%')
        ->leftJoin('trucks', 'drivers.fk_truck', '=', 'trucks.id')->paginate(10);

        if ($test->isEmpty()) { 
            return view('driver.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'drivers' => $drivers, 'driverdata' => $test, 'trucks' => $trucks]);
        }
        else{
            return view('driver.list')->with('data', ['status' => '', 'drivers' => $drivers, 'driverdata' => $test, 'trucks' => $trucks]);
        }

        
    }
    public function searchState(Request $request)
    {
        $search = $request->get('searchState');

        $drivers = Driver::all();
        $trucks = Truck::all();

        $test = DB::table('drivers')
        ->select('drivers.*', 'trucks.brand AS brand', 'trucks.model AS model')->where('drivers.status', 'like', '%'.$search.'%')
        ->leftJoin('trucks', 'drivers.fk_truck', '=', 'trucks.id')->paginate(10);

        if ($test->isEmpty()) { 
            return view('driver.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'drivers' => $drivers, 'driverdata' => $test, 'trucks' => $trucks]);
        }
        else{
            return view('driver.list')->with('data', ['status' => '', 'drivers' => $drivers, 'driverdata' => $test, 'trucks' => $trucks]);
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
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'fk_driver' => ''
        ],
        [
            'surname.required' => 'Pavardė yra privaloma.' 
        ]);
        Driver::add($request);

        return redirect()->route('driver');
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
            'name1' => 'required',
            'surname1' => 'required',
            'phone1' => 'required',
            'status1' => '',
            'fk_driver1' => ''
        ],
        [
            'surname1.required' => 'Pavardė yra privaloma.',
            'name1.required' => 'Vardas yra privalomas.',
            'phone1.required' => 'Telefono numeris yra privalomas.' 
        ]);


        Driver::updateMy($request, $request->input('driverid'));

        return redirect()->route('driver');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        $driver->delete();

        return redirect()->route('driver');
    }


}
