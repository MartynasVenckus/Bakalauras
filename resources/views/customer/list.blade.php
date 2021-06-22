<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Užsakovai</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    

</head>
<body>


<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Užsakovai</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>



<div class="ml-8 mr-8 ">
  <div class="flex p-2 border-1 border-r border-t" style="background-color: #e2e3e5; border: #cccdcf solid 1px;">
    <button type="button" class=" p-0 flex-initial w-14 btn btn-success mr-12" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <div class="flex-initial">
      <form action="{{ route('customersSearch') }}" method="get">
        <div class="input-group">
          <div class="flex items-center text-lg font-medium mr-3">Ieškoti pagal pavadinimą</div>
          <input type="search" name="search" class="form-control">
            <span class="input-group-prepend">
              <button type="submit" class="btn btn-primary ml-3 w-14 flex items-center">
              <i class="fa fa-search fa-1x" aria-hidden="true"></i>
              </button>
            </span>
        </div>
      </form>
    </div>
  </div>
<div>

<table id="dataTable" class="table table-bordered table-hover ">
  <thead class="table-light">
    <tr>
      <th scope="col">Užsakovo numeris</th>
      <th scope="col">Pavadinimas</th>
      <th scope="col">Adresas</th>
      <th scope="col">Telofono numeris</th>
      <th scope="col">Elektroninis paštas</th>
      <th scope="col">Valstybė</th>
      <th scope="col">Įmonės kodas</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>


  
  <tbody>
    @foreach($data['customers'] as $customer)
    <tr data-bs-target="#ShowModal" data-bs-toggle="modal" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" data-address="{{ $customer->address }}" data-town="{{ $customer->town }}"
        data-nationality="{{ $customer->nationality }}" data-email="{{ $customer->email }}" data-phone="{{ $customer->phone }}" data-postalcode="{{ $customer->postalCode }}"
        data-companycode="{{ $customer->companyCode }}" data-vatcode="{{ $customer->VATCode }}" data-bank="{{ $customer->bank }}" data-checkingaccount="{{ $customer->checkingAccount }}">
      <td>{{ $customer->id }}</td>
      <td>{{ $customer->name }}</td>
      <td>{{ $customer->address }}</td>
      <td>{{ $customer->phone }}</td>
      <td>{{ $customer->email }}</td>
      <td>{{ $customer->nationality }}</td>
      <td>{{ $customer->companyCode }}</td>
      <td>
     
        <!-- edit button trigger modal   -->
        <button class="btn" data-bs-target="#EditModal" data-bs-toggle="modal" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" data-address="{{ $customer->address }}" data-town="{{ $customer->town }}"
        data-nationality="{{ $customer->nationality }}" data-email="{{ $customer->email }}" data-phone="{{ $customer->phone }}" data-postalcode="{{ $customer->postalCode }}"
        data-companycode="{{ $customer->companyCode }}" data-vatcode="{{ $customer->VATCode }}" data-bank="{{ $customer->bank }}" data-checkingaccount="{{ $customer->checkingAccount }}"><i class="fa fa-pencil-square-o fa-2x text-yellow-500" aria-hidden="true"></i></button>

        <!-- delete utton trigger modal -->
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-id="{{ $customer->id }}"><i class="fa fa-trash-o fa-2x text-red-600" aria-hidden="true"></i></button> 
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@if ($data['status'])
                <div class="p-4 rounded-lg mb-6 text-center">
                    {{ $data['status'] }}
                    <br>
                    <button type="button"  class="btn btn-success mt-10" onclick="window.location='{{ route("customer") }}'">Grįžti į sąrašą</button>
                </div>
            @endif

<span>
    {{$data['customers']->onEachSide(1)->links()}}
</span>

<style>
  td, th {
  text-align: center;
  vertical-align: middle;
}
      p{
        display: none;
      }
      .w-5{
        max-width: 1rem;
      }
</style>
</div>
</div>

