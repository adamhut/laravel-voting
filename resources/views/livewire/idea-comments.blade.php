<div>
    @if($comments->isNotEmpty())

        <div class="comments-container relative space-y-6 pt-4 mt-1 md:ml-22">
        
            @foreach($comments as $comment)
                <livewire:idea-comment 
                    :comment="$comment" 
                    :key="$comment->id"
                    :ideaUserId="$idea->user->id"  
                ></livewire:idea-comment>
        
            @endforeach
        
           
        
            {{-- <div class="comment-container relative  mt-4 bg-white rounded-xl flex is-admin">
                    <div class="flex-1 flex flex-col md:flex-row px-4 py-6">
                        <div class="flex-none  md:block ">
                            <a href="#">
                                <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar"
                                    class="w-14 h-14 rounded-xl">
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
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id fuga eveniet odit, similique, nobis
                                velit
                                autem deleniti ipsam cumque incidunt hic minus eum facere voluptate officia. Culpa officia
                                perferendis
                                illum? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit, nulla odio eveniet
                                eligendi
                                facilis at, qui autem voluptatibus, omnis saepe voluptatem accusantium asperiores nisi quod
                                aperiam
                                pariatur aliquid culpa corrupti.
                                Dignissimos, nihil natus suscipit sit quas doloremque mollitia. Tenetur quod, repellendus
                                corrupti
                                doloribus sequi quaerat porro inventore sapiente sint veritatis tempora cumque repellat
                                architecto eaque
                                debitis ratione laborum possimus velit!
                                Fuga aliquam animi hic sequi reiciendis accusantium, labore quas dolores esse dignissimos
                                officiis
                                aspernatur. Alias aspernatur nam harum aut dicta delectus quaerat, quia vero culpa quis ad
                                eaque, eius
                                perferendis.
                                Similique quasi eligendi ad aspernatur repudiandae adipisci ipsam doloribus eaque quisquam
                                accusantium
                                ratione blanditiis veritatis placeat velit aut debitis, nesciunt itaque ex tenetur, dolorem
                                facilis,
                                quidem nulla sequi? Blanditiis, iste!
                                Aliquid doloremque laboriosam totam incidunt libero distinctio ipsum commodi, quasi minima
                                exercitationem, magni minus error quibusdam in quaerat corrupti veniam repellendus beatae
                                molestiae
                                culpa vel? Assumenda officia corrupti praesentium mollitia.
                                Corporis, placeat distinctio saepe optio, reprehenderit recusandae quo id quod incidunt nam vero
                                quia
                                deleniti aut, laudantium totam sit consequatur accusantium sunt! Sunt, libero debitis rerum
                                voluptates
                                sequi fugit vitae?
                                Consequuntur, reiciendis itaque asperiores ab ipsam harum voluptatem placeat nulla eum unde
                                molestias
                                quod aperiam, rerum ut iste laboriosam cum! Ipsam esse veniam voluptatibus dolorem optio,
                                distinctio
                                aspernatur consequuntur facere.
                                Dolore incidunt, dolor consequatur adipisci magnam odio optio ducimus vitae ab totam quo quas et
                                odit
                                corrupti nulla, asperiores neque hic doloribus? Fuga excepturi, reiciendis deserunt nesciunt hic
                                magni
                                earum.
                                Id aperiam, saepe incidunt nisi, qui impedit optio laudantium, quasi sapiente eligendi dolor
                                minus
                                eveniet iste quam rem a atque suscipit. Aliquam impedit repudiandae vel velit dolore sint,
                                inventore
                                quis!
                                Eum, voluptates quas. Voluptas doloremque error, ipsum perferendis debitis repellat nisi,
                                suscipit aut
                                modi ratione possimus minima distinctio quae impedit! Tempora accusantium consequuntur aliquid
                                facilis
                                harum culpa ducimus tempore veniam?
                            </div>
                            <div class="flex items-center justify-between mt-4 md:mt-0">
                                <div class="flex items-center text-xxs font-semibold space-x-2 text-gray-400">
                                    <span class="font-bold text-blue">Andrea</span>
                                    <span>&bull;</span>
                                    <span>10 hours ago </span>
                                </div>
                                <div class="flex items-center space-x-2 md:mt-6" x-data="{isOpen:false}" @click.away="isOpen=false"
                                    x-cloak @keydown.escape.window="isOpen=false">
                                    <div class="relative">
                                        <button
                                            class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in border px-3 py-2"
                                            @click="isOpen = !isOpen">
                                            <svg fill="currentColor" width="24" height="6">
                                                <path
                                                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                                    style="color: rgba(163, 163, 163, .5)">
                                            </svg>
                
                                        </button>
                                        <ul x-show.transition.orgin.top.left.duration.500ms="isOpen"
                                            class="ml-8 w-44 absolute z-10 font-semibold bg-white shadow-card rounded-xl py-3 text-left md:ml-8 top-8 right-0 md:left-0">
                                            <li><a href="#"
                                                    class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                                    Mark as Spam
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">Delete
                                                    Post</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        
        
        
        
            <!--end comment-container-->
             {{-- <x-comment-container></x-comment-container> --}}
            {{-- <x-comment-container></x-comment-container> --}}
        
        </div><!-- end comments-contianer-->

        <div class="md:ml-22 my-8">
            {{ $comments->onEachSide(1)->links() }}
        </div>
        
    @else
        <div class="mx-auto w-70 mt-12 ">
            <img src="{{ asset('images/no-ideas.svg') }}" alt="No Ideas" class="mx-auto" style="mix-blend-mode: luminosity">
            <div class="text-gray-400 text-center font-bold mt-6">No Comments Yet...</div>
        
        </div>    
    @endif




</div>

