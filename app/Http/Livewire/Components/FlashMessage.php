<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class FlashMessage extends Component
{
    public $message;
    public $type = 'success';
    public $timeout = 3000;

    protected $listeners = ['flash' => 'show'];

    public function show($message, $type = 'success', $timeout = 3000)
    {
        $this->message = $message;
        $this->type = $type;
        $this->timeout = $timeout;

        $this->dispatchBrowserEvent('flash-message', ['timeout' => $this->timeout]);
    }

    public function render()
    {
        return view('livewire.components.flash-message');
    }
}
