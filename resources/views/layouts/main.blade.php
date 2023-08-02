<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>TAS - @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/f92d7e8a24.js" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    @livewireStyles
    @yield('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        background: #e7e7e7;
    }
</style>
<body class="font-primary">
<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded z-999 ">
    <div class="container flex flex-wrap items-center space-around justify-between mx-auto">
        <h5 class="text-2xl font-normal leading-normal mt-0 mb-2 text-indigo-500 ml-24">
            <a href="{{route('home')}}">Take-A-Seat</a>
        </h5>
        <div class="flex md:order-2 mr-24">
            @guest()
                <a href="{{ route('login') }}" class="btn btn-primary hover:text-white font-medium rounded-lg px-5 py-2.5 text-center mr-3 md:mr-0">{{__('Log in')}}</a>
            @endguest
            @auth()
                <a href="{{route('profile.edit')}}" class="btn btn-primary hover:text-white font-medium rounded-lg px-5 py-2.5 text-center mr-3 md:mr-0">Profil</a>
                <form action="{{route('logout')}}" method="post" class="ml-2">
                    @csrf
                    <input type="submit" value="{{__('Log out')}}" class="btn btn-primary hover:text-white font-medium rounded-lg px-5 py-2.5 text-center mr-3 md:mr-0 cursor-pointer">
                </form>
            @endauth
            <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
            <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0  md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{route('show.index')}}" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white md:dark:hover:bg-transparent">{{__('Shows')}}</a>
                </li>
                <li>
                    <a href="{{route('location.index')}}" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white md:dark:hover:bg-transparent">{{__('Theaters')}}</a>
                </li>
                <li>
                    <a href="{{route('artist.index')}}" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white md:dark:hover:bg-transparent">{{__('Artists')}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container relative mx-auto">
    @yield('content')
</div>
<footer class="p-4">
</footer>
@livewireScripts
@yield('scripts')
</body>
</html>

