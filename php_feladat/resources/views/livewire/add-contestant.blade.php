<div>
    @if ($contestants->isEmpty())
       <h4>Még nincs versenyző rendelve a fordulóhoz!</h4>
    
    @else
        <ul>
            @foreach($contestants as $contestant)
                <li>{{ $contestant->name }} ({{ $contestant->email }})</li>
            @endforeach
        </ul>
    @endif
    
    <h3>Új versenyző hozzáadása:</h3>
    <form wire:submit.prevent="addContestant">
        @csrf
        <label for="add-contestant">Új versenyző hozzáadása:</label>
        <select name="add-contestant" id="add-contestant" wire:model="selectedUserId">
            <option value="">Válassz egy versenyzőt</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->email }}</option>
                
            @endforeach
        </select>
        <button type="submit">Hozzáad</button>
    </form>
</div>
