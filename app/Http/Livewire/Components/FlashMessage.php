<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class FlashMessage extends Component
{
    public $message;
    public $type = 'success';

    protected $listeners = ['flash' => 'show'];

    public function show($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        $this->dispatchBrowserEvent('flash-message');
    }

    public function render()
    {
        return view('livewire.components.flash-message');
    }
}
