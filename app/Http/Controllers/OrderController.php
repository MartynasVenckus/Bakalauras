<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(10);
       
        $drivers = Driver::all();
        $emplyees = User::all();
        $customers = Customer::all();

        return view('order.list')->with('data', ['status' => '', 'orders' => $orders, 'drivers' => $drivers, 'employees' => $emplyees, 'customers' => $customers]);
    }

    public function searchDate(Request $request){

        $search = $request->get('search1');
        $search2 = $request->get('search2');

        $drivers = Driver::all();
        $emplyees = User::all();
        $customers = Customer::all();


        $orders = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->paginate(10);
        
        if ($orders->isEmpty()) { 
            return view('order.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'orders' => $orders, 'drivers' => $drivers, 'employees' => $emplyees, 'customers' => $customers]);
        }
        else{
            return view('order.list')->with('data', ['status' => '', 'orders' => $orders, 'drivers' => $drivers, 'employees' => $emplyees, 'customers' => $customers]);
        }
    }

    public function searchCustomer(Request $request)
    {
        $search = $request->get('search');
        $orders = Order::where(function ($query) {
            $query->select('name')
                ->from('customers')
                ->whereColumn('customers.id', 'orders.fk_customer');
        }, 'like', '%'.$search.'%')->paginate(10);

        $drivers = Driver::all();
        $emplyees = User::all();
        $customers = Customer::all();

        if ($orders->isEmpty()) { 
            return view('order.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'orders' => $orders, 'drivers' => $drivers, 'employees' => $emplyees, 'customers' => $customers]);
        }
        else{
            return view('order.list')->with('data', ['status' => '', 'orders' => $orders, 'drivers' => $drivers, 'employees' => $emplyees, 'customers' => $customers]);
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
            'deliveryDate' => 'required|date_format:Y-m-d\TH:i',
            'loadingAddress' => 'required|max:255',
            'deliveryAddress' => 'required|max:255',
            'price' => 'required|max:16',
            'purpose' => 'required|max:255',
            'deliveringTemperature' => 'max:16',
            'weight' => 'required|max:16',
            'size' => 'required',
            'count' => 'required|integer',
            'accountDeliveryDate' => '',
            'additionalInformation' => 'max:255',
            'fk_driver' => 'required',
            'fk_customer' => 'required',
            'fk_employee' => 'required'
        ],
        [
            'deliveryDate.required' => 'Pristatymo data yra privaloma.', 
            'deliveryDate.date_format' => 'Pristatymo data turi būti :format formato.',
            // 'accountDeliveryDate.date_format' => 'Sąskaitos nusiuntimo data turi būti :format formato.',
            'price.required' => 'Kaina yra privaloma.'

        ]);

        Order::add($request);

        return redirect()->route('order');
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
            'deliveryDate1' => 'required',
            'loadingAddress1' => 'required|max:255',
            'deliveryAddress1' => 'required|max:255',
            'price1' => 'required|max:16',
            'purpose1' => 'required|max:255',
            'deliveringTemperature1' => 'max:16',
            'weight1' => 'required|max:16',
            'size1' => 'required',
            'count1' => 'required|integer|max:16',
            'additionalInformation1' => 'max:255',
            'fk_driver1' => 'required',
            'fk_customer1' => 'required',
            'fk_employee1' => 'required'
        ],
        [
            'deliveryDate1.required' => 'Pristatymo data yra privaloma.', 
            'deliveryDate1.date_format' => 'Pristatymo data turi būti :format formato.',
            'accountDeliveryDate1.date_format' => 'Sąskaitos nusiuntimo data turi būti :format formato.',
            'price1.required' => 'Kaina yra privaloma.', 
            'loadingAddress1.required' => 'Pakrovimo adresas yra privalomas.' 

        ]);


        Order::updateMy($request, $request->input('orderid'));

        $orders = Order::paginate(10);

        return redirect()->route('order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        $orders = Order::paginate(10);

        return redirect()->route('order');
    }
}
