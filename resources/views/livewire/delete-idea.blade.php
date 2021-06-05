<x-modal-confirm 
    event-to-open-modal="custom-show-delete-modal"
    event-to-close-modal="ideaWasUpdated"   
    modal-title="Delete Idea"
    modal-description="Are you sure you want to delete this idea , this action can not be undone."
    modal-confirm-button-text="Delete"
    wire-click="deleteIdea"
>

</x-modal-confirm>