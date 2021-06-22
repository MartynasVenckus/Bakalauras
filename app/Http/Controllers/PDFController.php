<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Driver;
use App\Models\Truck;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        $order = Order::find($id);
        $driverid = $order->fk_driver;
        $customerid = $order->fk_customer;
        $employeeid = $order->fk_employee;
        
        $driver = Driver::find($driverid);
        $truckid = $driver->fk_truck;
        $truck = Truck::find($truckid);
        $customer = Customer::find($customerid);
        $employee = Employee::find($employeeid);

        $dompdf = PDF::loadview('pdf.order', compact('order', 'driver', 'customer', 'employee', 'truck'));

        return $dompdf->stream('Užsakymo informacija.pdf');
    }
    public function payment($id)
    {
        $order = Order::find($id);
        $driverid = $order->fk_driver;
        $customerid = $order->fk_customer;
        $employeeid = $order->fk_employee;
        
        $driver = Driver::find($driverid);
        $truckid = $driver->fk_truck;
        $truck = Truck::find($truckid);
        $customer = Customer::find($customerid);
        $employee = Employee::find($employeeid);

        $dompdf = PDF::loadview('pdf.payment', compact('order', 'driver', 'customer', 'employee', 'truck'));

        return $dompdf->stream('Sąskaita.pdf');
    }
    public function consignment($id)
    {
        $order = Order::find($id);
        $driverid = $order->fk_driver;
        $customerid = $order->fk_customer;
        $employeeid = $order->fk_employee;
        
        $driver = Driver::find($driverid);
        $truckid = $driver->fk_truck;
        $truck = Truck::find($truckid);
        $customer = Customer::find($customerid);
        $employee = Employee::find($employeeid);

        $dompdf = PDF::loadview('pdf.consignment', compact('order', 'driver', 'customer', 'employee', 'truck'));

        return $dompdf->stream('Važtaraštis.pdf');
    }
}
