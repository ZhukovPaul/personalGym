<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountMenu extends Component
{
    public $user ; 
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
        //$this->user->image->path;
        $this->user->imageSmall =  \Thumbnail::src( env( 'APP_URL' ) . $this->user->image->path )->smartcrop(40, 40)->url( true ); 
        $this->user->imageMiddle =  \Thumbnail::src( env( 'APP_URL' ) . $this->user->image->path )->smartcrop(65, 65)->url( true ); 
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account-menu');
    }
}
