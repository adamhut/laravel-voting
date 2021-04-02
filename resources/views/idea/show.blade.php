<x-app-layout>
    <div class="flex items-center justify-between">
        <a href="{{ route('idea.index')}}" class="hidden md:flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="ml-2">All Ideas</span>
        </a>
        
    </div>

    <div class="idea-container mt-4 bg-white rounded-xl flex">
        <div class="flex-1 flex flex-col md:flex-row px-4 py-6">
            <div class="flex-none mx-2 md:mx-0 ">
                <a href="#">
                    {{-- <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar"
                        class="w-14 h-14 rounded-xl"> --}}
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
    
            <div class="mx-2 md:mx-4 w-full flex-1 flex flex-col justify-between ">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">
                    <a href="#" class="hover:underline">
                        {{ $idea->title }}
                    </a>
                </h4>
                <div class="text-gray-700 mt-3 text-xs line-clamp-3 px-2 md:px-0">
                   {{ $idea->description }}
                </div>
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-center text-xxs font-semibold space-x-2 text-gray-400 mt-3 md:mt-0">
                        <span class="hidden md:block font-bold text-gray-800 ">{{ $idea->user->name }}</span>
                        <span class="hidden md:block">&bull;</span>
                        <span>{{ $idea->created_at->diffForHumans() }} </span>
                        <span>&bull;</span>
                        <span>{{ $idea->category->name }}</span>
                        <span>&bull;</span>
                        <span class="text-gray-900">3 Comments</span>
                    </div>
                    <div
                        x-data="{isOpen:false}"
                        @click.away="isOpen=false"
                        x-cloak
                        @keydown.escape.window="isOpen=false"
                        class="flex items-center space-x-2 mt-4 md:mt-0"
                    >
                        <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-3">{{ $idea->status->name }}</div>
                        <button
                            class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in border px-3 py-2"
                            @click="isOpen = !isOpen"   
                        >
                            <svg fill="currentColor" width="24" height="6">
                                <path
                                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                    style="color: rgba(163, 163, 163, .5)">
                            </svg>
                            <ul 
                                class="ml-8 w-44 absolute font-semibold bg-white shadow-card rounded-xl py-3 text-left md:ml-8 top-8 right-0 md:left-0 z-10"
                                x-show.transition.orgin.top.left.duration.500ms="isOpen"
                            >
                                <li><a href="#"
                                        class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                        Mark as Done
                                    </a>
                                </li>
                                <li>
                                <a href="#"
                                        class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">Delete
                                        Post</a>
                                </li>
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

    <div class="button-container flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0  space-x-0 md:space-x-4 md:ml-6">
            <div 
                class="relative"
                x-data="{isOpen:false}"
                @click.away="isOpen=false"
                x-cloak
                @keydown.escape.window="isOpen=false"
            >
                <button type="button"
                    @click="isOpen = !isOpen"
                    class="flex items-center justify-center w-36 h-11 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white ">
                    <span class="">Reply</span>
                </button> 
                <div 
                    class="absolute z-10 w-64 md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2 "
                    x-show.transition.orgin.top.left.duration.500ms="isOpen"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea name="post_comment" id="post_comment" 
                                cols="30" 
                                rows="4"
                                class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 border-none" 
                                placeholder="Go ahead, dont'be shy. Share your thoughts..."
                            ></textarea>
                        </div>
                        <div class="flex flex-col md:flex-row items-center space-x-0 md:space-x-3 space-y-2 md:space-y-0">
                            <button 
                                type="button"
                                class="flex items-center justify-center w-full md:w-1/2  h-11 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white"
                            >
                                Post Comment
                            </button>
                            <button type="button"
                                class="flex items-center justify-center w-full md:w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    class="w-4 h-4 transform -rotate-45 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <div 
                class="relative"
                x-data="{isOpen:false}"
                @click.away="isOpen=false"
                x-cloak
                @keydown.escape.window="isOpen=false"
            >
                <button type="button"
                    @click="isOpen =!isOpen"
                    class=" flex items-center justify-center w-36 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <span class="">Set Status</span>
                
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="ml-2 w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div 
                    class="absolute z-20 w-64 md:w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2 "
                    x-show.transition.orgin.top.left.duration.500ms="isOpen"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div class="space-y-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" name="radio-direct" class="bg-gray-200 border-none text-gray-600" value="1" data-fillr-id="1998062331">
                                    <span class="ml-2">Open</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" value="2" class="bg-gray-200 border-none text-purple" data-fillr-id="1195962757">
                                    <span class="ml-2">Considering</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" value="3" class="bg-gray-200 border-none text-yellow" data-fillr-id="137245947">
                                    <span class="ml-2">In Progress</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" value="3" class="bg-gray-200 border-none text-green"
                                        data-fillr-id="137245947">
                                    <span class="ml-2">Implemented</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" value="3" class="bg-gray-200 border-none text-red"
                                        data-fillr-id="137245947">
                                    <span class="ml-2">Closed</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <textarea name="update_comment" id="update_comment" cols="30" rows="4"
                                class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 border-none"
                                placeholder="Add an update comment (optional)"></textarea>
                        </div>
                       <div class="flex flex-col md:flex-row items-center space-x-0 md:space-x-3 space-y-2 md:space-y-0">
                            
                            <button type="button"
                                class="flex items-center justify-center w-full md:w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    class="w-4 h-4 transform -rotate-45 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                            <button type="button"
                                class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                                Update
                            </button>
                        </div>
                        <div>
                            <label class="inline-flex items-center text-gray-700 font-normal">
                                <input type="checkbox" checked="" name="notify_voters" class="rounded bg-gray-200">
                                <span class="ml-2 ">Notoify all voters</span>
                            </label>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
        <div class="hidden md:flex items-center space-x-3 ">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 shadow-sm"> 
                <span class="text-xl leading-snug">12</span>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
           <button type="button"
            class="w-24 h-11 text-xs bg-gray-200 font-semibold rounded-xl uppercase border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <span class="">Vote</span>
            
            </button>
        </div>
    </div><!-- end button-container-->
    <div class="comments-container relative space-y-6 pt-4 mt-1 md:ml-22">
        <div class="is-admin comment-container relative  mt-4 bg-white rounded-xl flex">
            <div class="flex-1 flex flex-col md:flex-row px-4 py-6">
                <div class="flex-none  md:block ">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar"
                            class="w-14 h-14 rounded-xl">
                        {{-- <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl"> --}}
                    </a>
                    <div class="md:text-center text-blue uppercase text-xxs font-bold mt-2">Admin</div>
                </div>
        
                <div class="md:mx-4 w-full flex-1 flex flex-col ">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">
                            Status Changed to "Under Considerration"
                        </a>
                    </h4>
                    <div class="text-gray-700  text-xs line-clamp-3 ">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Id fuga eveniet odit, similique, nobis velit
                        autem deleniti ipsam cumque incidunt hic minus eum facere voluptate officia. Culpa officia perferendis
                        illum? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit, nulla odio eveniet eligendi
                        facilis at, qui autem voluptatibus, omnis saepe voluptatem accusantium asperiores nisi quod aperiam
                        pariatur aliquid culpa corrupti.
                        Dignissimos, nihil natus suscipit sit quas doloremque mollitia. Tenetur quod, repellendus corrupti
                        doloribus sequi quaerat porro inventore sapiente sint veritatis tempora cumque repellat architecto eaque
                        debitis ratione laborum possimus velit!
                        Fuga aliquam animi hic sequi reiciendis accusantium, labore quas dolores esse dignissimos officiis
                        aspernatur. Alias aspernatur nam harum aut dicta delectus quaerat, quia vero culpa quis ad eaque, eius
                        perferendis.
                        Similique quasi eligendi ad aspernatur repudiandae adipisci ipsam doloribus eaque quisquam accusantium
                        ratione blanditiis veritatis placeat velit aut debitis, nesciunt itaque ex tenetur, dolorem facilis,
                        quidem nulla sequi? Blanditiis, iste!
                        Aliquid doloremque laboriosam totam incidunt libero distinctio ipsum commodi, quasi minima
                        exercitationem, magni minus error quibusdam in quaerat corrupti veniam repellendus beatae molestiae
                        culpa vel? Assumenda officia corrupti praesentium mollitia.
                        Corporis, placeat distinctio saepe optio, reprehenderit recusandae quo id quod incidunt nam vero quia
                        deleniti aut, laudantium totam sit consequatur accusantium sunt! Sunt, libero debitis rerum voluptates
                        sequi fugit vitae?
                        Consequuntur, reiciendis itaque asperiores ab ipsam harum voluptatem placeat nulla eum unde molestias
                        quod aperiam, rerum ut iste laboriosam cum! Ipsam esse veniam voluptatibus dolorem optio, distinctio
                        aspernatur consequuntur facere.
                        Dolore incidunt, dolor consequatur adipisci magnam odio optio ducimus vitae ab totam quo quas et odit
                        corrupti nulla, asperiores neque hic doloribus? Fuga excepturi, reiciendis deserunt nesciunt hic magni
                        earum.
                        Id aperiam, saepe incidunt nisi, qui impedit optio laudantium, quasi sapiente eligendi dolor minus
                        eveniet iste quam rem a atque suscipit. Aliquam impedit repudiandae vel velit dolore sint, inventore
                        quis!
                        Eum, voluptates quas. Voluptas doloremque error, ipsum perferendis debitis repellat nisi, suscipit aut
                        modi ratione possimus minima distinctio quae impedit! Tempora accusantium consequuntur aliquid facilis
                        harum culpa ducimus tempore veniam?
                    </div>
                    <div class="flex items-center justify-between mt-4 md:mt-0">
                        <div class="flex items-center text-xxs font-semibold space-x-2 text-gray-400">
                            <span class="font-bold text-blue">Andrea</span>
                            <span>&bull;</span>
                            <span>10 hours ago </span>
                        </div>
                        <div 
                            class="flex items-center space-x-2 md:mt-6"
                            x-data="{isOpen:false}"
                            @click.away="isOpen=false"
                            x-cloak
                            @keydown.escape.window="isOpen=false"
                        >
                            <button
                                class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in border px-3 py-2"
                                @click="isOpen = !isOpen"
                            >
                                <svg fill="currentColor" width="24" height="6">
                                    <path
                                        d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                        style="color: rgba(163, 163, 163, .5)">
                                </svg>
                                <ul 
                                    x-show.transition.orgin.top.left.duration.500ms="isOpen" 
                                    class="ml-8 w-44 absolute z-10 font-semibold bg-white shadow-card rounded-xl py-3 text-left md:ml-8 top-8 right-0 md:left-0">
                                    <li><a href="#"
                                            class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                            Mark as Done
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">Delete
                                            Post</a>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end comment-container-->
        <x-comment-container></x-comment-container>
        <x-comment-container></x-comment-container>
        
    </div><!-- end comments-contianer-->
</x-app-layout>