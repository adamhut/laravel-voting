 <div class="comment-container relative  mt-4 bg-white rounded-xl flex  transition duration-500 ease-in">
    <div class="flex-1 flex flex-col md:flex-row px-4 py-6">{{-- is-admin --}}
        <div class="flex-none  md:block ">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            <div class="md:text-center text-blue uppercase text-xxs font-bold mt-2">Admin</div>
        </div>

        <div class="md:mx-4 w-full flex-1 flex flex-col ">
            {{-- <h4 class="text-xl font-semibold">
                <a href="#" class="hover:underline">
                    Status Changed to "Under Considerration"
                </a>
            </h4> line-clamp-3 --}}
            <div class="text-gray-600  text-xs ">
               {{ $comment->body }}
            </div>
            <div class="flex items-center justify-between mt-4 md:mt-0">
                <div class="flex items-center text-xxs font-semibold space-x-2 text-gray-400">
                    
                    <span class="font-bold text-blue">{{ $comment->user->name }}</span>
                    <span>&bull;</span>
                    @if(auth()->check() && auth()->user()->id == $ideaUserId)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <span>&bull;</span>
                    @endif
                    <span>{{ $comment->created_at->diffForHumans() }} </span>
                </div>
                @auth    
                    <div 
                        x-cloak 
                        x-data="{isOpen:false}" 
                        @click.away="isOpen=false"  
                        class="flex items-center space-x-2 md:mt-6" 
                        @keydown.escape.window="isOpen=false"
                    >
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
                                
                                @can('update',$comment)
                                    <li>
                                        <a href="#" 
                                            @click.prevent="
                                                isOpen = false;
                                                Livewire.emit('setEditComment',{{ $comment->id }})
                                                {{-- $dispatch('custom-show-edit-comment-modal') --}}
                                            "
                                            class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                            Edit Comment
                                        </a>
                                    </li>
                                @endcan
                               
                                <li>
                                    <a href="#" class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                        Mark as Spam
                                    </a>
                                </li>
                               @can('delete',$comment)
                               <li>
                                    <a href="#" 
                                        @click.prevent="
                                          
                                            Livewire.emit('setDeleteComment',{{ $comment->id }})
                                            {{-- $dispatch('custom-show-edit-comment-modal') --}}
                                        "
                                        class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                        Delete Comment
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>