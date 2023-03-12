<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Thumbnail;

class AccountMenu extends Component
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();

        $this->user->imageSmall = ! is_null($this->user?->image)
            ? Thumbnail::src(env('APP_URL') . $this->user->image->path)->smartcrop(40, 40)->url(true)
            : '';
        $this->user->imageMiddle = ! is_null($this->user?->image)
            ? Thumbnail::src(env('APP_URL') . $this->user->image->path)->smartcrop(65, 65)->url(true)
            : '';
    }

    public function render(): View|Closure|string
    {
        return view('components.account-menu');
    }
}
