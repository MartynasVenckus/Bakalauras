<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporto priemonės</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    

</head>
<body>

<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Transporto priemonės</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>



<div class="ml-8 mr-8">
  <div class="flex p-2 border-l border-r border-t border-b-0" style="background-color: #e2e3e5; border: #cccdcf solid 1px;">
    <button type="button" class=" p-0 flex-initial w-14 btn btn-success mr-12" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <div class="flex-initial">
    
      <form action="{{ route('truckSearch') }}" method="get">
        <div class="input-group">
          <div class="flex items-center text-lg font-medium mr-3">Markė</div>
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

<table id="dataTable" class="table table-bordered table-hover">
  <thead class="table-light">
    <tr>
      <th scope="col">Transporto priemonės numeris</th>
      <th scope="col">Markė</th>
      <th scope="col">Modelis</th>
      <th scope="col">Techninės apžiūros pasibaigimo data</th>
      <th scope="col">Draudimas</th>
      <th scope="col">Valstybiniai numeriai</th>
      <th scope="col">GPS sekimo įrenginys</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>

  <tbody>
    @foreach($data['tdata'] as $truck)
                <tr data-bs-target="#ShowModal" data-bs-toggle="modal" data-id="{{ $truck->id }}" data-brand="{{ $truck->brand }}" data-model="{{ $truck->model }}"
                    data-tdate="{{ $truck->technicalInspectionExpirationDate }}" data-insurance="{{ $truck->insurance }}"
                    data-tnumber="{{ $truck->trailerNumber }}" data-lplate="{{ $truck->licensePlate }}" data-tdevice="{{ $truck->name }}">
                <td>{{ $truck->id }}</td>
                <td>{{ $truck->brand }}</td>
                <td>{{ $truck->model }}</td>
                <td>{{ $truck->technicalInspectionExpirationDate }}</td>
                <td>{{ $truck->insurance }}</td>
                <td>{{ $truck->licensePlate }}</td>
                <td>{{ $truck->name }}</td>
                <td>
                    <!-- edit button trigger modal   -->
                    <button class="btn" data-bs-target="#EditModal" data-bs-toggle="modal" data-id="{{ $truck->id }}" data-brand="{{ $truck->brand }}" data-model="{{ $truck->model }}"
                    data-tdate="{{ $truck->technicalInspectionExpirationDate }}" data-insurance="{{ $truck->insurance }}"
                    data-tnumber="{{ $truck->trailerNumber }}" data-lplate="{{ $truck->licensePlate }}" data-tdevice="{{ $truck->fk_tdevice }}, {{ $truck->name }}"><i class="fa fa-pencil-square-o fa-2x text-yellow-500" aria-hidden="true"></i></button>

                    <!-- delete button trigger modal -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-id="{{ $truck->id }}"><i class="fa fa-trash-o fa-2x text-red-600" aria-hidden="true"></i></button> 
                </td>
                </tr>
    @endforeach
  </tbody>
</table>
@if ($data['status'])
                <div class="p-4 rounded-lg mb-6 text-center">
                    {{ $data['status'] }}
                    <br>
                    <button type="button"  class="btn btn-success mt-10" onclick="window.location='{{ route("truck") }}'">Grįžti į sąrašą</button>
                </div>
            @endif

<span>
    {{$data['tdata']->onEachSide(1)->links()}}
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

