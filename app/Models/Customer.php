<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Customer extends Model
{
    public $timestamps = false;
    use HasFactory;

    
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'name',
        'town',
        'nationality',
        'email',
        'phone',
        'postalCode',
        'companyCode',
        'VATCode',
        'bank',
        'checkingAccount',
    ];

    
    public static function add(Request $request){

        $customer = new Customer;
        
        $customer->address = $request->input('address');
        $customer->name = $request->input('name');
        $customer->town = $request->input('town');
        $customer->nationality = $request->input('nationality');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->postalCode = $request->input('postalCode');
        $customer->companyCode = $request->input('companyCode');
        $customer->VATCode = $request->input('VATCode');
        $customer->bank = $request->input('bank');
        $customer->checkingAccount = $request->input('checkingAccount');

        $customer->save();

        return $customer;
    }

    public static function updateMy(Request $request, $id){

        $customer = Customer::find($id);
        
        $customer->address = $request->input('address1');
        $customer->name = $request->input('name1');
        $customer->town = $request->input('town1');
        $customer->nationality = $request->input('nationality1');
        $customer->email = $request->input('email1');
        $customer->phone = $request->input('phone1');
        $customer->postalCode = $request->input('postalCode1');
        $customer->companyCode = $request->input('companyCode1');
        $customer->VATCode = $request->input('VATCode1');
        $customer->bank = $request->input('bank1');
        $customer->checkingAccount = $request->input('checkingAccount1');

        $customer->save();

    }
    
}
