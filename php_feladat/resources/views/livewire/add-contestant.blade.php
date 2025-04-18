<div>
    <form wire:submit.prevent="addContestant">
        @csrf
        <label for="add-contestant">Új versenyző hozzáadása:</label>
        <select name="add-contestant" id="add-contestant" wire:model="selectedUserId">
            <option value="">Válassz egy versenyzőt</option>
            @foreach ($contestants as $contestant)
                <option value="{{ $contestant->id }}">{{ $contestant->email }}</option>
                
            @endforeach
        </select>
        <button type="submit">Hozzáad</button>
    </form>
</div>