<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="ShowModalLabel">Transporto priemonės informacija</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="ShowForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="brand">Markė</label>
                        <input type="text" class="form-control" id="brand" name="brand" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="model">Modelis</label>
                        <input type="text" class="form-control" id="model" name="model" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="licensePlate">Valstybinis numeris</label>
                        <input type="text" class="form-control" id="licensePlate" name="licensePlate" readonly>
                    </div>
                   
                    <div class="form-group pb-2">
                        <label for="trailerNumber">Priekabos numeris</label>
                        <input type="text" class="form-control" id="trailerNumber" name="trailerNumber" readonly>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-5 font-semibold">
                <div class="form-group pb-2">
                        <label for="technicalInspectionExpirationDate">Techninės apžiūros pasibaigimo data</label>
                        <input type="text" class="form-control" id="technicalInspectionExpirationDate" name="technicalInspectionExpirationDate" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="insurance">Draudimas</label>
                        <input type="text" class="form-control" id="insurance" name="insurance" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_tdevice">GPS sekimo įrenginys</label>
                        <input type="text" class="form-control" id="fk_tdevice" name="fk_tdevice" readonly>
                    </div>
                </div>
            </div>          
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="AddModalLabel">Pridėti Transporto priemonę</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('addTruck') }}" method="post">
      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
              <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="brand">Markė*</label>
                        <input type="text" id="brand" name="brand" placeholder="Įveskite markę" class="form-control
                        text-grey-darker @error('brand') border-red-500 @enderror" value="{{ old('brand') }}">

                    @error('brand')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="model">Modelis*</label>
                        <input type="text" id="model" name="model" placeholder="Įveskite modelį" class="form-control
                        text-grey-darker @error('model') border-red-500 @enderror" value="{{ old('model') }}">

                    @error('model')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="licensePlate">Valstybiniai numeriai*</label>
                        <input type="text" id="licensePlate" name="licensePlate" placeholder="Įveskite valstybinius numerius" class="form-control
                        text-grey-darker @error('licensePlate') border-red-500 @enderror" value="{{ old('licensePlate') }}">

                        @error('licensePlate')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   
                    <div class="form-group pb-2">
                        <label for="trailerNumber">Priekabos valstybiniai numeriai</label>
                        <input type="text"  id="trailerNumber" name="trailerNumber" placeholder="Įveskite priekabos valstybinius numerius" class="form-control
                        text-grey-darker @error('trailerNumber') border-red-500 @enderror" value="{{ old('trailerNumber') }}">

                        @error('trailerNumber')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-5 font-semibold">
                <div class="form-group pb-2">
                        <label for="technicalInspectionExpirationDate">Techninės apžiūros pasibaigimo data*</label>
                        <input type="date"  id="technicalInspectionExpirationDate" name="technicalInspectionExpirationDate" class="form-control
                        text-grey-darker @error('technicalInspectionExpirationDate') border-red-500 @enderror" value="{{ old('technicalInspectionExpirationDate') }}">

                        @error('technicalInspectionExpirationDate')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="insurance">Draudimas*</label>
                        <select class="form-control" name="insurance" id="insurance">
                            <option hidden disabled selected value> -- Pasirinkite draudimo būseną-- </option>
                            <option {{ old('insurance') == "Apdrausta" ? 'selected="selected"' : '' }} value="Apdrausta">Apdrausta</option>
                            <option {{ old('insurance') == "Neapdrausta" ? 'selected="selected"' : '' }} value="Neapdrausta">Neapdrausta</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('insurance') border-red-500 @enderror">
                            @error('insurance')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_tdevice">Sekimo įrenginys</label>
                        <select class="form-control" name="fk_tdevice">
                        <option hidden disabled selected value="{{old('fk_tdevice')}}">
                        @foreach($data['tdevices'] as $tdevice)
                                @if($tdevice->id == old('fk_tdevice'))
                                {{ $tdevice->name }}
                                @break
                                @endif
                                    @if($loop->last)
                                      -- Pasirinkite sekimo įrenginį--
                                    @endif
                            @endforeach 
                      
                      </option>
                            @foreach($data['tdevices'] as $tdevice)
                                <option value="{{ $tdevice->id }}">{{ $tdevice->name }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_tdevice') border-red-500 @enderror">
                            @error('fk_tdevice')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span> 
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


<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="DeleteModalLabel">Pašalinti transporto priemonę</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/transportoPriemones/salinti" method="post" id="DeleteForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center text-center p-5">
                <h5>Ar tikrai norite pašalinti transporto priemonę?</h5>
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
        <h5 class="modal-title" id="EditModalLabel">Redaguoti transporto priemonę</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/transportoPriemones/redaguoti/value" method="post" id="EditForm">

      @csrf
      @method('POST')

      <div class="modal-body" >
            <div class="row justify-content-center p-3">
            <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="brand1">Markė*</label>
                        <input type="text"  id="brand1" name="brand1" placeholder="Įveskite markę" class="form-control
                        text-grey-darker @error('brand1') border-red-500 @enderror" value="{{ old('brand1') }}">

                        @error('brand1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="model1">Modelis*</label>
                        <input type="text"  id="model1" name="model1" placeholder="Įveskite modelį" class="form-control
                        text-grey-darker @error('model1') border-red-500 @enderror" value="{{ old('model1') }}">

                        @error('model1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="licensePlate1">Valstybiniai numeriai*</label>
                        <input type="text" id="licensePlate1" name="licensePlate1" placeholder="Įveskite valstybinius numerius"  class="form-control
                        text-grey-darker @error('licensePlate1') border-red-500 @enderror" value="{{ old('licensePlate1') }}">

                        @error('licensePlate1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   
                    <div class="form-group pb-2">
                        <label for="trailerNumber1">Priekabos valstybiniai numeriai</label>
                        <input type="text" id="trailerNumber1" name="trailerNumber1" placeholder="Įveskite priekabos valstybinius numerius"  class="form-control
                        text-grey-darker @error('trailerNumber1') border-red-500 @enderror" value="{{ old('trailerNumber1') }}">

                        @error('trailerNumber1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-5 font-semibold">
                <div class="form-group pb-2">
                        <label for="technicalInspectionExpirationDate1">Techninės apžiūros pasibaigimo data*</label>
                        <input type="date" id="technicalInspectionExpirationDate1" name="technicalInspectionExpirationDate1" class="form-control
                        text-grey-darker @error('technicalInspectionExpirationDate1') border-red-500 @enderror" value="{{ old('technicalInspectionExpirationDate1') }}">

                        @error('technicalInspectionExpirationDate1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="insurance1">Būsena</label>
                        <select class="form-control" id="insurance1" name="insurance1">
                            <option value="Apdrausta">Apdrausta</option>
                            <option value="Neapdrausta">Neapdrausta</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('insurance1') border-red-500 @enderror">
                            @error('insurance1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2">
                        <label for="fk_tdevice1">Sekimo įrenginys</label>
                        <select class="form-control" name="fk_tdevice1" > 
                        <option hidden selected name="fk_tdevice1" id="fk_tdevice1" selected  value="{{old('fk_tdevice1')}}">
                        
                        @foreach($data['tdevices'] as $tdevice)
                                @if($tdevice->id == old('fk_tdevice1'))
                                  {{ $tdevice->name }}
                                @endif
                        @endforeach
                        
                        </option>
                          <option name="fk_tdevice1"  value>Nėra</option> 
                            @foreach($data['tdevices'] as $tdevice)
                                    <option name="fk_tdevice1"  value="{{ $tdevice->id }}">{{ $tdevice->name }}</option>
                            @endforeach
                        </select>
                        <span type="text" class="text-grey-darker @error('fk_tdevice1') border-red-500 @enderror">
                            @error('fk_tdevice1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                    <div class="form-group pb-2" style="visibility:hidden">
                        <input type="text" id="truckid" name="truckid" class="form-control" value="{{ old('truckid') }}">
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

<script>

@error ('brand')
$('#AddModal').modal('show');
@enderror
@error ('model')
    $('#AddModal').modal('show');
@enderror
@error ('technicalInspectionExpirationDate')
    $('#AddModal').modal('show');
@enderror
@error ('insurance')
    $('#AddModal').modal('show');
@enderror
@error ('licensePlate')
    $('#AddModal').modal('show');
@enderror
@error ('trailerNumber')
    $('#AddModal').modal('show');
@enderror
@error ('fk_tdevice')
    $('#AddModal').modal('show');
@enderror



@error ('brand1')
$('#EditModal').modal('show');
@enderror
@error ('model1')
    $('#EditModal').modal('show');
@enderror
@error ('technicalInspectionExpirationDate1')
    $('#EditModal').modal('show');
@enderror
@error ('insurance1')
    $('#EditModal').modal('show');
@enderror
@error ('licensePlate1')
    $('#EditModal').modal('show');
@enderror
@error ('trailerNumber1')
    $('#EditModal').modal('show');
@enderror
@error ('fk_tdevice1')
    $('#EditModal').modal('show');
@enderror

</script>

<script>
  var data = <?php echo count($data['tdevices']);?>

    if(data >= 10){
        var pageNav = document.querySelector('[class="flex justify-between flex-1 sm:hidden"]');
        pageNav.style.display = 'none';

        var pageNumb =  document.querySelector('[class="relative z-0 inline-flex shadow-sm rounded-md"]');
    }
</script>

<script type="text/javascript">

    $(document).on('show.bs.modal','#DeleteModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')

       var modal = $(this)

       $('#DeleteForm').attr('action', '/transportoPriemones/salinti/'+id)
})

</script>
<script type="text/javascript">

    $(document).on('show.bs.modal','#ShowModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var brand = button.data('brand')
       var model = button.data('model')
       var tdate = button.data('tdate')
       var lplate = button.data('lplate')
       var insurance = button.data('insurance')
       var tnumber = button.data('tnumber')
       var tdevice = button.data('tdevice')

       var modal = $(this)

       modal.find('.modal-body #brand').val(brand);
       modal.find('.modal-body #model').val(model);
       modal.find('.modal-body #technicalInspectionExpirationDate').val(tdate);
       modal.find('.modal-body #licensePlate').val(lplate);
       modal.find('.modal-body #insurance').val(insurance);
       modal.find('.modal-body #trailerNumber').val(tnumber);
       modal.find('.modal-body #fk_tdevice').val(tdevice);
})
</script>

<script type="text/javascript">

    $(document).on('show.bs.modal','#EditModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var brand = button.data('brand')
       var model = button.data('model')
       var tdate = button.data('tdate')
       var lplate = button.data('lplate')
       var insurance = button.data('insurance')
       var tnumber = button.data('tnumber')
       var tdevice = button.data('tdevice')

       //split tracking device data
       var tdevicedata = tdevice.split(',', 2);
       var tdeviceid = tdevicedata[0];
       var tdeviceinfo = tdevicedata[1];

       var modal = $(this)

       modal.find('.modal-body #brand1').val(brand);
       modal.find('.modal-body #truckid').val(id);
       modal.find('.modal-body #model1').val(model);
       modal.find('.modal-body #technicalInspectionExpirationDate1').val(tdate);
       modal.find('.modal-body #licensePlate1').val(lplate);
       modal.find('.modal-body #insurance1').val(insurance);
       modal.find('.modal-body #trailerNumber1').val(tnumber);
       modal.find('.modal-body #fk_tdevice1').text(tdeviceinfo);
       modal.find('.modal-body #fk_tdevice1').val(tdeviceid);

       $('#EditForm').attr('action', '/transportoPriemones/redaguoti/'+id)
})
</script>

</body>
</html>