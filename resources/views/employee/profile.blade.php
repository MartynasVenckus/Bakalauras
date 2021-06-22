<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mano paskyra</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
    

<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Mano paskyra</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>



<div class="w-3/5 mx-auto">
  <div class="" style="background-color: #e2e3e5; border: #cccdcf solid 1px;">
    
  <form action="/mano-paskyra/redaguoti" method="post" id="EditForm">

@csrf
@method('POST')

      <div class="row justify-content-center p-3">
          <div class="col-4 font-semibold">
          <div class="form-group pb-2">
                  <label for="name">Vardas*</label>
                  <input type="text"  id="name" name="name" value="{{ auth()->user()->name }}" placeholder="Įveskite darbuotojo vardą" class="form-control
                  text-grey-darker @error('name') border-red-500 @enderror">

                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
              </div>
              <div class="form-group pb-2">
                  <label for="surname">Pavardė*</label>
                  <input type="text"  id="surname" name="surname" value="{{ auth()->user()->surname }}"  placeholder="Įveskite darbuotojo pavardę" class="form-control
                  text-grey-darker @error('surname') border-red-500 @enderror">

                        @error('surname')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
              </div>
              <div class="form-group pb-2">
                  <label for="email">Elektroninis paštas*</label>
                  <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"  placeholder="Įveskite elektroninį paštą"  class="form-control
                  text-grey-darker @error('email') border-red-500 @enderror">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
              </div>
              <div class="form-group pb-2">
                  <label for="phone">Telefono numeris</label>
                  <input type="text"  id="phone" name="phone" value="{{ auth()->user()->phone }}"  placeholder="Įveskite telefono numerį" class="form-control
                  text-grey-darker @error('phone') border-red-500 @enderror">

                        @error('phone')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
              </div>
              <div class="form-group pb-2">
                  <label for="type">Paskyros tipas*</label>
                  <select class="form-control" id="type" name="type" value="{{ auth()->user()->type }}" >
                      <option value="Darbuotojas"{{ auth()->user()->type == "Darbuotojas" ? 'selected' : '' }}>Darbuotojas</option>
                      <option value="Administratorius"{{ auth()->user()->type == "Administratorius" ? 'selected' : '' }}>Administratorius</option>
                  </select>
              </div>
          </div>

          <div class="col-1"></div>
     
          <div class="col-4 font-semibold">
          <div class="form-group pb-2">
                  <label for="password">Naujas slaptažodis</label>
                  <input type="password"  name="password" placeholder="Įveskite naują slaptažodį" class="form-control
                  text-grey-darker @error('password') border-red-500 @enderror">

                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
              </div>
              <div class="form-group pb-2">
                  <label for="repeatpassword">Pakartokite naują slaptažodį</label>
                  <input type="password" name="repeatpassword" placeholder="Pakartokite naują slaptažodį"  class="form-control
                  text-grey-darker @error('repeatpassword') border-red-500 @enderror">

                        @error('repeatpassword')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
              </div>
          </div>
      </div>

      <div class="w-full d-flex justify-content-end border-top border-secondary p-2">        
     
        <button type="submit" class="btn btn-success align-middle mr-8 ">Išsaugoti</button>
      </div>  
      
      </div>
      

</form>





  </div>
<div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>



</script>

</body>
</html>