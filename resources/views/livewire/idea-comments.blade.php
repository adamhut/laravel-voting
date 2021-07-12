<div>
    @if($comments->isNotEmpty())

        <div class="comments-container relative space-y-6 pt-4 mt-1 md:ml-22">

            @foreach($comments as $comment)
                <livewire:idea-comment
                    :comment="$comment"
                    :key="$comment->id"
                    :ideaUserId="$idea->user->id"
                ></livewire:idea-comment>
            @endforeach


            <!--end comment-container-->


        </div><!-- end comments-contianer-->

        <div class="md:ml-22 my-8">
            {{ $comments->onEachSide(1)->links() }}
        </div>

    @else
        <div class="mx-auto w-70 mt-12 ">
            <img src="{{ asset('images/no-ideas.svg') }}" alt="No Ideas" class="mx-auto bg-blend-luminosity" >
            <div class="text-gray-400 text-center font-bold mt-6">No Comments Yet...</div>

        </div>
    @endif




</div>

