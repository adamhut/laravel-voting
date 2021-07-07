<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laracast Voting</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-900 text-sm bg-gray-background" >
        <header class="flex flex-col md:flex-row  item-center justify-between px-8 py-4">
            <a href="/">
                <img src="{{asset('images/logo.svg')}}" alt="Laracasts Logo" class="">
            </a>
            <div class="mt-2 md:mt-0 flex items-center">
                @if (Route::has('login'))
                    <div class="px-4 md:px-6 py-4 sm:block ">
                        @auth
                            <div class="flex items-center space-x-4">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a
                                        class=""
                                        href="{{route('logout')}}"
                                    >
                                        {{ __('Log out') }}
                                    </a>
                                </form>

                                <div
                                    x-data="{isOpen:false}"
                                    x-cloak
                                    @click.away="isOpen=false"
                                    @keydown.escape.window="isOpen=false"
                                    class="relative"
                                >
                                    <button class="relative"
                                        @click=" isOpen=!isOpen "
                                    >
                                        <svg class="h-6 w-6 text-gray-500 " viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                        </svg>
                                        <div class="absolute rounded-full border border-white bg-red text-white text-xxs -top-1 -right-1 h-4 w-4 flex justify-center items-center">3</div>
                                    </button>
                                    <ul
                                        class="ml-8 w-76 md:w-96 absolute bg-white shadow-dialog text-xs rounded-xl pt-3 text-left md:ml-8 top-8 md:top-6 z-10 max-h-128 overflow-y-auto md:-right-12 -right-24"
                                        x-show.transition.origin.top="isOpen"
                                        x-cloak
                                        @click.away="isOpen=false"
                                        @keydown.escape.window="isOpen=false"
                                    >
                                        <li class="">
                                            <a href="#" class="hover:bg-gray-100 text-gray-700  flex px-5 py-2 transition duration-150 ease-in ">
                                               <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar"
                                                class="w-10 h-10 rounded-full">
                                                <div class="ml-4">
                                                    <div class="line-clamp-6">
                                                        <span class="font-semibold">adam huang</span>
                                                        Commentd on
                                                        <span class="font-semibold">This is my idea</span>:
                                                        <span>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis ut nulla, dolor rem aliquid voluptas quis harum, a maxime laboriosam culpa nisi eaque delectus, in quo voluptatum veniam! Labore, laborum?"</span>
                                                    </div>
                                                    <div class="text-xxs text-gray-500 mt-2">1 hour ago</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="border-t border-gray-300 text-center text-sm ">
                                            <button class="hover:bg-gray-100 text-gray-700 w-full text-center font-semibold block px-5 py-2 transition duration-150 ease-in "> Mark all as read</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <div>
                    <a href="#">
                        <img
                            src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp"
                            alt="avatar"
                            class="w-10 h-10 rounded-full"
                        >
                    </a>
                </div>
            </div>
        </header>
        <main class="container mx-auto flex max-w-custom flex-col md:flex-row">
            <div class="w-70 mx-auto md:mx-0" style="">
                <div
                    class=" border border-blue rounded-lg md:mt-16 bg-white md:sticky md:top-9"
                    style="
                          border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            border-image-slice: 1;
                            background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            background-origin: border-box;
                            background-clip: content-box, border-box;
                    "
                >
                    <div class="text-center px-6 py-2 pt-4">
                        <h3 class="font-semibold text-base">Add an idea</h3>
                        <p class="text-xs mt-3">
                        @auth
                            Let us know what you would like and we will take a look over!
                        @else
                            Please login to create an idea
                        @endauth
                        </p>
                    </div>

                    @auth
                        <livewire:create-idea></livewire:create-idea>
                    @else
                        <div class="my-6 text-center">
                            <a href="{{route('login')}}"
                                class="inline-block mt-2 w-1/2 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                                Login
                            </a>
                            <a href="{{route('register')}}"
                                class=" inline-block mt-2 w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                Sign Up
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="w-full md:w-175 px-2 md:px-0  md:ml-5" style="max-width:700px; margin-left:20px ">
                <livewire:status-filters></livewire:status-filters>
                <div class="mt-8">
                    {{$slot}}
                </div>
            </div>
            {{-- <div class="w-24 invisible">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ad vel deserunt expedita eveniet similique eum cum voluptates, exercitationem recusandae, maxime perferendis. Minus tempore neque voluptate nobis ullam fuga rerum.
            </div> --}}
        </main>

        <!--Start Notification-->
        @if(session()->has('success_message'))
            <x-notification-success
                :redirect="true"
                message-to-display="{{ (session('success_message')) }}"
            ></x-notification-success>
        @endif
        <!--End Notification -->
        <livewire:scripts />
    </body>
</html>
