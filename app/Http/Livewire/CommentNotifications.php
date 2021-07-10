<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentNotifications extends Component
{
    const NOTIFICATION_COUNT_THRESHOLD = 10;

    public $notifications  ;

    public $notificationCount;

    public $isLoading = true;

    protected $listeners =['getNotifications'];

    public function mount()
    {
        $this->notifications = collect();
        $this->isLoading = true;
        $this->getNotificationCount();
    }

    public function getNotifications()
    {

        $this->notifications =auth()
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

        $this->notificationCount =  $this->notificationCount > self::NOTIFICATION_COUNT_THRESHOLD ? self::NOTIFICATION_COUNT_THRESHOLD.'+': $this->notificationCount;
    }


    public function render()
    {
        // dd(auth()->user()->unreadNotifications);
        return view('livewire.comment-notifications');
    }
}
