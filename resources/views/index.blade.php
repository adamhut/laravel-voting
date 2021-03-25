<x-app-layout>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6 ">
        <div class="w-full md:w-1/3">
            <select name="category" id="category" class="w-full rounded-xl py-2 border-none shadow-sm">
                <option value="Category 1">Category 1</option>
                <option value="Category 2">Category 2</option>
                <option value="Category 3">Category 3</option>
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select name="other_filters" id="other_filters" class="w-full rounded-xl py-2 border-none shadow-sm">
                <option value="Filter One">Filter One</option>
                <option value="Filter twe">Filter twe</option>
                <option value="Filter Three">Filter Three</option>
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input type="search" placeholder="Find an Ideas" class="w-full rounded-xl bg-white border-none px-4 py-2 pl-8 placeholder-gray-900">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-4 text-gray-700"
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor" 
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
        </div>
    </div><!--End Filters-->

    <div class="my-6 ideas-container space-y-6 ">
        <div class="idea-container bg-white rounded-xl flex hover:shadow-card transition ease-in duration-150 cursor-pointer" >
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">12</div>
                    <div class="text-gray-500">votes</div>
                </div>
                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl px-3 py-2 hover:bg-gray-300 transition-colors ease-in duration-100">
                        Vote
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
                <div class="flex-none mx-2 md:mx-0">
                    <a href="#"  >
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" 
                            alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>

                <div class="mx-2 md:mx-4 w-full flex flex-col">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A rondom title can go here</a>
                    </h4>
                    <div class="text-gray-700 mt-3 text-xs line-clamp-3 px-2 md:px-0">
                        Lorem ipsum dolor sit amet consectetur a
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xxs font-semibold space-x-0 space-x-2 text-gray-400">
                            <span>10 hours ago </span>
                            <span>&bull;</span>
                            <span>Category 1</span>
                            <span>&bull;</span>
                            <span class="text-gray-900">3 Comments</span>
                        </div>
                        <div 
                            class="flex items-center space-x-2 mt-4 md:mt-6 "
                            x-data="{isOpen:false}"
                            @click.away="isOpen=false"
                            x-cloak
                            @keydown.escape.window="isOpen=false"
                        >
                            <button class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-24 h-7 py-2 px-4">Open</button>
                            <button 
                                class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in border px-3  py-2"
                                @click="isOpen=!isOpen"
                            >
                                <svg fill="currentColor" width="24" height="6">
                                    <path
                                        d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                        style="color: rgba(163, 163, 163, .5)">
                                </svg>
                                <ul 
                                    class="ml-8 w-44 absolute font-semibold bg-white shadow-card rounded-xl py-3 text-left md:ml-8 top-8 right-0 md:left-0"
                                    x-show="isOpen"
                                >
                                    <li><a href="#" class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">Mark as Done</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">Delete Post</a></li> 
                                </ul>
                            </button>
                        </div>
                        <div class="flex items-center mt-4 md:hidden md:mt-0"> 
                           <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                               <div class="text-sm font-bold leading-none">12</div>
                               <div class="text-xxs font-semibold leading-none text-gray-400">votes </div>
                           </div>
                           <button
                            class="w-20 bg-blue border border-blue text-white font-bold text-xxs uppercase rounded-xl hover:border-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5">
                                Vote
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end idea-container-->
        <x-voting-card></x-voting-card>
        <x-voting-card></x-voting-card>
        <x-voting-card></x-voting-card>
    </div><!--end ideas-container-->

</x-app-layout>