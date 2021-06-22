<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Order extends Model
{
    public $timestamps = false;
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deliveryDate',
        'loadingAddress',
        'deliveryAddress',
        'price',
        'purpose',
        'deliveringTemperature',
        'weight',
        'size',
        'length',
        'width',
        'height',
        'count',
        'orderStatus',
        'accountDeliveryDate',
        'paymentTerm',
        'paymentStatus',
        'additionalInformation',
        'fk_driver',
        'fk_customer',
        'fk_employee',
    ];

    public static function add(Request $request){

        $order = new Order;

        $order->deliveryDate = $request->input('deliveryDate');;
        $order->loadingAddress = $request->input('loadingAddress');
        $order->deliveryAddress = $request->input('deliveryAddress');
        $order->price = $request->input('price');
        $order->purpose = $request->input('purpose');
        $order->deliveringTemperature = $request->input('deliveringTemperature');
        $order->weight = $request->input('weight');
        $order->size = $request->input('size');
        $order->length = $request->input('length');
        $order->width = $request->input('width');
        $order->height = $request->input('height');
        $order->count = $request->input('count');
        $order->orderStatus = $request->input('orderStatus');
        $order->accountDeliveryDate = date('Y-m-d H:i:s', strtotime($request->input('accountDeliveryDate')));
        $order->paymentTerm = date('Y-m-d H:i:s', strtotime($request->input('accountDeliveryDate'). ' + 14 days'));
        $order->paymentStatus = $request->input('paymentStatus');
        $order->additionalInformation = $request->input('additionalInformation');
        $order->fk_driver = $request->input('fk_driver');
        $order->fk_customer = $request->input('fk_customer');
        $order->fk_employee = $request->input('fk_employee');

        $order->save();

        return $order;
    }

    public static function updateMy(Request $request, $id){

        $order = Order::find($id);
        
        $order->deliveryDate = $request->input('deliveryDate1');;
        $order->loadingAddress = $request->input('loadingAddress1');
        $order->deliveryAddress = $request->input('deliveryAddress1');
        $order->price = $request->input('price1');
        $order->purpose = $request->input('purpose1');
        $order->deliveringTemperature = $request->input('deliveringTemperature1');
        $order->weight = $request->input('weight1');
        $order->size = $request->input('size1');
        $order->length = $request->input('length');
        $order->width = $request->input('width');
        $order->height = $request->input('height');
        $order->count = $request->input('count1');
        $order->orderStatus = $request->input('orderStatus1');
        $order->accountDeliveryDate = date('Y-m-d H:i:s', strtotime($request->input('accountDeliveryDate1')));
        $order->paymentTerm = date('Y-m-d H:i:s', strtotime($request->input('accountDeliveryDate1'). ' + 14 days'));
        $order->paymentStatus = $request->input('paymentStatus1');
        $order->additionalInformation = $request->input('additionalInformation1');
        $order->fk_driver = $request->input('fk_driver1');
        $order->fk_customer = $request->input('fk_customer1');
        $order->fk_employee = $request->input('fk_employee1');

        $order->save();

    }
}
