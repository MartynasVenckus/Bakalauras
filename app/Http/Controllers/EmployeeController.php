<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', '=', 'Darbuotojas')->paginate(10);
        
        return view('employee.list')->with('data', ['status' => '', 'users'=> $users]);
    }

    public function myProfile()
    {
        return view('employee.profile')->with('users', auth()->user());
    }

    public function myProfileEdit(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => '',
            'type' => 'required',
            'password' => '',
            'repeatpassword' => ''
        ],
        [
            'surname.required' => 'Pavardė yra privaloma.',
            'type.required' => 'Darbuotojo tipas yra privalomas.'
        ]);

        User::updateMyProfile($request, auth()->user()->id);

        return redirect()->route('main');


    }

    public function searchName(Request $request)
    {
        $search = $request->get('search');

        $users = User::where('type', '=', 'Darbuotojas')->where('name', 'like', '%'.$search.'%')->paginate(10);

        if ($users->isEmpty()) { 
            return view('employee.list')->with('data', ['status' => 'Nėra duomenų atitinkančių paiešką', 'users'=> $users]);
        }
        else{
            return view('employee.list')->with('data', ['status' => '', 'users'=> $users]);
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
            'email' => 'required',
            'phone' => '',
            'type' => 'required',
            'password' => 'required',
            'repeatpassword' => 'required'
        ],
        [
            'surname.required' => 'Pavardė yra privaloma.',
            'type.required' => 'Darbuotojo tipas yra privalomas.',
            'repeatpassword.required' => 'Slaptažodžio pakartojimas yra privalomas.'
        ]);

        User::add($request);

        return redirect()->route('employee');
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
            'email1' => 'required',
            'phone1' => '',
            'type1' => 'required',
            'password1' => '',
            'repeatpassword1' => ''
        ],
        [
            'surname1.required' => 'Pavardė yra privaloma.',
            'name1.required' => 'Darbuotojo vardas yra privalomas.',
            'email1.required' => 'Elektroninis paštas yra privalomas.',
            'type1.required' => 'Darbuotojo tipas yra privalomas.'
        ]);

        User::updateMy($request, $request->input('userid'));

        return redirect()->route('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('employee');
    }


}


