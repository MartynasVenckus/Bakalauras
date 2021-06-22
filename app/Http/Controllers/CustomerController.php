<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customer.list')->with('data', ['status' => '', 'customers'=> $customers]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $customers = DB::table('customers')->where('name', 'like', '%'.$search.'%')->paginate(10);
        // dd($customers);
        

        if ($customers->isEmpty()) { 
            return view('customer.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'customers'=> $customers]);
        }
        else{
            return view('customer.list')->with('data', ['status' => '', 'customers'=> $customers]);
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
            'address' => 'required',
            'town' => '',
            'nationality' => 'required',
            'email' => 'required',
            'phone' => '',
            'postalCode' => '',
            'companyCode' => 'required',
            'VATCode' => 'required',
            'bank' => 'required',
            'checkingAccount' => 'required'
        ],
        [
            'nationality.required' => 'Valstybė yra privaloma.',
            'checkingAccount.required' => 'Atsiskaitomoji sąskaita yra privaloma.',
        ]);

        Customer::add($request);

        return redirect()->route('customer');
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
            'address1' => 'required',
            'town1' => '',
            'nationality1' => 'required',
            'email1' => 'required',
            'phone1' => '',
            'postalCode1' => '',
            'companyCode1' => 'required',
            'VATCode1' => 'required',
            'bank1' => 'required',
            'checkingAccount1' => 'required'
        ],
        [
            'name1.required' => 'Pavadinimas yra privalomas.',
            'address1.required' => 'Adresas yra privalomas.',
            'nationality1.required' => 'Valstybė yra privaloma.',
            'email1.required' => 'Elektroninis paštas yra privalomas.',
            'companyCode1.required' => 'Įmonės kodas yra privalomas.',
            'VATCode1.required' => 'PVM mokėtojo kodas yra privalomas.',
            'bank1.required' => 'Bankas yra privalomas.',
            'checkingAccount1.required' => 'Atsiskaitomoji sąskaita yra privaloma.',
        ]);

        Customer::updateMy($request, $request->input('customerid'));


        return redirect()->route('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        $customers = Customer::paginate(10);

        return  redirect()->route('customer');
    }
}