<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="AddModalLabel">Pridėti užsakovą</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('addCustomer') }}" method="post">
      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="name">Pavadinimas*</label>
                        <input type="text"  name="name" placeholder="Įveskite pavadinimą" class="form-control
                        text-grey-darker @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="address">Adresas*</label>
                        <input type="text" name="address" placeholder="Įveskite adresą" class="form-control
                        text-grey-darker @error('address') border-red-500 @enderror" value="{{ old('address') }}">

                        @error('address')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="town">Miestas</label>
                        <input type="text" name="town" placeholder="Įveskite miestą" class="form-control
                        text-grey-darker @error('town') border-red-500 @enderror" value="{{ old('town') }}">

                        @error('town')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="nationality">Valstybė*</label>
                        <input type="text"  name="nationality" placeholder="Įveskite valstybę" class="form-control
                        text-grey-darker @error('nationality') border-red-500 @enderror" value="{{ old('nationality') }}">

                        @error('nationality')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="email">Elektroninis paštas*</label>
                        <input type="email"  name="email" placeholder="Įveskite elektroninį paštą" class="form-control
                        text-grey-darker @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="phone">Telefono numeris</label>
                        <input type="text" name="phone" placeholder="Įveskite telefono numerį" class="form-control
                        text-grey-darker @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">

                        @error('phone')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-1"></div>
           
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="postalCode">Pašto kodas</label>
                        <input type="text"  name="postalCode" placeholder="Įveskite pašto kodą" class="form-control
                        text-grey-darker @error('postalCode') border-red-500 @enderror" value="{{ old('postalCode') }}">

                        @error('postalCode')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="companyCode">Įmonės kodas*</label>
                        <input type="text"  name="companyCode" placeholder="Įveskite imonės kodą" class="form-control
                        text-grey-darker @error('companyCode') border-red-500 @enderror" value="{{ old('companyCode') }}">

                        @error('companyCode')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="VATCode">PVM mokėtojo kodas*</label>
                        <input type="text"  name="VATCode" placeholder="Įveskite PVM mokėtojo kodą" class="form-control
                        text-grey-darker @error('VATCode') border-red-500 @enderror" value="{{ old('VATCode') }}">

                        @error('VATCode')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="bank">Bankas*</label>
                        <input type="text"  name="bank" placeholder="Įveskite banką" class="form-control
                        text-grey-darker @error('bank') border-red-500 @enderror" value="{{ old('bank') }}">

                        @error('bank')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="checkingAccount">Atsiskaitomoji sąskaita*</label>
                        <input type="text"  name="checkingAccount" placeholder="Įveskite atsiskaitomąją sąskaitą" class="form-control
                        text-grey-darker @error('checkingAccount') border-red-500 @enderror" value="{{ old('checkingAccount') }}">

                        @error('checkingAccount')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Atšaukti</button>
            <button type="subbmit button" class="btn btn-success">Išsaugoti</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="ShowModalLabel">Užsakovo informacija</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="ShowForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label class="" for="name">Pavadinimas</label>
                        <input type="text" class="form-control" id="name" name="name" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="address">Adresas</label>
                        <input type="text" class="form-control" id="address" name="address" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="town">Miestas</label>
                        <input type="text" class="form-control" id="town" name="town" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="nationality">Valstybė</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="email">Elektroninis paštas</label>
                        <input type="email" class="form-control" id="email" name="email" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="phone">Telefono numeris</label>
                        <input type="text" class="form-control" id="phone" name="phone" readonly>
                    </div>
                </div>

                <div class="col-1"></div>
           
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="postalCode">Pašto kodas</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="companyCode">Įmonės kodas</label>
                        <input type="text" class="form-control" id="companyCode" name="companyCode" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="VATCode">PVM mokėtojo kodas</label>
                        <input type="text" class="form-control" id="VATCode" name="VATCode" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="bank">Bankas</label>
                        <input type="text" class="form-control" id="bank" name="bank" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="checkingAccount">Atsiskaitomoji sąskaita</label>
                        <input type="text" class="form-control" id="checkingAccount" name="checkingAccount" readonly>
                    </div>
                </div>
            </div>          
        </div>
        

      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="DeleteModalLabel">Pašalinti užsakovą</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/uzsakovai/salinti" method="post" id="DeleteForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center text-center p-5">
                <h5>Ar tikrai norite pašalinti užsakovą?</h5>
            </div>          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Atšaukti</button>
            <button type="subbmit" class="btn btn-success">Išsaugoti</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="EditModalLabel">Redaguoti užsakovą</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/uzsakovai/redaguoti/value" method="post" id="EditForm">

      @csrf
      @method('POST')

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="name1">Pavadinimas*</label>
                        <input type="text"  id="name1" name="name1" placeholder="Įveskite pavadinimą" class="form-control
                        text-grey-darker @error('name1') border-red-500 @enderror" value="{{ old('name1') }}">

                        @error('name1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="address1">Adresas*</label>
                        <input type="text"  id="address1" name="address1" placeholder="Įveskite adresą" class="form-control
                        text-grey-darker @error('address1') border-red-500 @enderror" value="{{ old('address1') }}">

                        @error('address1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="town1">Miestas</label>
                        <input type="text" id="town1" name="town1" placeholder="Įveskite miestą"  class="form-control
                        text-grey-darker @error('town1') border-red-500 @enderror" value="{{ old('town1') }}">

                        @error('town1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="nationality1">Valstybė*</label>
                        <input type="text" id="nationality1" name="nationality1" placeholder="Įveskite valstybę" class="form-control
                        text-grey-darker @error('nationality1') border-red-500 @enderror" value="{{ old('nationality1') }}">

                        @error('nationality1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="email1">Elektroninis paštas*</label>
                        <input type="email"  id="email1" name="email1" placeholder="Įveskite elektroninį paštą" class="form-control
                        text-grey-darker @error('email1') border-red-500 @enderror" value="{{ old('email1') }}">

                        @error('email1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="phone1">Telefono numeris</label>
                        <input type="text"  id="phone1" name="phone1" placeholder="Įveskite telefono numerį" class="form-control
                        text-grey-darker @error('phone1') border-red-500 @enderror" value="{{ old('phone1') }}">

                        @error('phone1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-1"></div>
           
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="postalCode1">Pašto kodas</label>
                        <input type="text" id="postalCode1" name="postalCode1" placeholder="Įveskite pašto kodą" class="form-control
                        text-grey-darker @error('postalCode1') border-red-500 @enderror" value="{{ old('postalCode1') }}">

                        @error('postalCode1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-grouppb-2">
                        <label for="companyCode1">Įmonės kodas*</label>
                        <input type="text"  id="companyCode1" name="companyCode1" placeholder="Įveskite imonės kodą" class="form-control
                        text-grey-darker @error('companyCode1') border-red-500 @enderror" value="{{ old('companyCode1') }}">

                        @error('companyCode1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="VATCode1">PVM mokėtojo kodas*</label>
                        <input type="text" id="VATCode1" name="VATCode1" placeholder="Įveskite PVM mokėtojo kodą" class="form-control
                        text-grey-darker @error('VATCode1') border-red-500 @enderror" value="{{ old('VATCode1') }}">

                        @error('VATCode1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="bank1">Bankas*</label>
                        <input type="text" id="bank1" name="bank1" placeholder="Įveskite banką" class="form-control
                        text-grey-darker @error('bank1') border-red-500 @enderror" value="{{ old('bank1') }}">

                        @error('bank1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="checkingAccount1">Atsiskaitomoji sąskaita*</label>
                        <input type="text"  id="checkingAccount1" name="checkingAccount1" placeholder="Įveskite atsiskaitomąją sąskaitą" class="form-control
                        text-grey-darker @error('checkingAccount1') border-red-500 @enderror" value="{{ old('checkingAccount1') }}">

                        @error('checkingAccount1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2" style="visibility:hidden">
                        <input type="text" id="customerid" name="customerid" class="form-control" value="{{ old('customerid') }}">
                    </div>
                </div>
            </div>          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Atšaukti</button>
            <button type="subbmit" class="btn btn-success">Išsaugoti</button>
        </div>

      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>


<script>

@error ('name')
$('#AddModal').modal('show');
@enderror
@error ('address')
    $('#AddModal').modal('show');
@enderror
@error ('town')
    $('#AddModal').modal('show');
@enderror
@error ('nationality')
    $('#AddModal').modal('show');
@enderror
@error ('email')
$('#AddModal').modal('show');
@enderror
@error ('phone')
    $('#AddModal').modal('show');
@enderror
@error ('postalCode')
    $('#AddModal').modal('show');
@enderror
@error ('companyCode')
    $('#AddModal').modal('show');
@enderror
@error ('VATCode')
$('#AddModal').modal('show');
@enderror
@error ('bank')
    $('#AddModal').modal('show');
@enderror
@error ('checkingAccount')
    $('#AddModal').modal('show');
@enderror



@error ('name1')
$('#EditModal').modal('show');
@enderror
@error ('address1')
    $('#EditModal').modal('show');
@enderror
@error ('town1')
    $('#EditModal').modal('show');
@enderror
@error ('nationality1')
    $('#EditModal').modal('show');
@enderror
@error ('email1')
$('#EditModal').modal('show');
@enderror
@error ('phone1')
    $('#EditModal').modal('show');
@enderror
@error ('postalCode1')
    $('#EditModal').modal('show');
@enderror
@error ('companyCode1')
    $('#EditModal').modal('show');
@enderror
@error ('VATCode1')
$('#EditModal').modal('show');
@enderror
@error ('bank1')
    $('#EditModal').modal('show');
@enderror
@error ('checkingAccount1')
    $('#EditModal').modal('show');
@enderror


</script>

<script>
var data = <?php echo count($data['customers']);?>

if(data >= 10){
  var pageNav = document.querySelector('[class="flex justify-between flex-1 sm:hidden"]');
  pageNav.style.display = 'none';

  var pageNumb =  document.querySelector('[class="relative z-0 inline-flex shadow-sm rounded-md"]');
}
</script>

<script>

function showAllBtn () {
  console.log('here');
   $('#allBtn').show(); 
   }
</script>

<script type="text/javascript">

    $(document).on('show.bs.modal','#DeleteModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')

       var modal = $(this)

       $('#DeleteForm').attr('action', '/uzsakovai/salinti/'+id)
})

</script>
<script type="text/javascript">

    $(document).on('show.bs.modal','#ShowModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var name = button.data('name')
       var address = button.data('address')
       var town = button.data('town')
       var nationality = button.data('nationality')
       var email = button.data('email')
       var phone = button.data('phone')
       var postalcode = button.data('postalcode')
       var companycode = button.data('companycode')
       var vatcode = button.data('vatcode')
       var bank = button.data('bank')
       var checkingaccount = button.data('checkingaccount')
       
      console.log(address);
       var modal = $(this)

       modal.find('.modal-body #name').val(name);
       modal.find('.modal-body #address').val(address);
       modal.find('.modal-body #town').val(town);
       modal.find('.modal-body #nationality').val(nationality);
       modal.find('.modal-body #email').val(email);
       modal.find('.modal-body #phone').val(phone);
       modal.find('.modal-body #postalCode').val(postalcode);
       modal.find('.modal-body #companyCode').val(companycode);
       modal.find('.modal-body #VATCode').val(vatcode);
       modal.find('.modal-body #bank').val(bank);
       modal.find('.modal-body #checkingAccount').val(checkingaccount);

       //$('#ShowForm').attr('action', '//uzsakovai/salinti/'+id)
})
</script>

<script type="text/javascript">

    $(document).on('show.bs.modal','#EditModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var name = button.data('name')
       var address = button.data('address')
       var town = button.data('town')
       var nationality = button.data('nationality')
       var email = button.data('email')
       var phone = button.data('phone')
       var postalcode = button.data('postalcode')
       var companycode = button.data('companycode')
       var vatcode = button.data('vatcode')
       var bank = button.data('bank')
       var checkingaccount = button.data('checkingaccount')
       

       var modal = $(this)

       modal.find('.modal-body #name1').val(name);
       modal.find('.modal-body #customerid').val(id);
       modal.find('.modal-body #address1').val(address);
       modal.find('.modal-body #town1').val(town);
       modal.find('.modal-body #nationality1').val(nationality);
       modal.find('.modal-body #email1').val(email);
       modal.find('.modal-body #phone1').val(phone);
       modal.find('.modal-body #postalCode1').val(postalcode);
       modal.find('.modal-body #companyCode1').val(companycode);
       modal.find('.modal-body #VATCode1').val(vatcode);
       modal.find('.modal-body #bank1').val(bank);
       modal.find('.modal-body #checkingAccount1').val(checkingaccount);

       $('#EditForm').attr('action', '/uzsakovai/redaguoti/'+id)
})
</script>

</body>
</html>