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
                        <span class="text-gray-900">{{  $idea->comments()->count() }} Comments</span>
                    </div>

                    <div
                        x-data="{isOpen:false}"
                        x-cloak
                        @click.away="isOpen=false"
                        @keydown.escape.window="isOpen=false"
                        class="flex items-center space-x-2 mt-4 md:mt-0"
                    >
                        <div
                            class="{{ 'status-'.Str::kebab($idea->status->name)}} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-3">
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
            <livewire:add-comment :idea="$idea"></livewire:add-comment>
            @admin
            <livewire:set-status :idea="$idea"></livewire:set-status>
            @endadmin
        </div>
        <div class="hidden md:flex items-center space-x-3 ">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 shadow-sm">
                <span class="text-xl leading-snug @if($hasVoted) text-blue @endif"> {{ $votesCount }}</span>
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
