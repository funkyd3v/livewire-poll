<div>
    <form wire:submit.prevent="createPoll">
        <label for="title">Poll Title</label><br>
        <input type="text" name="title" wire:model.live="title" class="border rounded-md border-indigo-700 w-96"/> <br>
        @error('title')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div>
            <button class="btn mt-3 bg-yellow-500 px-3 py-1 rounded" wire:click.prevent="addOption">Add Option</button>
        </div>
    
        <div>
            @foreach ($options as $index => $option)
                <div class="mt-6">
                    <label>Option {{ $index + 1 }}</label>
                </div>
                <div>
                    <input type="text" class="border border-yellow-500 rounded-md pl-1" wire:model="options.{{ $index }}"/>
                    <button type="button" class="rounded bg-red-500 px-2 ml-2" wire:click.prevent="removeOption({{ $index }})">Remove</button>
                    @error('options.*')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="submit" class="border border-grey-900 rounded rounded-lg mt-3 px-2 py-1">Create Poll</button>
    </form>
</div>
