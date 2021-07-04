@props([
    'redirect'=>false,
    'messageToDisplay'=>'',
])

<div 
    x-cloak 
    x-data="{
        isOpen:false,
        messageToDisplay:'{{ $messageToDisplay }}',
        showNotification(message){
            this.isOpen = true;
            this.messageToDisplay = message
            setTimeout(()=>{
                this.isOpen=false
            },3000);
        }
    }"
    x-init="
        @if ($redirect)
        
            $nextTick( ()=> showNotification(messageToDisplay) )
        @else
           
            Livewire.on('idexWasUpdated',message => {
                showNotification(message);
            });
            
            Livewire.on('ideaWasMarkedAsSpam',message => {
                showNotification(message);
            });
            
            Livewire.on('ideaWasMarkedAsNotSpam',message => {
                showNotification(message);
            });

            Livewire.on('commentWasAdded',message => {
                showNotification(message);
            });

            Livewire.on('commentWasUpdated',message => {
                showNotification(message);
            });

            Livewire.on('commentWasDeleted',message => {
                showNotification(message);
            });

            Livewire.on('commentWasMarkedAsNotSpam',message => {
                showNotification(message);
            });
            Livewire.on('commentWasMarkedAsNotSpam',message => {
                showNotification(message);
            });
            

        @endif
    " 
    x-show="isOpen" 
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 transform translate-x-8 "
    x-transition:enter-end="opacity-100 transform translate-x-0" 
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-8" 
    @keydown.escape.window="isOpen = false" 
   
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
    class="z-10 flex justify-between fixed max-w-xs sm:max-w-sm w-full px-4 py-5 mr-6 mx-2 sm:mx-6 my-8 bottom-0 right-0 bg-white rounded-lg shadow-lg border ">
    <div class="flex items-center">
        <span>
            <!-- Heroicon name: outline/check-circle -->
            <svg class="h-6 w-6 text-green" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
        <div class="ml-2 font-semibold text-gray-500 text-sm sm:text-base" x-text="messageToDisplay"></div>
    </div>
    <button class="ml-4 text-gray-400 hover:text-gray-500 " @click=" isOpen = false">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>


</div>
