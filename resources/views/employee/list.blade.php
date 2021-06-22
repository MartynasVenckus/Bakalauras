<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darbuotojai</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    

</head>
<body>

<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Darbuotojai</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>


<div class="ml-8 mr-8 ">
  <div class="flex p-2 border-l border-r border-t border-b-0" style="background-color: #e2e3e5; border: #cccdcf solid 1px;">
    <button type="button" class=" p-0 flex-initial w-14 btn btn-success mr-12" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <div class="flex-initial">
      <form action="{{ route('employeesSearchName')}}" method="get">
        <div class="input-group">
          <div class="flex items-center text-lg font-medium mr-3">Ieškoti pagal vardą</div>
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
      <th scope="col">Darbuotojo numeris</th>
      <th scope="col">Vardas</th>
      <th scope="col">Pavardė</th>
      <th scope="col">Telofono numeris</th>
      <th scope="col">Elektroninis paštas</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['users'] as $user)
    <tr data-bs-target="#ShowModal" data-bs-toggle="modal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-surname="{{ $user->surname }}" 
     data-email="{{ $user->email }}" data-phone="{{ $user->phone }}">
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->surname }}</td>
      <td>{{ $user->phone }}</td>
      <td>{{ $user->email }}</td>
      <td>
        <!-- edit button trigger modal   -->
        <button class="btn" data-bs-target="#EditModal" data-bs-toggle="modal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-surname="{{ $user->surname }}" 
     data-email="{{ $user->email }}" data-phone="{{ $user->phone }}" data-type="{{ $user->type }}"><i class="fa fa-pencil-square-o fa-2x text-yellow-500" aria-hidden="true"></i></button>

        <!-- delete utton trigger modal -->
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-id="{{ $user->id }}"><i class="fa fa-trash-o fa-2x text-red-600" aria-hidden="true"></i></button> 
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@if ($data['status'])
                <div class="p-4 rounded-lg mb-6 text-center">
                    {{ $data['status'] }}
                    <br>
                    <button type="button"  class="btn btn-success mt-10" onclick="window.location='{{ route("employee") }}'">Grįžti į sąrašą</button>
                </div>
            @endif

<span>
    {{$data['users']->onEachSide(1)->links()}}
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
        <h5 class="modal-title" id="ShowModalLabel">Darbuotojo informacija</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="ShowForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="name">Vardas</label>
                        <input type="text" class="form-control" id="name" name="name" readonly>
                    </div>
                    <div class="form-group pb-2">
                        <label for="surname">Pavardė</label>
                        <input type="text" class="form-control" id="surname" name="surname" readonly>
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
                <div class="col-5 font-semibold"> </div>
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
        <h5 class="modal-title" id="AddModalLabel">Pridėti darbuotoją</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('addEmployee') }}" method="post">
      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                <div class="form-group pb-2">
                        <label for="name">Vardas*</label>
                        <input type="text"  id="name" name="name" placeholder="Įveskite darbuotojo vardą" class="form-control
                        text-grey-darker @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="surname">Pavardė*</label>
                        <input type="text" id="surname" name="surname" placeholder="Įveskite darbuotojo pavardę"  class="form-control
                        text-grey-darker @error('surname') border-red-500 @enderror" value="{{ old('surname') }}">

                        @error('surname')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="email">Elektroninis paštas*</label>
                        <input type="email"  id="email" name="email" placeholder="Įveskite elektroninį paštą" class="form-control
                        text-grey-darker @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="phone">Telefono numeris</label>
                        <input type="text" id="phone" name="phone" placeholder="Įveskite telefono numerį" class="form-control
                        text-grey-darker @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">

                        @error('phone')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="type">Darbuotojo tipas*</label>
                        <select class="form-control" id="type" name="type">
                            <option hidden disabled selected value> -- Pasirinkite darbuotojo tipą -- </option>
                            <option {{ old('type') == "Darbuotojas" ? 'selected="selected"' : '' }} value="Darbuotojas">Darbuotojas</option>
                            <option {{ old('type') == "Administratorius" ? 'selected="selected"' : '' }} value="Administratorius">Administratorius</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('type') border-red-500 @enderror">
                            @error('type')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                </div>
                <div class="col-1"></div>
           
                <div class="col-5 font-semibold">
                    <div class="form-group pb-2">
                        <label for="password">Darbuotojo slaptažodis*</label>
                        <input type="password" name="password" placeholder="Įveskite slaptažodį" class="form-control
                        text-grey-darker @error('password') border-red-500 @enderror">

                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="repeatpassword">Pakartokite darbuotojo slaptažodį*</label>
                        <input type="password"  name="repeatpassword" placeholder="Įveskite slaptažodį" class="form-control
                        text-grey-darker @error('repeatpassword') border-red-500 @enderror">

                        @error('repeatpassword')
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


