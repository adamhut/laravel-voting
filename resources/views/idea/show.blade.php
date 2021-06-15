<x-app-layout>
    {{-- @dump(url()->previous()) --}}
    {{-- @dump(url()->full()) --}}
    <div class="flex items-center justify-between">
        <a href="{{ $backUrl }}" class="hidden md:flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="ml-2">All Ideas (or back to chosen category with filters)</span>
        </a>

    </div>

    <livewire:idea-show 
        :idea="$idea" 
        :votesCount="$votesCount" 
    />
    
    <x-notification-success ></x-notification-success>

    <livewire:idea-comments 
        :idea="$idea"
    >
    </livewire:idea-comments>


    <x-modal-container :idea="$idea"></x-modal-container>

    
</x-app-layout>
