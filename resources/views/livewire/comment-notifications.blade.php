<div x-data="{isOpen:false}" x-cloak @click.away="isOpen=false" @keydown.escape.window="isOpen=false" class="relative">
    <button
        class="relative"
        @click="
            isOpen=!isOpen
            if(isOpen){
                Livewire.emit('getNotifications')
            }

        "

    >
        <svg class="h-6 w-6 text-gray-500 " viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>
        <div
            class="absolute rounded-full border border-white bg-red text-white text-xxs -top-1 -right-1 h-4 w-4 flex justify-center items-center">
            {{ $notifications->count() }}
        </div>
    </button>
    <ul class="ml-8 w-76 md:w-96 absolute bg-white shadow-dialog text-xs rounded-xl pt-3 text-left md:ml-8 top-8 md:top-6 z-10 max-h-128 overflow-y-auto md:-right-12 -right-24"
        x-show.transition.origin.top="isOpen" x-cloak @click.away="isOpen=false" @keydown.escape.window="isOpen=false">
        @foreach ($notifications as $notification)
            <li class="">
                <a
                    href="{{ route('idea.show', $notification->data['idea_slug']) }}"
                    class="hover:bg-gray-100 text-gray-700  flex px-5 py-2 transition duration-150 ease-in"
                    {{-- @click.prevent=" isOpen = false " --}}
                >
                    <img src="{{ $notification->data['user_avatar'] }}" alt="avatar"
                        class="w-10 h-10 rounded-full">
                    <div class="ml-4">
                        <div class="line-clamp-6">
                            <span class="font-semibold">{{ $notification->data['user_name'] }}</span>
                            Commentd on
                            <span class="font-semibold">{{ $notification->data['idea_title'] }}</span>:
                            <span>{{ $notification->data['comment_body'] }}</span>
                        </div>
                        <div class="text-xxs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            </li>
        @endforeach

        <li class="border-t border-gray-300 text-center text-sm ">
            <button
                class="hover:bg-gray-100 text-gray-700 w-full text-center font-semibold block px-5 py-2 transition duration-150 ease-in ">
                Mark all as read</button>
        </li>
    </ul>
</div>