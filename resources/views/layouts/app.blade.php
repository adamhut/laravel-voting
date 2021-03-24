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

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-900 text-sm bg-gray-background" >
        <header class="flex item-center justify-between px-8 py-4">
            <a href="#">
                <img src="{{asset('images/logo.svg')}}" alt="Laracasts Logo" class="">
            </a>
            <div class="flex items-center"> 
                @if (Route::has('login'))
                    <div class=" px-6 py-4 sm:block">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                            
                                <a
                                    class=""
                                    href="{{route('logout')}}" 
                                >
                                    {{ __('Log out') }}
                                </a>
                            </form>
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
                        <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" 
                            alt="avatar"
                            class="w-10 h-10 rounded-full">
                    </a>
                </div>
            </div>
        </header>
        <main class="container mx-auto flex max-w-custom">
            <div class="w-70" style=""> 
                <div 
                    class="border border-blue rounded-lg mt-16 bg-white"
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
                        <p class="text-xs mt-3">Let us know what you would like and we will take a look over! </p>
                    </div>
                    <form action="#" method="POST" class="space-y-4 px-4 py-6 ">
                        <div>
                            <input 
                                type="text" 
                                class="w-full bg-gray-100 rounded-lg py-2 px-4 border-none shadow-sm placeholder-gray-900 text-sm" 
                                placeholder="Your idea"
                            >
                        </div>
                        <div class="">
                            <select name="category_add" id="category_add" class="w-full bg-gray-100 rounded-lg placeholder-gray-900 py-2 border-none shadow-sm text-sm">
                                <option value="Category 1">Category 1</option>
                                <option value="Category 2">Category 2</option>
                                <option value="Category 3">Category 3</option>
                            </select>
                        </div>
                        <div>
                            <textarea 
                                name="idea" 
                                id="idea" 
                                cols="30" 
                                rows="4" 
                                class="w-full bg-gray-100 rounded-lg placeholder-gray-900 text-sm px-4 py-2 border-none"
                                placeholder="Describe Your idea" 
                            >
                            </textarea>
                        </div>
                        <div>
                            <div class="flex items-center justify-between space-x-3">
                                <button 
                                    type="button"
                                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" 
                                        viewBox="0 0 24 24" stroke="currentColor"
                                        class="w-4 h-4 transform -rotate-45 text-gray-600"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                    <span class="ml-1">Attach</span>
                                </button>
                                <button type="submit"
                                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                                    <span >Submit</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
            <div class="w-175 ml-5" style="max-width:700px; margin-left:20px ">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold border-b-4  pb-3 space-x-10">
                        <li >
                            <a href="#" class="border-b-4 pb-3 border-blue">All Ideas(87)</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Considering(6)</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">In Progress(1)</a>
                        </li>
                    </ul>

                    <ul class="flex uppercase font-semibold border-b-4  pb-3 space-x-10">
                        <li>
                            <a href="#" class="border-b-4 pb-3 border-blue">Implemented(10)</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Closed(55)</a>
                        </li>
                    </ul>
                </nav>
                <div class="mt-8">
                    {{$slot}}
                </div>
            </div>
            {{-- <div class="w-24 invisible">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ad vel deserunt expedita eveniet similique eum cum voluptates, exercitationem recusandae, maxime perferendis. Minus tempore neque voluptate nobis ullam fuga rerum.
            </div> --}}
        </main>
    </body>
</html>
