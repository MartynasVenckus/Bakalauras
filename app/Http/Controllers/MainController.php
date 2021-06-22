<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Order;
use \Datetime;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Europe/Vilnius');

        $delayedPaymentInfo = DB::table('orders')
            ->select(DB::raw('orders.*, DATEDIFF(orders.paymentTerm, CURRENT_TIMESTAMP()) AS diff, customers.name AS custName, customers.email AS custEmail'))
            ->havingRaw('diff <= ?', [2])
            ->leftJoin('customers', 'orders.fk_customer', '=', 'customers.id')
            ->where('fk_employee', '=', auth()->user()->id)
            ->where('paymentStatus', '!=', "Sumokėta")
            ->get()->toArray();

        
        $count = count($delayedPaymentInfo);

        if($count != 0)
        {
            for($i=0; $i<$count; $i++){

                if($delayedPaymentInfo[$i]->notStatus == "Neišsiųsta"){
                    $orderid = $delayedPaymentInfo[$i]->id;
                    $purpose = $delayedPaymentInfo[$i]->purpose;
                    $paymentTerm = $delayedPaymentInfo[$i]->paymentTerm;
                    $remainingtime = $delayedPaymentInfo[$i]->diff;
                    $custName = $delayedPaymentInfo[$i]->custName;
                    $custEmail = $delayedPaymentInfo[$i]->custEmail;

                    Notification::send(auth()->user(), new PaymentNotification($orderid, $purpose, $custName, $custEmail, $paymentTerm, $remainingtime));

                    $order = Order::find($orderid);
                    $order->notStatus = "Išsiųsta";
                    $order->save();
                }
            }
        }
        return view('main')->with('user', auth()->user());
    }

    public function notification(){
        return view('notification.list')->with('user', auth()->user());
    }
    public function notificationMark(Request $request){

        auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();
        return redirect()->back();
        
    }
}
