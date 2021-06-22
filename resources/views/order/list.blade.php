<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Užsakymai</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
</head>
<body>



<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Užsakymai</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>



<div class="ml-8 mr-8 ">
  <div class="flex p-2 border-l border-r border-t border-b-0" style="background-color: #e2e3e5; border: #cccdcf solid 1px;">
    <button type="button" class=" p-0 flex-initial w-14 btn btn-success mr-12" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>

    <div class="flex-initial">
                    <div class="flex-initial mr-12">
                        <form action="{{ route('orderDateSearch') }}" method="get">
                            <div class="input-group">
                            <div class="flex items-center text-lg font-medium mr-3">Užskaymų data - Nuo: </div>
                            <input type="date" name="search1" class="form-control mr-2">
                            <div class="flex items-center text-lg font-medium mr-3">Iki: </div>
                            <input type="date" name="search2" class="form-control">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn btn-primary ml-3 w-14 flex items-center">
                                <i class="fa fa-search fa-1x" aria-hidden="true"></i>
                                </button>
                            </span>
                            </div>
                        </form>
                    </div>
            </div>
    
    <div class="flex-initial">
      <form action="{{ route('orderCustomersSearch') }}" method="get">
        <div class="input-group">
          <div class="flex items-center text-lg font-medium mr-3">Užsakovas</div>                   
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

 

<table id="dataTable" class="table table-bordered table-hover" >
  <thead class="table-light">
    <tr>
      <th scope="col">Užsakymo numeris</th>
      <th scope="col">Užsakymo pristatymo data</th>
      <th scope="col">Pristatymo adresas</th>
      <th scope="col">Užsakymo paskirtis</th>
      <th scope="col">Užsakymo statusas</th>
      <th scope="col">Užsakovas</th>
      <th scope="col">Papildoma informacija</th>
      <th scope="col">Dokumentų generavimas</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>

  <tbody>
  
    @foreach($data['orders'] as $order)
        @foreach($data['customers'] as $customer)
            @foreach($data['drivers'] as $driver)
                @foreach($data['employees'] as $employee)
                    @if($order->fk_customer == $customer->id && $order->fk_driver == $driver->id && $order->fk_employee == $employee->id) 
                        <tr data-bs-target="#ShowModal" data-bs-toggle="modal"
                        data-id="{{ $order->id }}" data-ddate="{{ $order->deliveryDate }}" data-cdate="{{ $order->creationDate }}"
                        data-laddress="{{ $order->loadingAddress }}" data-daddress="{{ $order->deliveryAddress }}" data-price="{{ $order->price }}" data-purpose="{{ $order->purpose }}"
                        data-dtemp="{{ $order->deliveringTemperature }}" data-weight="{{ $order->weight }}" data-size="{{ $order->size }}" data-length="{{ $order->length }}"
                        data-width="{{ $order->width }}" data-height="{{ $order->height }}" data-count="{{ $order->count }}" data-ostatus="{{ $order->orderStatus }}"
                        data-addate="{{ $order->accountDeliveryDate }}"  data-pterm="{{ $order->paymentTerm }}" data-pstatus="{{ $order->paymentStatus }}" data-ainfo="{{ $order->additionalInformation }}"
                        data-driver="{{ $driver->name }} {{ $driver->surname }}" data-customer="{{ $customer->name }}" data-employee="{{ $employee->name }} {{ $employee->surname }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->deliveryDate }}</td>
                        <td>{{ $order->deliveryAddress }}</td>
                        <td>{{ $order->purpose }}</td>
                        <td>{{ $order->orderStatus }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $order->additionalInformation }}</td>
                        <td>  
                            <a id="lol" type="button" class="btn btn-secondary no-modal" href="{{ url('uzsakymoInformacija/'.$order->id) }}" target="_blank">Užsakymas</a>
                            <a type="button" class="btn btn-secondary no-modal" href="{{ url('saskaita/'.$order->id) }}" target="_blank">Sąskaita</a>
                            <a type="button" class="btn btn-secondary no-modal" href="{{ url('vaztarastis/'.$order->id) }}" target="_blank">Važtaraštis</a>
                        </td>
                        <td>
                            <!-- edit button trigger modal   -->
                            <button class="btn" data-bs-target="#EditModal" data-bs-toggle="modal" 
                            data-id="{{ $order->id }}" data-ddate="{{ $order->deliveryDate }}" data-cdate="{{ $order->creationDate }}"
                            data-laddress="{{ $order->loadingAddress }}" data-daddress="{{ $order->deliveryAddress }}" data-price="{{ $order->price }}" data-purpose="{{ $order->purpose }}"
                            data-dtemp="{{ $order->deliveringTemperature }}" data-weight="{{ $order->weight }}" data-size="{{ $order->size }}" data-length="{{ $order->length }}"
                            data-width="{{ $order->width }}" data-height="{{ $order->height }}" data-count="{{ $order->count }}" data-ostatus="{{ $order->orderStatus }}"
                            data-addate="{{ $order->accountDeliveryDate }}" data-pterm="{{ $order->paymentTerm }}" data-pstatus="{{ $order->paymentStatus }}" data-ainfo="{{ $order->additionalInformation }}"
                            data-driver="{{ $driver->id }}, {{$driver->name}}, {{ $driver->surname }}" data-customer="{{ $customer->id }}, {{ $customer->name }}"
                            data-employee="{{ $employee->id }}, {{ $employee->name }}, {{ $employee->surname }}"><i class="fa fa-pencil-square-o fa-2x text-yellow-500" aria-hidden="true"></i></button>

                            <!-- delete utton trigger modal -->
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-id="{{ $order->id }}"><i class="fa fa-trash-o fa-2x text-red-600" aria-hidden="true"></i></button> 
                        </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @endforeach
    @endforeach
  </tbody>
