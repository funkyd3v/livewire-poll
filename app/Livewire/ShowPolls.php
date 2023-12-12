<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Livewire\Component;

class ShowPolls extends Component
{
    protected $listeners = [
        'pollCreated' => 'render'
    ];

    // #[On('pollCreated')]
    public function render()
    {
        $polls = Poll::with('options.votes')->latest()->get();
        return view('livewire.show-polls', ['polls' => $polls]);
    }

    public function vote($optionId)
    {
        $option = Option::findOrFail($optionId);
        if ($option) {
            $option->votes()->create();
        }
    }
}
