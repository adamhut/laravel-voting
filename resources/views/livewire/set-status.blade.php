<div
    x-cloak
    class="relative"
    x-data="{isOpen:false}"
    x-init="
        Livewire.on('statusWasUpdated',()=>{
            isOpen = false;
        });

        Livewire.on('statusWasUpdatedError',()=>{
            isOpen = false;
        });
    "

    @click.away="isOpen=false"
    @keydown.escape.window="isOpen=false"
>
    <button type="button" @click="isOpen =!isOpen"
        class=" flex items-center justify-center w-36 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
        <span class="">Set Status</span>

        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="ml-2 w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div class="absolute z-20 w-64 md:w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2 "
        x-show.transition.orgin.top.left.duration.500ms="isOpen">
        <form wire:submit.prevent="setStatus" action="#" class="space-y-4 px-4 py-6">
            <div class="space-y-2">
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" checked="" name="radio-direct" class="bg-gray-200 border-none text-gray-600"
                            value="1" data-fillr-id="1998062331">
                        <span class="ml-2">Open</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" name="radio-direct" value="2" class="bg-gray-200 border-none text-purple"
                            data-fillr-id="1195962757">
                        <span class="ml-2">Considering</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" name="radio-direct" value="3" class="bg-gray-200 border-none text-yellow"
                            data-fillr-id="137245947">
                        <span class="ml-2">In Progress</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" name="radio-direct" value="4" class="bg-gray-200 border-none text-green"
                            data-fillr-id="137245947">
                        <span class="ml-2">Implemented</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" name="radio-direct" value="5" class="bg-gray-200 border-none text-red"
                            data-fillr-id="137245947">
                        <span class="ml-2">Closed</span>
                    </label>
                </div>
            </div>
            <div>
                <textarea
                    name="update_comment"
                    id="update_comment"
                    cols="30"
                    rows="4"
                    wire:model="comment"
                    class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 border-none"
                    placeholder="Add an update comment (optional)"
                >
                </textarea>
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
                <button type="submit"
                    class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white disabled:opacity-50"
                >
                    Update
                </button>
            </div>
            <div>
                <label class="inline-flex items-center text-gray-700 font-normal">
                    <input
                        wire:model="notifyAllVoters"
                        type="checkbox"
                        name="notify_voters"
                        class="rounded bg-gray-200"
                    >
                    <span class="ml-2 ">Notoify all voters</span>
                </label>
            </div>
        </form>
    </div>
</div>