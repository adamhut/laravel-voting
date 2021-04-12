<div x-data @click="

                    const clicked = $event.target;

                    {{-- console.log($event.target.closest('.idea-container').querySelector('.idea-link').click() ); --}}
                    const target= clicked.tagName.toLowerCase();
                    
                    {{-- console.log(target); --}}

                    const ignores = ['button','svg','a','path']; 

                    if(ignores.includes(target))
                    {
                        return;
                    }
                    
                    clicked.closest('.idea-container').querySelector('.idea-link').click();

                "
    class="idea-container bg-white rounded-xl flex hover:shadow-card transition ease-in duration-150 cursor-pointer">
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
            <div class="text-gray-500">votes</div>
        </div>
        <div class="mt-8">
            @if($hasVoted)
                <button
                    wire:click.prevent="vote"
                    class="w-20 bg-blue border border-blue text-white hover:border-blue-hover font-bold text-xxs uppercase rounded-xl px-3 py-2 hover:bg-blue-hover transition-colors ease-in duration-100">
                    Voted
                </button>
            @else
                <button
                    wire:click.prevent="vote"
                    class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl px-3 py-2 hover:bg-gray-300 transition-colors ease-in duration-100">
                    Vote
                </button>

            @endif
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                {{-- <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" 
                                alt="avatar" class="w-14 h-14 rounded-xl"> --}}
                <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">

            </a>
        </div>

        <div class="mx-2 md:mx-4 w-full flex flex-col">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{ route('idea.show',$idea) }}" class="idea-link hover:underline">{{ $idea->title }}</a>
            </h4>
            <div class="text-gray-700 mt-3 text-xs line-clamp-3 px-2 md:px-0">
                {{ $idea->description }}
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xxs font-semibold space-x-0 md:space-x-2 text-gray-400">
                    <span>{{ $idea->created_at->diffForHumans() }} </span>
                    <span>&bull;</span>
                    <span>{{ $idea->category->name }}</span>
                    <span>&bull;</span>
                    <span class="text-gray-900">3 Comments</span>
                </div>
                <div class="flex items-center space-x-2 mt-4 md:mt-6 " x-data="{isOpen:false}"
                    @click.away="isOpen=false" x-cloak @keydown.escape.window="isOpen=false">
                    <div
                        class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                        {{ $idea->status->name }}</div>
                    <button
                        class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in border px-3  py-2"
                        @click="isOpen=!isOpen">
                        <svg fill="currentColor" width="24" height="6">
                            <path
                                d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                style="color: rgba(163, 163, 163, .5)">
                        </svg>
                        <ul class="ml-8 w-44 absolute font-semibold bg-white shadow-card rounded-xl py-3 text-left md:ml-8 top-8 right-0 md:left-0"
                            x-show="isOpen">
                            <li><a href="#"
                                    class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">Mark
                                    as Done</a></li>
                            <li><a href="#"
                                    class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">Delete
                                    Post</a></li>
                        </ul>
                    </button>
                </div>
                <div class="flex items-center mt-4 md:hidden md:mt-0">
                    <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">votes </div>
                    </div>
                    @if($hasVoted)
                    <button
                        wire:click.prevent="vote"
                        class="w-20 bg-blue border border-blue text-white font-bold text-xxs uppercase rounded-xl hover:border-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5">
                        Voted
                    </button>
                        
                    @else
                        <button
                            wire:click.prevent="vote"
                            class="w-20 bg-gray-200 border border-gray-200 text-white font-bold text-xxs uppercase rounded-xl hover:border-gray-300 transition duration-150 ease-in px-4 py-3 -mx-5">
                            Vote
                        </button>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--end idea-container-->