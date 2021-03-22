<x-app-layout>
    <div>
        <a href="/" class="flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="ml-2">All Ideas</span>
        </a>
    </div>

    <div class="idea-container mt-4 bg-white rounded-xl flex">
        <div class="flex-1 flex px-4 py-6">
            <div class="flex-none">
                <a href="#">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar"
                        class="w-14 h-14 rounded-xl">
                </a>
            </div>
    
            <div class="mx-4 w-full flex-1 flex flex-col ">
                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">
                        A rondom title can go here
                    </a>
                </h4>
                <div class="text-gray-700 mt-3 text-xs line-clamp-3 ">
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xxs font-semibold space-x-2 text-gray-400">
                        <span class="font-bold text-gray-800">John Doe</span>
                        <span>&bull;</span>
                        <span>10 hours ago </span>
                        <span>&bull;</span>
                        <span>Category 1</span>
                        <span>&bull;</span>
                        <span class="text-gray-900">3 Comments</span>
                    </div>
                    <div class="flex items-center space-x-2 mt-6 ">
                        <button
                            class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-24 h-7 py-2 px-4">
                            Open
                        </button>
                        <button
                            class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in border px-3 py-2">
                            <svg fill="currentColor" width="24" height="6">
                                <path
                                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                    style="color: rgba(163, 163, 163, .5)">
                            </svg>
                            <ul class="ml-8 w-44 absolute font-semibold bg-white shadow-card rounded-xl py-3 text-left">
                                <li><a href="#"
                                        class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">Mark
                                        as Done</a></li>
                                <li><a href="#"
                                        class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">Delete
                                        Post</a></li>
                            </ul>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end idea-container-->
    <div class="button-container flex items-center justify-between mt-6">
        <div class="flex items-center space-x-4 ml-6">
            <button type="button"
                class="flex items-center justify-center w-32 h-11 text-xs bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                <span>Reply</span>
            </button>
            <button type="button"
                class=" flex items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <span class="mr-1">Set Status</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-4 h-4 transform -rotate-45 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>
        </div>

    </div><!-- end button-container-->

</x-app-layout>