<div class="idea-and-buttons container">
    <div class="idea-container mt-4 bg-white rounded-xl flex">
        <div class="flex-1 flex flex-col md:flex-row px-4 py-6">
            <div class="flex-none mx-2 md:mx-0 ">
                <a href="#">
                    {{-- <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar"
                                class="w-14 h-14 rounded-xl"> --}}
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>

            <div class="mx-2 w-full flex-1 flex flex-col justify-between ">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">

                    {{ $idea->title }}

                </h4>
                <div class="text-gray-700 mt-3 text-xs line-clamp-3 px-2 md:px-0">
                    @admin
                        @if($idea->spam_reports > 0)
                            <div class="text-red mb-2">
                                Spam Reports:{{$idea->spam_reports}}
                            </div>
                        @endif
                    @endadmin    
                    {{ $idea->description }}
                </div>
                <div class="mt-4 flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-center text-xxs font-semibold space-x-2 text-gray-400 mt-3 md:mt-0">
                        <span class="hidden md:block font-bold text-gray-800 ">{{ $idea->user->name }}</span>
                        <span class="hidden md:block">&bull;</span>
                        <span>{{ $idea->created_at->diffForHumans() }} </span>
                        <span>&bull;</span>
                        <span>{{ $idea->category->name }}</span>
                        <span>&bull;</span>
                        <span class="text-gray-900">3 Comments</span>
                    </div>

                    <div x-data="{isOpen:false}" @click.away="isOpen=false" x-cloak
                        @keydown.escape.window="isOpen=false" class="flex items-center space-x-2 mt-4 md:mt-0">
                        <div
                            class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-3">
                            {{ $idea->status->name }}</div>
                        @auth
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
                            <ul class="ml-8 w-44 absolute font-semibold bg-white shadow-card rounded-xl py-3 text-left md:ml-8 top-8 right-0 md:left-0 z-10"
                                x-show.transition.orgin.top.left.duration.500ms="isOpen">
                                @can('update',$idea)
                                <li>
                                    <a 
                                        href="#"
                                        @click.prevent="
                                            isOpen = false;
                                            $dispatch('custom-show-edit-modal')
                                        "
                                        class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                        Edit Idea
                                    </a>
                                </li>
                                @endcan
                                @can('delete',$idea)
                                <li>
                                    <a  href="#"
                                        @click.prevent="
                                            isOpen = false;
                                            $dispatch('custom-show-delete-modal')
                                        "
                                        class="hover:bg-gray-100 text-gray-700 block px-5 py-2 transition duration-150 ease-in ">
                                        Delete Idea
                                    </a>
                                </li>
                                @endcan
                                    <li>
                                        <a href="#"
                                            @click.prevent="
                                                isOpen = false;
                                                $dispatch('custom-show-mark-as-spam-modal')
                                            "
                                            class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                            Mark as Spam
                                        </a>
                                    </li>
                                @admin
                                    @if($idea->sapm_reports>0)
                                        <li>
                                            <a href="#"
                                                @click.prevent="
                                                    isOpen = false;
                                                    $dispatch('custom-show-mark-as-not-spam-modal')
                                                "
                                                class="hover:bg-gray-100 text-gray-700  block px-5 py-2 transition duration-150 ease-in ">
                                                Not Spam
                                            </a>
                                        </li>
                                    @endif
                               @endadmin
                            </ul>
                        </div> 
                        @endauth
                    </div>
                    <div class="flex items-center mt-4 md:hidden md:mt-0">
                        <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">
                                {{ $votesCount }}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">votes </div>
                        </div>
                        @if($hasVoted)
                        <button wire:click.prevent="vote"
                            class="w-20 bg-blue border border-blue text-white font-bold text-xxs uppercase rounded-xl hover:border-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5">
                            Voted
                        </button>
                        @else
                        <button wire:click.prevent="vote"
                            class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">
                            Vote
                        </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end idea-container-->

    <div class="button-container flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0  space-x-0 md:space-x-4 md:ml-6">
            <div class="relative" x-data="{isOpen:false}" @click.away="isOpen=false" x-cloak
                @keydown.escape.window="isOpen=false">
                <button type="button" @click="isOpen = !isOpen"
                    class="flex items-center justify-center w-36 h-11 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white ">
                    <span class="">Reply</span>
                </button>
                <div class="absolute z-10 w-64 md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2 "
                    x-show.transition.orgin.top.left.duration.500ms="isOpen">
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea name="post_comment" id="post_comment" cols="30" rows="4"
                                class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 border-none"
                                placeholder="Go ahead, dont'be shy. Share your thoughts..."></textarea>
                        </div>
                        <div
                            class="flex flex-col md:flex-row items-center space-x-0 md:space-x-3 space-y-2 md:space-y-0">
                            <button type="button"
                                class="flex items-center justify-center w-full md:w-1/2  h-11 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                                Post Comment
                            </button>
                            <button type="button"
                                class="flex items-center justify-center w-full md:w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-4 h-4 transform -rotate-45 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            @admin
            <livewire:set-status :idea="$idea"></livewire:set-status>
            @endadmin
        </div>
        <div class="hidden md:flex items-center space-x-3 ">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 shadow-sm">
                <span class="text-xl leading-snug @if($hasVoted) text-blue @endif"> {{ $votesCount }}</span>【
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>

            @if($hasVoted)
            <button wire:click.prevent="vote"
                class="w-32 bg-blue border border-blue text-white font-bold text-xs uppercase rounded-xl hover:border-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5">
                Voted
            </button>
            @else
            <button wire:click.prevent="vote" type="button"
                class="w-32 h-11 text-xs bg-gray-200 font-semibold rounded-xl uppercase border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <span class="">Vote</span>

            </button>
            @endif

        </div>
    </div><!-- end button-container-->

</div><!-- end idea-and-buttons container-->
