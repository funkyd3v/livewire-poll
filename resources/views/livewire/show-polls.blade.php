<div class="mt-5 mb-3">
    <h2 class="font-bold">Availble Polls</h2>
    @forelse ($polls as $poll)
        <h3 class="font-bold mt-3">{{ $poll->title }}</h3>
        @foreach ($poll->options as $option)
            <div class="mb-2">
                <button class="bg-gray-300 rounded px-1" wire:click="vote({{ $option->id }})">Vote</button>
                {{ $option->name }} ({{ $option->votes->count() }})
            </div>
        @endforeach
    @empty
        <h4>No poll is avialable</h4>
    @endforelse
</div>
