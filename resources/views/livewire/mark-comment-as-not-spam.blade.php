<x-modal-confirm 
    livewire-event-to-open-modal="markAsNotSpamCommentWasSet" 
    event-to-close-modal="commentWasMarkedAsNotSpam"
    modal-title="Mark Comment as Not Spam" 
    modal-description="Are you sure you want to mark this commnet as NOT spam??"
    modal-confirm-button-text="Reset Spam Counter" 
    wire-click="markAsNotSpam"
>
</x-modal-confirm>