<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #30336B;">
        <h5 class="modal-title" id="DeleteModalLabel">Pašalinti darbuotoją</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/darbuotojai/salinti" method="post" id="DeleteForm">

      @csrf

        <div class="modal-body" >
            <div class="row justify-content-center text-center p-5">
                <h5>Ar tikrai norite pašalinti darbuotoją?</h5>
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
        <h5 class="modal-title" id="EditModalLabel">Redaguoti darbuotoją</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/darbuotojai/redaguoti/value" method="post" id="EditForm">

      @csrf
      @method('POST')

        <div class="modal-body" >
            <div class="row justify-content-center p-3">
                <div class="col-5 font-semibold">
                <div class="form-group pb-2">
                        <label for="name1">Vardas*</label>
                        <input type="text"  id="name1" name="name1" placeholder="Įveskite darbuotojo vardą" class="form-control
                        text-grey-darker @error('name1') border-red-500 @enderror" value="{{ old('name1') }}">

                        @error('name1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="surname1">Pavardė*</label>
                        <input type="text"  id="surname1" name="surname1" placeholder="Įveskite darbuotojo pavardę" class="form-control
                        text-grey-darker @error('surname1') border-red-500 @enderror" value="{{ old('surname1') }}">

                        @error('surname1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="email1">Elektroninis paštas*</label>
                        <input type="email" id="email1" name="email1" placeholder="Įveskite elektroninį paštą" class="form-control
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
                    <div class="form-group pb-2">
                        <label for="type1">Darbuotojo tipas*</label>
                        <select class="form-control" id="type1" name="type1">
                            <option value="Darbuotojas">Darbuotojas</option>
                            <option value="Administratorius">Administratorius</option>
                        </select>
                        <span type="text" class="text-grey-darker @error('type1') border-red-500 @enderror">
                            @error('type1')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </span>
                    </div>
                </div>

                <div class="col-1"></div>
           
                <div class="col-5 font-semibold">
                <div class="form-group pb-2">
                        <label for="password1">Naujas darbuotojo slaptažodis</label>
                        <input type="password"  name="password1" placeholder="Įveskite naują slaptažodį" class="form-control
                        text-grey-darker @error('password1') border-red-500 @enderror">

                        @error('password1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2">
                        <label for="repeatpassword1">Pakartokite naują darbuotojo slaptažodį</label>
                        <input type="password" name="repeatpassword1" placeholder="Pakartokite naują slaptažodį"  class="form-control
                        text-grey-darker @error('repeatpassword1') border-red-500 @enderror">

                        @error('repeatpassword1')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group pb-2" style="visibility:hidden">
                        <input type="text" id="userid" name="userid" class="form-control" value="{{ old('userid') }}">
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
@error ('name')
$('#AddModal').modal('show');
@enderror
@error ('surname')
    $('#AddModal').modal('show');
@enderror
@error ('email')
    $('#AddModal').modal('show');
@enderror
@error ('phone')
    $('#AddModal').modal('show');
@enderror
@error ('type')
    $('#AddModal').modal('show');
@enderror
@error ('password')
    $('#AddModal').modal('show');
@enderror
@error ('repeatpassword')
    $('#AddModal').modal('show');
@enderror


@error ('name1')
$('#EditModal').modal('show');
@enderror
@error ('surname1')
    $('#EditModal').modal('show');
@enderror
@error ('email1')
    $('#EditModal').modal('show');
@enderror
@error ('phone1')
    $('#EditModal').modal('show');
@enderror
@error ('type1')
    $('#EditModal').modal('show');
@enderror
@error ('password1')
    $('#EditModal').modal('show');
@enderror
@error ('repeatpassword1')
    $('#EditModal').modal('show');
@enderror

</script>

<script>
var data = <?php echo count($data['users']);?>

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

       $('#DeleteForm').attr('action', '/darbuotojai/salinti/'+id)
})

</script>
<script type="text/javascript">

    $(document).on('show.bs.modal','#ShowModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var name = button.data('name')
       var surname = button.data('surname')
       var email = button.data('email')
       var phone = button.data('phone')
      
       var modal = $(this)

       modal.find('.modal-body #name').val(name);
       modal.find('.modal-body #surname').val(surname);
       modal.find('.modal-body #email').val(email);
       modal.find('.modal-body #phone').val(phone);
})
</script>

<script type="text/javascript">

    $(document).on('show.bs.modal','#EditModal', function (event) {

       var button = $(event.relatedTarget)
       var id = button.data('id')
       var name = button.data('name')
       var surname = button.data('surname')
       var email = button.data('email')
       var phone = button.data('phone')
       var type = button.data('type')
       

       var modal = $(this)

       modal.find('.modal-body #name1').val(name);
       modal.find('.modal-body #userid').val(id);
       modal.find('.modal-body #surname1').val(surname);
       modal.find('.modal-body #email1').val(email);
       modal.find('.modal-body #phone1').val(phone);
       modal.find('.modal-body #type1').val(type);

       $('#EditForm').attr('action', '/darbuotojai/redaguoti/'+id)
})
</script>

</body>
</html>