<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotifications extends Component
{
    const NOTIFICATION_COUNT_THRESHOLD = 10;

    public $notifications;

    public $notificationCount;

    public $isLoading = true;

    protected $listeners = ['getNotifications'];

    public function mount()
    {
        $this->notifications = collect();
        $this->isLoading = true;
        $this->getNotificationCount();
    }

    public function getNotifications()
    {

        $this->notifications = auth()
            ->user()
            ->unreadNotifications()
            ->take(self::NOTIFICATION_COUNT_THRESHOLD)
            ->get();

        $this->isLoading = false;
    }

    public function getNotificationCount()
    {
        $this->notificationCount = auth()
            ->user()
            ->unreadNotifications()
            ->count();

        $this->notificationCount =  $this->notificationCount > self::NOTIFICATION_COUNT_THRESHOLD ? self::NOTIFICATION_COUNT_THRESHOLD . '+' : $this->notificationCount;
    }

    public function markAllAsRead()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        $this->getNotificationCount();
        $this->getNotifications();
    }

    public function scrollToComment($notification)
    {
        $idea = Idea::find($notification->data['id']);
        if (!$idea) {
            session()->flash('error_message', 'This Idea no longer exists!');
            return redirect()->route('idea.index');
        }

        $comment = Comment::find($notification->data['comment_id']);

        if (!$comment) {
            session()->flash('error_message', 'This Comment no longer exists!');
            return redirect()->route('idea.index');
        }

        $comments = $idea->comments()->pluck('id');
        $ideaOfComment = $comments->search($comment->id);

        $page = ceil($ideaOfComment / $comment->getPerPage());

        session()->flash('scrollToComment', $comment->id);

        return redirect()->route('idea.show', [
            'idea' => $notification->data['idea_slug'],
            'page' => $page,
        ]);
    }

    public function markAsRead($notificationId)
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();

        $this->scrollToComment($notification);
    }

    public function render()
    {
        // dd(auth()->user()->unreadNotifications);
        return view('livewire.comment-notifications');
    }
}
