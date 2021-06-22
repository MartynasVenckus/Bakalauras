<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/custom.css">

</head>
<body>

<div class="flex justify-center items-center h-screen relative bg-no-repeat lg:bg-center bg-cover object-cover" style="background-image: url('/images/login.jpg')">




<div class="flex flex-col w-3/12">
<div class="bg-white shadow-md rounded p-10 h- h-96" style="align-items: center;">
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

    <form action="{{ route('login') }}" method="post" class="align-middle" style="align-items: center;">
                @csrf
                <div class="mb-10 text-center text-2xl font-semibold">Prisijungimas</div>
                <div class="mb-4">
                    <label for="email" class="sr-only block text-grey-darker text-sm font-bold mb-2">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your email" class="shadow appearance-none border rounded w-full py-2 px-3
         text-grey-darker @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only block text-grey-darker text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Choose a password" class="shadow appearance-none border border-red rounded w-full py-2 px-3
         text-grey-darker @error('password') border-red-500 @enderror" value="">

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="hover:bg-blue-dark text-white font-bold rounded w-full py-2 px-3" style="background-color: #30336B;">Login</button>
                </div>
            </form>
    </div>
</div>
</div>
    
</body>
</html>