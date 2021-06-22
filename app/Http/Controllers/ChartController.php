<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class ChartController extends Controller
{
    public function PieChart(){
        //Orders
        $doneCount = Order::where('orderStatus', 'Atlikta')->count();
        $inProcessCount = Order::where('orderStatus', 'Vykdoma')->count();
        $canceledCount = Order::where('orderStatus', 'Atšaukta')->count();

        //Payments
        $sentCount = Order::where('paymentStatus', 'Išsiųsta')->count();
        $notSentCount = Order::where('paymentStatus', 'Neišsiųsta')->count();
        $payedCount = Order::where('paymentStatus', 'Sumokėta')->count();

        $data = array($doneCount, $inProcessCount, $canceledCount, $payedCount, $sentCount, $notSentCount,);

        return view('charts.chart')->with('data', ['statusorder' => '', 'statuspayment' => '', 'data' => $data]);
    }

    public function orderChartSearch (Request $request){

        $search = $request->get('search1');
        $search2 = $request->get('search2');

        //Orders
        $doneCount = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->where('orderStatus', 'Atlikta')->count();;
        $inProcessCount = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->where('orderStatus', 'Vykdoma')->count();
        $canceledCount = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->where('orderStatus', 'Atšaukta')->count();

        //Payments
        $sentCount = Order::where('paymentStatus', 'Išsiųsta')->count();
        $notSentCount = Order::where('paymentStatus', 'Neišsiųsta')->count();
        $payedCount = Order::where('paymentStatus', 'Sumokėta')->count();

        $data = array($doneCount, $inProcessCount, $canceledCount, $payedCount, $sentCount, $notSentCount,);

        if($doneCount == 0 && $inProcessCount == 0 && $canceledCount == 0)
        {
            return view('charts.chart')->with('data', ['statusorder' => 'Nėra duomenų pagal paiešką', 'statuspayment' => '', 'data' => $data]);
        }
        return view('charts.chart')->with('data', ['statusorder' => '', 'statuspayment' => '', 'data' => $data]);
    }

    public function paymentChartSearch (Request $request){

        $search = $request->get('search1');
        $search2 = $request->get('search2');

        //Orders
        $doneCount = Order::where('orderStatus', 'Atlikta')->count();;
        $inProcessCount = Order::where('orderStatus', 'Vykdoma')->count();
        $canceledCount = Order::where('orderStatus', 'Atšaukta')->count();

        //Payments
        $sentCount = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->where('paymentStatus', 'Išsiųsta')->count();
        $notSentCount = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->where('paymentStatus', 'Neišsiųsta')->count();
        $payedCount = Order::whereDate('creationDate', '>=', $search)->whereDate('creationDate', '<=', $search2)->where('paymentStatus', 'Sumokėta')->count();

        $data = array($doneCount, $inProcessCount, $canceledCount, $payedCount, $sentCount, $notSentCount,);

        if($payedCount == 0 && $sentCount == 0 && $notSentCount == 0)
        {
            return view('charts.chart')->with('data', ['statusorder' => '', 'statuspayment' => 'Nėra duomenų pagal paiešką', 'data' => $data]);
        }
        return view('charts.chart')->with('data', ['statusorder' => '', 'statuspayment' => '', 'data' => $data]);
    }
    
}
