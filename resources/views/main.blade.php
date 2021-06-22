<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagrindinis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    
    
</head>
<body >

<style>
    .hover-class:hover{
        color:#95afc0;
        border-bottom: 3px solid;
    }
    .color{

        transition: color 200ms ease-out 100ms;
    }

</style>

    <div class="h-screen">

    <nav class="nav-h p-6 flex justify-between object-cover">
        <ul class="flex items-center text-white text-2xl font-medium">
            <li class="">
                <a href="{{ route('order') }}" class="hover-class color p-4" >Užsakymai</a>
            </li>
            <li>
                <a href="{{ route('map') }}" class="hover-class color p-4">Žemėlapis</a>
            </li>
            <li>
                <a href="{{ route('driver') }}" class="hover-class color p-4">Vairuotojai</a>
            </li>
            <li>
                <a href="{{ route('truck') }}" class="hover-class color p-4">Transporto priemonės</a>
            </li>
            <li>
                <a href="{{ route('customer') }}" class="hover-class color p-4">Užsakovai</a>
            </li> 
            <li>
                <a href="{{ route('charts') }}" class="hover-class color p-4">Apžvalga</a>
            </li> 
            @if(auth()->check() && auth()->user()->type == "Administratorius")
            <li>
                <a href="{{ route('employee') }}" class="hover-class color ml-16 p-4 ">Darbuotojai</a>
            </li> 
            @endif
        </ul>
        <ul class="flex items-center text-white text-2xl font-medium">
            <li>
                <div class="dropdown p-4">
                <a href="{{ route('notifications') }}"> <i class="fa fa-bell-o" aria-hidden="true"></i> </a>
                
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <a>
                            @if(auth()->user()->unreadnotifications->count() != 0)
                                <span class="badge rounded-pill bg-danger">{{ auth()->user()->unreadnotifications->count() }}</span>
                            @endif
                        </a>
                    </button>
                    <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton2" style="background-color: #f5f6fa;">
                        @forelse(auth()->user()->unreadnotifications as $item)
                        @if($loop->last == false)
                            <li><a class="dropdown-item p-2 border-bottom border-secondary hoverable" href="{{ route('notifications') }}">{{ $item->data['summary'] }}</a></li>
                            @endif
                            @if($loop->last)
                                <li><a class="dropdown-item p-2 hoverable" href="{{ route('notifications') }}">{{ $item->data['summary'] }}</a></li>
                            @endif
                        @empty
                            <li><a class="dropdown-item p-2 hoverable" href="{{ route('notifications') }}">Pranešimų nėra</a></li>
                        @endforelse
                    </ul>
                </div>
                
            </li>
            <li>
                <div class="dropdown p-4">
                    <button class="btn dropdown-toggle text-white p-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->email }}
                    </button>
                    <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1" style="background-color: #f5f6fa;">
                        @if(auth()->check() && auth()->user()->type == "Administratorius")
                            <li><a class="dropdown-item p-2 border-bottom border-secondary hoverable" href="{{ route('profInfo') }}">Mano paskyra</a></li>
                        @endif
                        <li><a class="dropdown-item p-2 hoverable" href="{{ route('logout') }}">Atsijungti</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>

    <div style="background-image: url('/images/main.jpg')"  class="flex justify-center items-center pb-80 relative bg-no-repeat lg:bg-center bg-cover main-image-h object-cover" style="background-size: cover;"></div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>