<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class DeleteModal extends Component
{
    public $open = false;
    public $modelId;
    public $modelClass;

    protected $listeners = [
        'openModal' => 'show'
    ];

    public function show($modelId, $modelClass)
    {
        $this->modelId = $modelId;
        $this->modelClass = $modelClass;
        $this->open = true;
    }

    public function delete()
    {
        if($this->modelClass && $this->modelId) {
            $this->modelClass::find($this->modelId)?->delete();
        }

        $this->open = false;
        $this->emit('deleted');
    }

    public function render()
    {
        return view('livewire.components.delete-modal');
    }
}