</table>

@if ($data['status'])
                <div class="p-4 rounded-lg mb-6 text-center">
                    {{ $data['status'] }}
                    <br>
                    <button type="button"  class="btn btn-success mt-10" onclick="window.location='{{ route("order") }}'">Grįžti į sąrašą</button>
                </div>
            @endif
<span>
    {{$data['orders']->onEachSide(1)->links()}}
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
        <h5 class="modal-title" id="AddModalLabel">Pridėti užsakymą</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('addOrder') }}" method="post">
      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col font-semibold">
                <div class="mb-6 font-bold text-lg">Užsakymo Informacija</div>
                    <div class="form-group pb-2">
                        <label for="deliveryDate">Pristatymo data*</label>
                        <input type="datetime-local" name="deliveryDate" placeholder="Įveskite pristatymo datą" class="form-control
                        text-grey-darker @error('deliveryDate') border-red-500 @enderror" value="{{ old('deliveryDate') }}">

                    @error('deliveryDate')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="deliveryAddress">Pristatymo Adresas*</label>
                        <input type="text" name="deliveryAddress" placeholder="Įveskite pristatymo adresą" class="form-control
                        text-grey-darker @error('deliveryAddress') border-red-500 @enderror" value="{{ old('deliveryAddress') }}">

                    @error('deliveryAddress')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="loadingAddress">Pakrovimo Adresas*</label>
                        <input type="text"  name="loadingAddress" placeholder="Įveskite pakrovimo adresą" class="form-control
                        text-grey-darker @error('loadingAddress') border-red-500 @enderror" value="{{ old('loadingAddress') }}">

                            @error('loadingAddress')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_customer">Užsakovas*</label>
                        <select name="fk_customer" class="form-control">
                        <option hidden disabled selected value="{{old('fk_customer')}}"> 
                         @foreach($data['customers'] as $customer)
                                @if($customer->id == old('fk_customer'))
                                {{ $customer->name}}
                                @break
                                @endif
                                    @if($loop->last)
                                        -- Pasirinkite užsakovą --
                                    @endif
                            @endforeach 
                        </option>
                            @foreach($data['customers'] as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_customer') border-red-500 @enderror">
                            @error('fk_customer')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>  
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_driver">Vairuotojas*</label>
                        <select class="form-control" name="fk_driver" placeholder="Pasirinkite vairuotoją">
                        <option hidden disabled selected value="{{old('fk_driver')}}"> 
                         @foreach($data['drivers'] as $driver)
                                @if($driver->id == old('fk_driver'))
                                {{ $driver->name}} {{ $driver->surname }}
                                @break
                                @endif
                                    @if($loop->last)
                                        -- Pasirinkite vairuotoją --
                                    @endif
                            @endforeach 
                            </option>
                            @foreach($data['drivers'] as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }} {{ $driver->surname }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_driver') border-red-500 @enderror">
                            @error('fk_driver')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_employee">Darbuotojas</label>
                        <select class="form-control" name="fk_employee" placeholder="Darbuotojas">
                        <option hidden disabled selected value="{{old('fk_employee')}}"> 
                         @foreach($data['employees'] as $employee)
                                @if($employee->id == old('fk_employee'))
                                {{ $employee->name}} {{ $employee->surname }} {{old('fk_employee')}}
                                @break
                                @endif
                                    @if($loop->last)
                                        -- Pasirinkite darbuotoją --
                                    @endif
                            @endforeach 
                            </option>
                            @foreach($data['employees'] as $employee)
                                <option  value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->surname }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_employee') border-red-500 @enderror">
                            @error('fk_employee')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="additionalInformation">Papildoma informacija</label>
                        <textarea class="form-control" name="additionalInformation" placeholder="Papildoma informacija"autocomplete="additionalInformation" autofocus>{{ old('additionalInformation') }}</textarea>
                        <span type="text" class="text-grey-darker @error('additionalInformation') border-red-500 @enderror">
                            @error('additionalInformation')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                </div>

                <div class="col font-semibold">
                    <div class="invisible mb-6">Užsakymo Informacija</div>

                    <div class="form-group pb-2">
                        <label for="orderStatus">Užsakymo būsena</label>
                        <select class="form-control" name="orderStatus" placeholder="Pasirinkite dydį">
                            <option hidden disabled selected value> -- Pasirinkite užsakymo būseną -- </option>
                            <option {{ old('orderStatus') == "Atlikta" ? 'selected="selected"' : '' }} value="Atlikta">Atlikta</option>
                            <option {{ old('orderStatus') == "Vykdoma" ? 'selected="selected"' : '' }} value="Vykdoma">Vykdoma</option>
                            <option {{ old('orderStatus') == "Atšaukta" ? 'selected="selected"' : '' }} value="Atšaukta">Atšaukta</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('orderStatus') border-red-500 @enderror">
                            @error('orderStatus')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>

                    <div class="form-group pb-2">
                        <label for="paymentStatus">Sąskaitos būsena</label>
                        <select class="form-control" name="paymentStatus" placeholder="Pasirinkite sąskaitos būseną">
                            <option hidden disabled selected value> -- Pasirinkite sąskaitos būseną-- </option>
                            <option {{ old('paymentStatus') == "Išsiųsta" ? 'selected="selected"' : '' }} value="Išsiųsta">Išsiųsta</option>
                            <option {{ old('paymentStatus') == "Neišsiųsta" ? 'selected="selected"' : '' }} value="Neišsiųsta">Neišsiųsta</option>
                            <option {{ old('paymentStatus') == "Sumokėta" ? 'selected="selected"' : '' }} value="Sumokėta">Sumokėta</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('paymentStatus') border-red-500 @enderror">
                            @error('paymentStatus')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="accountDeliveryDate">Sąskaitos nusiuntimo data</label>
                        <input type="datetime-local" class="form-control" name="accountDeliveryDate" placeholder="Įveskite sąskaitos nusiuntimo datą" class="form-control
                        text-grey-darker @error('accountDeliveryDate') border-red-500 @enderror" value="{{ old('accountDeliveryDate') }}">

                        @error('accountDeliveryDate')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    

                </div>

                <div class="col font-semibold">
                <div class="mb-6 font-bold text-lg">Krovinio Informacija</div>
                    <div class="form-group pb-2">
                        <label for="purpose">Paskirtis*</label>
                        <input type="text" name="purpose" placeholder="Įveskite krovinio paskirtį" class="form-control
                        text-grey-darker @error('purpose') border-red-500 @enderror" value="{{ old('purpose') }}">

                        @error('purpose')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="weight">Svoris(kg)*</label>
                        <input type="number" step="0.0000000000000001" name="weight" placeholder="Įveskite svorį" class="form-control
                        text-grey-darker @error('weight') border-red-500 @enderror" value="{{ old('weight') }}">

                        @error('weight')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="deliveringTemperature">Vežimo temperatūra(°C)</label>
                        <input type="number" step="0.0000000000000001" name="deliveringTemperature" placeholder="Įveskite vežimo temperatūrą" class="form-control
                        text-grey-darker @error('deliveringTemperature') border-red-500 @enderror" value="{{ old('deliveringTemperature') }}">

                        @error('deliveringTemperature')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="size">Dydis*</label>
                        <select id="size" onchange="changeSizeFields(this.value)" class="form-control" name="size" placeholder="Pasirinkite dydį">
                            <option hidden disabled selected value> -- Pasirinkite krovinio dydį -- </option>
                            <option {{ old('size') == "Mažas" ? 'selected="selected"' : '' }} value="Mažas">Mažas</option>
                            <option {{ old('size') == "Vidutinis" ? 'selected="selected"' : '' }} value="Vidutinis">Vidutinis</option>
                            <option {{ old('size') == "Didelis" ? 'selected="selected"' : '' }} value="Didelis">Didelis</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('size') border-red-500 @enderror">
                            @error('size')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="length">Ilgis(m)</label>
                                <input id="lenghtChange" type="number" class="form-control" name="length" readonly value="{{ old('length')}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="width">Plotis(m)</label>
                                <input id="widthChange" type="number" class="form-control" name="width" readonly value="{{ old('width')}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="height">Aukštis(m)</label>
                                <input id="heightChange" type="number" class="form-control" name="height" readonly value="{{ old('height')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group pb-2">
                        <label for="count">Kiekis*</label>
                        <input type="number" name="count" placeholder="Įveskite kiekį" class="form-control
                        text-grey-darker @error('count') border-red-500 @enderror" value="{{ old('count') }}">

                        @error('count')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="price">Kaina(€)*</label>
                        <input type="number" step="0.0000000000000001" name="price" placeholder="Įveskite kainą" class="form-control
                        text-grey-darker @error('price') border-red-500 @enderror" value="{{ old('price') }}">

                        @error('price')
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
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="ShowModalLabel">Užsakymo informacija</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="ShowForm">

      @csrf

      <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col font-semibold">
                <div class="mb-6 font-bold text-lg">Užsakymo Informacija</div>
                    <div class="form-group pb-2">
                        <label for="deliveryDate">Pristatymo data</label>
                        <input type="text" class="form-control" name="deliveryDate" id="deliveryDate" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="deliveryAddress">Pristatymo Adresas</label>
                        <input type="text" class="form-control" name="deliveryAddress" id="deliveryAddress" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="loadingAddress">Pakrovimo Adresas</label>
                        <input type="text" class="form-control" name="loadingAddress" id="loadingAddress" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="showcustomer">Užsakovas</label>
                        <input type="text" class="form-control" name="showcustomer" id="showcustomer" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_driver">Vairuotojas</label>
                        <input type="text" class="form-control" name="fk_driver" id="fk_driver" readonly>
                        
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_employee">Darbuotojas</label>
                        <input type="text" class="form-control" name="fk_employee" id="fk_employee" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="additionalInformation">Papildoma informacija</label>
                        <textarea class="form-control" name="additionalInformation" id="additionalInformation" readonly></textarea>
                    </div>
                </div>

                <div class="col font-semibold">
                    <div class="invisible mb-6">Užsakymo Informacija</div>

                    <div class="form-group pb-2">
                        <label for="orderStatus">Užsakymo būsena</label>
                        <input type="text" class="form-control" name="orderStatus" id="orderStatus" readonly>
                    </div>

                    <div class="form-group pb-2">
                        <label for="paymentStatus">Sąskaitos būsena</label>
                        <input type="text" class="form-control" name="paymentStatus" id="paymentStatus" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="creationDate">Užsakymo sukūrimo data</label>
                        <input type="text" class="form-control" name="creationDate" id="creationDate" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="accountDeliveryDate">Sąskaitos nusiuntimo data</label>
                        <input type="text" class="form-control" name="accountDeliveryDate" id="accountDeliveryDate" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="paymentTerm">Galutinė susimokėjimo data</label>
                        <input type="text" class="form-control" name="paymentTerm" id="paymentTerm" readonly>
                    </div>

                </div>

                <div class="col font-semibold">
                <div class="mb-6 font-bold text-lg">Krovinio Informacija</div>
                    <div class="form-group pb-2">
                        <label for="purpose">Paskirtis</label>
                        <input type="text" class="form-control" name="purpose" id="purpose" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="weight">Svoris(kg)</label>
                        <input type="number" class="form-control" name="weight" id="weight" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="deliveringTemperature">Vežimo temperatūra(°C)</label>
                        <input type="number" class="form-control" name="deliveringTemperature" id="deliveringTemperature" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="size">Dydis</label>
                        <input type="text" id="size" class="form-control" name="size" id="size" readonly>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="length">Ilgis(m)</label>
                                <input type="number" class="form-control" name="length" id="length" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="width">Plotis(m)</label>
                                <input type="number" class="form-control" name="width" id="width" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="height">Aukštis(m)</label>
                                <input type="number" class="form-control" name="height" id="height" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pb-2">
                        <label for="count">Kiekis</label>
                        <input type="number" class="form-control"  name="count" id="count" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="price">Kaina(€)</label>
                        <input type="number" class="form-control"  name="price" id="price" readonly>
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
      <form action="/uzsakymai/salinti" method="post" id="DeleteForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center text-center p-5">
                <h5>Ar tikrai norite pašalinti užsakymą?</h5>
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
        <h5 class="modal-title" id="EditModalLabel">Redaguoti užsakymą</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/uzsakymai/redaguoti/value" method="post" id="EditForm">

      @csrf
      @method('POST')

      <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col font-semibold">
                <div class="mb-6 font-bold text-lg">Užsakymo Informacija</div>
                    <div class="form-group pb-2">
                        <label for="deliveryDate1">Pristatymo data</label>
                        <input type="datetime-local" id="deliveryDate1" name="deliveryDate1" class="form-control 
                        text-grey-darker @error('deliveryDate1') border-red-500 @enderror" value="{{ old('deliveryDate1') }}">

                        @error('deliveryDate1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="deliveryAddress1">Pristatymo Adresas</label>
                        <input type="text"  id="deliveryAddress1" name="deliveryAddress1" placeholder="Įveskite pristatymo adresą" class="form-control
                        text-grey-darker @error('deliveryAddress1') border-red-500 @enderror" value="{{ old('deliveryAddress1') }}">

                        @error('deliveryAddress1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="loadingAddress1">Pakrovimo Adresas</label>
                        <input type="text" id="loadingAddress1" name="loadingAddress1" placeholder="Įveskite pakrovimo adresą" class="form-control
                        text-grey-darker @error('loadingAddress1') border-red-500 @enderror" value="{{ old('loadingAddress1') }}">

                        @error('loadingAddress1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group pb-2">
                        <label for="fk_customer1">Užsakovas</label>
                        <select class="form-control"  name="fk_customer1">
                        <option hidden selected name="fk_customer1" id="fk_customer1" selected value="{{old('fk_customer1')}}">
                        @foreach($data['customers'] as $customer)
                                @if($customer->id == old('fk_customer1'))
                                {{ $customer->name}}
                                @endif
                            @endforeach 
                        
                        </option> 
                            @foreach($data['customers'] as $customer)
                                <option name="fk_customer1" value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_customer1') border-red-500 @enderror">
                            @error('fk_customer1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_driver1">Vairuotojas</label>
                        <select class="form-control" name="fk_driver1" > 
                        <option hidden selected name="fk_driver1" id="fk_driver1" selected value="{{ old('fk_driver1') }}">
                         
                            @foreach($data['drivers'] as $driver)
                                @if($driver->id == old('fk_driver1'))
                                {{ $driver->name}} {{ $driver->surname }}
                                @endif
                            @endforeach 
                            </option> 
                            @foreach($data['drivers'] as $driver)
                                    <option name="fk_driver1"  value="{{ $driver->id }}">{{ $driver->name }} {{ $driver->surname }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_driver1') border-red-500 @enderror">
                            @error('fk_driver1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_employee1">Darbuotojas</label>
                        <select class="form-control" name="fk_employee1">
                        <option hidden selected name="fk_employee1" id="fk_employee1" selected value="{{old('fk_employee1')}}">
                        @foreach($data['employees'] as $employee)
                                @if($employee->id == old('fk_employee1'))
                                {{ $employee->name}} {{ $employee->surname}}
                                @endif
                            @endforeach 
                        </option>
                            @foreach($data['employees'] as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->surname }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_employee1') border-red-500 @enderror">
                            @error('fk_employee1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="additionalInformation1">Papildoma informacija</label>
                        <textarea class="form-control" id="additionalInformation1" name="additionalInformation1" autocomplete="additionalInformation1" autofocus>{{ old('additionalInformation1') }}</textarea>
                        <span type="text" class="text-grey-darker @error('additionalInformation1') border-red-500 @enderror">
                            @error('additionalInformation1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                </div>

                <div class="col font-semibold">
                    <div class="invisible mb-6">Užsakymo Informacija</div>

                    <div class="form-group pb-2">
                        <label for="orderStatus1">Užsakymo būsena</label>
                        <select class="form-control" id="orderStatus1" name="orderStatus1">
                            <option value="Atlikta">Atlikta</option>
                            <option value="Vykdoma">Vykdoma</option>
                            <option value="Atšaukta">Atšaukta</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('orderStatus1') border-red-500 @enderror">
                            @error('orderStatus1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                

                    <div class="form-group pb-2">
                        <label for="paymentStatus1">Sąskaitos būsena</label>
                        <select class="form-control" id="paymentStatus1" name="paymentStatus1" placeholder="Pasirinkite sąskaitos būseną">
                            <option value="Išsiųsta">Išsiųsta</option>
                            <option value="Neišsiųsta">Neišsiųsta</option>
                            <option value="Sumokėta">Sumokėta</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('paymentStatus1') border-red-500 @enderror">
                            @error('paymentStatus1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="accountDeliveryDate1">Sąskaitos nusiuntimo data</label>
                        <input type="datetime-local" id="accountDeliveryDate1" name="accountDeliveryDate1" class="form-control
                        text-grey-darker @error('accountDeliveryDate1') border-red-500 @enderror" value="{{ old('accountDeliveryDate1') }}">

                            @error('accountDeliveryDate1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group pb-2" style="visibility:hidden">
                        <input type="text" id="orderid" name="orderid" class="form-control" value="{{ old('orderid') }}">
                    </div>
                </div>

                <div class="col font-semibold">
                <div class="mb-6 font-bold text-lg">Krovinio Informacija</div>
                    <div class="form-group pb-2">
                        <label for="purpose1">Paskirtis</label>
                        <input type="text"  id="purpose1" name="purpose1" placeholder="Įveskite krovinio paskirtį" class="form-control
                        text-grey-darker @error('purpose1') border-red-500 @enderror" value="{{ old('purpose1') }}">

                            @error('purpose1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        
                    </div>
                    <div class="form-group pb-2">
                        <label for="weight1">Svoris(kg)</label>
                        <input type="number" id="weight1" name="weight1" placeholder="Įveskite svorį" class="form-control
                        text-grey-darker @error('weight1') border-red-500 @enderror" value="{{ old('weight1') }}">

                        @error('weight1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="deliveringTemperature1">Vežimo temperatūra(°C)</label>
                        <input type="number"  id="deliveringTemperature1" name="deliveringTemperature1" placeholder="Įveskite vežimo temperatūrą" class="form-control
                        text-grey-darker @error('deliveringTemperature1') border-red-500 @enderror" value="{{ old('deliveringTemperature1') }}">

                        @error('deliveringTemperature1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="size1">Dydis</label>
                        <select id="size1" onchange="changeSizeFields(this.value)" class="form-control" name="size1" placeholder="Pasirinkite dydį">
                            <option value="Mažas">Mažas</option>
                            <option value="Vidutinis">Vidutinis</option>
                            <option value="Didelis">Didelis</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('size1') border-red-500 @enderror">
                            @error('size1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="length">Ilgis(m)</label>
                                <input id="lenghtChange2" type="number" class="form-control" name="length" readonly value="{{ old('length')}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="width">Plotis(m)</label>
                                <input id="widthChange2" type="number" class="form-control" name="width" readonly value="{{ old('width')}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pb-2">
                                <label for="height">Aukštis(m)</label>
                                <input id="heightChange2" type="number" class="form-control" name="height" readonly value="{{ old('height')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group pb-2">
                        <label for="count1">Kiekis</label>
                        <input type="number"  id="count1"  name="count1" placeholder="Įveskite kiekį" class="form-control
                        text-grey-darker @error('count1') border-red-500 @enderror" value="{{ old('count1') }}">

                        @error('count1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="price1">Kaina(€)</label>
                        <input type="number" id="price1"  name="price1" placeholder="Įveskite kainą" class="form-control
                        text-grey-darker @error('price1') border-red-500 @enderror" value="{{ old('price1') }}">

                        @error('price1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
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


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script></script>

<script type="text/javascript">


@error ('deliveryDate')
$('#AddModal').modal('show');
@enderror
@error ('loadingAddress')
    $('#AddModal').modal('show');
@enderror
@error ('deliveryAddress')
    $('#AddModal').modal('show');
@enderror
@error ('price')
    $('#AddModal').modal('show');
@enderror
@error ('purpose')
    $('#AddModal').modal('show');
@enderror
@error ('deliveringTemperature')
    $('#AddModal').modal('show');
@enderror
@error ('weight')
    $('#AddModal').modal('show');
@enderror
@error ('size')
    $('#AddModal').modal('show');
@enderror
@error ('length')
    $('#AddModal').modal('show');
@enderror
@error ('width')
    $('#AddModal').modal('show');
@enderror
@error ('height')
    $('#AddModal').modal('show');
@enderror
@error ('count')
    $('#AddModal').modal('show');
@enderror
@error ('orderStatus')
    $('#AddModal').modal('show');
@enderror
@error ('accountDeliveryDate')
    $('#AddModal').modal('show');
@enderror
@error ('paymentTerm')
    $('#AddModal').modal('show');
@enderror
@error ('paymentStatus')
    $('#AddModal').modal('show');
@enderror
@error ('additionalInformation')
    $('#AddModal').modal('show');
@enderror
@error ('fk_driver')
    $('#AddModal').modal('show');
@enderror
@error ('fk_customer')
    $('#AddModal').modal('show');
@enderror
@error ('fk_employee')
    $('#AddModal').modal('show');
@enderror





@error ('deliveryDate1')
$('#EditModal').modal('show');
@enderror
@error ('loadingAddress1')
    $('#EditModal').modal('show');
@enderror
@error ('deliveryAddress1')
    $('#EditModal').modal('show');
@enderror
@error ('price1')
    $('#EditModal').modal('show');
@enderror
@error ('purpose1')
    $('#EditModal').modal('show');
@enderror
@error ('deliveringTemperature1')
    $('#EditModal').modal('show');
@enderror
@error ('weight1')
    $('#EditModal').modal('show');
@enderror
@error ('size1')
    $('#EditModal').modal('show');
@enderror
@error ('length1')
    $('#EditModal').modal('show');
@enderror
@error ('width1')
    $('#EditModal').modal('show');
@enderror
@error ('height1')
    $('#EditModal').modal('show');
@enderror
@error ('count1')
    $('#EditModal').modal('show');
@enderror
@error ('orderStatus1')
    $('#EditModal').modal('show');
@enderror
@error ('accountDeliveryDate1')
    $('#EditModal').modal('show');
@enderror
@error ('paymentTerm1')
    $('#EditModal').modal('show');
@enderror
@error ('paymentStatus1')
    $('#EditModal').modal('show');
@enderror
@error ('additionalInformation1')
    $('#EditModal').modal('show');
@enderror
@error ('fk_driver1')
    $('#EditModal').modal('show');
@enderror
@error ('fk_customer1')
    $('#EditModal').modal('show');
@enderror
@error ('fk_employee1')
    $('#EditModal').modal('show');
@enderror
</script>



<script>
$("#lol").click(function() { 
        // $('#ShowModal').on('show.bs.modal', function (e) {
        console.log("open");
        if($("#lol").hasClass("no-modal")){
            
            setTimeout(function() {
                window.location.href = "{{ route('order')}}";
                }, 1);
           //  window.location.href = "{{ route('order')}}";
        }
});

</script>

<script>
    
    var data = <?php echo count($data['orders']);?>

    if(data >= 10){
        var pageNav = document.querySelector('[class="flex justify-between flex-1 sm:hidden"]');
        pageNav.style.display = 'none';

        var pageNumb =  document.querySelector('[class="relative z-0 inline-flex shadow-sm rounded-md"]');
    }
</script>

<script>
    
    function changeSizeFields(val) {
        console.log(val);
        if(val == "Mažas"){
            document.getElementById("lenghtChange").value = 2;
            document.getElementById("widthChange").value = 1;
            document.getElementById("heightChange").value = 3;
            document.getElementById("lenghtChange2").value = 2;
            document.getElementById("widthChange2").value = 1;
            document.getElementById("heightChange2").value = 3;
        }
        else if(val == "Vidutinis"){
            document.getElementById("lenghtChange").value = 5;
            document.getElementById("widthChange").value = 5;
            document.getElementById("heightChange").value = 5;
            document.getElementById("lenghtChange2").value = 5;
            document.getElementById("widthChange2").value = 5;
            document.getElementById("heightChange2").value = 5;
        }
        else{
            document.getElementById("lenghtChange").value = 8;
            document.getElementById("widthChange").value = 7;
            document.getElementById("heightChange").value = 8;
            document.getElementById("lenghtChange2").value = 8;
            document.getElementById("widthChange2").value = 7;
            document.getElementById("heightChange2").value = 8;
        }
    }

</script>


<script type="text/javascript">

    $(document).on('show.bs.modal','#DeleteModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')

       var modal = $(this)

       $('#DeleteForm').attr('action', '/uzsakymai/salinti/'+id)
})

</script>
<script type="text/javascript">

    $(document).on('show.bs.modal','#ShowModal', function (event) {

       var button = $(event.relatedTarget)
       var cdate = button.data('cdate')
       var ddate = button.data('ddate')
       var laddress = button.data('laddress')
       var daddress = button.data('daddress')
       var price = button.data('price')
       var purpose = button.data('purpose')
       var dtemp = button.data('dtemp')
       var weight = button.data('weight')
       var size = button.data('size')
       var length = button.data('length')
       var width = button.data('width')
       var height = button.data('height')
       var count = button.data('count')
       var ostatus = button.data('ostatus')
       var addate = button.data('addate')
       var pterm = button.data('pterm')
       var pstatus = button.data('pstatus')
       var ainfo = button.data('ainfo')
       var driver = button.data('driver')
       var customer = button.data('customer')
       var employee = button.data('employee')

       var modal = $(this)

       modal.find('.modal-body #creationDate').val(cdate);
       modal.find('.modal-body #deliveryDate').val(ddate);
       modal.find('.modal-body #loadingAddress').val(laddress);
       modal.find('.modal-body #deliveryAddress').val(daddress);
       modal.find('.modal-body #price').val(price);
       modal.find('.modal-body #purpose').val(purpose);
       modal.find('.modal-body #deliveringTemperature').val(dtemp);
       modal.find('.modal-body #weight').val(weight);
       modal.find('.modal-body #size').val(size);
       modal.find('.modal-body #length').val(length);
       modal.find('.modal-body #width').val(width);
       modal.find('.modal-body #height').val(height);
       modal.find('.modal-body #count').val(count);
       modal.find('.modal-body #orderStatus').val(ostatus);
       modal.find('.modal-body #accountDeliveryDate').val(addate);
       modal.find('.modal-body #paymentTerm').val(pterm);
       modal.find('.modal-body #paymentStatus').val(pstatus);
       modal.find('.modal-body #additionalInformation').val(ainfo);
       modal.find('.modal-body #fk_driver').val(driver);
       modal.find('.modal-body #showcustomer').val(customer);
       modal.find('.modal-body #fk_employee').val(employee);

})
</script>

<script type="text/javascript">

    $(document).on('show.bs.modal','#EditModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var cdate = button.data('cdate')
       var ddate = button.data('ddate')
       var laddress = button.data('laddress')
       var daddress = button.data('daddress')
       var price = button.data('price')
       var purpose = button.data('purpose')
       var dtemp = button.data('dtemp')
       var weight = button.data('weight')
       var size = button.data('size')
       var length = button.data('length')
       var width = button.data('width')
       var height = button.data('height')
       var count = button.data('count')
       var ostatus = button.data('ostatus')
       var addate = button.data('addate')
       var pterm = button.data('pterm')
       var pstatus = button.data('pstatus')
       var ainfo = button.data('ainfo')
       var driver = button.data('driver')
       var customer = button.data('customer')
       var employee = button.data('employee')

       //split driver data
       var driverdata = driver.split(',', 3);
       var driverid = driverdata[0];
       var driverinfo = driverdata[1]+" "+driverdata[2];

       //spilt customer data
       var customerdata = customer.split(',', 2);
       var customerid = customerdata[0];
       var customerinfo = customerdata[1];

       //spilt employee data
       var employeedata = employee.split(',', 3);
       var employeeid = employeedata[0];
       var employeeinfo = employeedata[1]+" "+employeedata[2];

       var modal = $(this)

       modal.find('.modal-body #creationDate').val(cdate);

        var ddatedata = ddate.split(" ", 2);
        var parsed = ddatedata[0]+"T"+ddatedata[1];
        modal.find('.modal-body #deliveryDate1').val(parsed);
        modal.find('.modal-body #orderid').val(id);
       modal.find('.modal-body #loadingAddress1').val(laddress);
       modal.find('.modal-body #deliveryAddress1').val(daddress);
       modal.find('.modal-body #price1').val(price);
       modal.find('.modal-body #purpose1').val(purpose);
       modal.find('.modal-body #deliveringTemperature1').val(dtemp);
       modal.find('.modal-body #weight1').val(weight);
       modal.find('.modal-body #size1').val(size);
       modal.find('.modal-body #lenghtChange2').val(length);
       modal.find('.modal-body #widthChange2').val(width);
       modal.find('.modal-body #heightChange2').val(height);
       modal.find('.modal-body #count1').val(count);
       modal.find('.modal-body #orderStatus1').val(ostatus);
       modal.find('.modal-body #paymentStatus1').val(pstatus);
       modal.find('.modal-body #additionalInformation1').val(ainfo);
       
       var addatedata = addate.split(" ", 2);
       var parsedaddate = addatedata[0]+"T"+addatedata[1];
       modal.find('.modal-body #accountDeliveryDate1').val(parsedaddate);

       modal.find('.modal-body #fk_driver1').text(driverinfo);
       modal.find('.modal-body #fk_driver1').val(driverid);

       modal.find('.modal-body #fk_customer1').text(customerinfo);
       modal.find('.modal-body #fk_customer1').val(customerid);

       modal.find('.modal-body #fk_employee1').text(employeeinfo);
       modal.find('.modal-body #fk_employee1').val(employeeid);

       $('#EditForm').attr('action', '/uzsakymai/redaguoti/'+id)
})
</script>

</body>
</html>