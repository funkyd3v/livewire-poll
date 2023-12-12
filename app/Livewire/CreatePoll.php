<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    #[Locked]
    public $title;
    #[Locked]
    public $options = [];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:2|max:10',
        'options.*' => 'required|min:2|max:255'
    ];

    protected $messages = [
        'title' => 'Poll title is required',
        'title.min' => 'The title is too short!',
        'options.*' => "Option can't be empty",
        'options.*.min' => 'Too short!'
    ];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createPoll()
    {
        $this->validate();

        Poll::create([
            'title' => $this->title,
        ])->options()->createMany(collect($this->options)->map(fn($option) => ['name' => $option]));

        $this->reset(['title', 'options']);

        $this->dispatch('pollCreated');
    }
}
