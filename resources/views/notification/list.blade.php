<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pranešimai</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

</head>
<body>

<style>
body{
    background-color: #f1f2f6;
}

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

<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Pranešimai</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>


<div class="ml-8 mr-8">
    
<div>

<div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
      <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        Naujausi pranešimai
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body overflow-auto bg-light" style="height: 350px;">
      @if(auth()->user()->unreadnotifications->count() != 0)
        <div class="p-1">
            @foreach(auth()->user()->unreadnotifications as $item)
                <div class="flex align-middle p-4 border-1 border-gray-400 mb-3 text-white" style="justify-content: space-between; align-items: center; border-radius: 25px; background-color:#778ca3;">
                    {{ $item->data['data'] }} 
                    <a class="text-blue-900 pl-2 mark-as-read"  style="text-decoration:none;" href="#" data-id="{{ $item->id }}" onclick="markRead('{{ $item->id }}')"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
                </div>
            @endforeach
            <a class="text-blue-900" style="text-decoration:none;" href="{{ route('markRead') }}"><i class="fa fa-check-square-o fa-3x" aria-hidden="true"></i></a>
        </div>
    @else
        <div class="d-flex justify-content-center p-2 font-medium text-xl bg-red-200" style="border-radius: 25px;"> Naujausiu pranešimų nėra</div>
    @endif
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
        Ankstesni pranešimai
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
      <div class="accordion-body overflow-auto bg-light" style="height: 350px;">
        
      @if(auth()->user()->readnotifications->count() != 0)
        <div class="p-1">
            @foreach(auth()->user()->readnotifications as $item)
                <div class="flex align-middle p-4 border-1 border-gray-400 mb-3 text-white" style="justify-content: space-between; align-items: center; border-radius: 25px; background-color:#778ca3;">
                    {{ $item->data['data'] }} 
                </div>
            @endforeach
            </div>
        @else
            <div class="d-flex justify-content-center p-2 font-medium text-xl bg-red-200" style="border-radius: 25px;"> Ankstesnių pranešimų nėra</div>
        @endif

      </div>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<script>
    
    function markRead(item){
        
        $.ajax({
            url:     '/pranesimaiMark/' + item,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type:    'Get',
            data:    { src: 'show' },
            success: function(response) {
            window.location.href = '/pranesimaiMark/' + item;
            }
        });
    }

</script>


</body>
</html>