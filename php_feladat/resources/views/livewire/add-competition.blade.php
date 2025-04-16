
<div>
    <h2>Új verseny felvétele</h2>
    <form wire:submit.prevent="addCompetition">
        @csrf
        <div>
            <label for="add-new-comp-name">Új verseny neve</label>
            <input type="text" name="add-new-comp-name" id="add-new-comp-name" wire:model="newName">
            @error('newName')
                <span class="error">{{ $message }}</span>
            @enderror

        </div>

        <div>
            <label for="add-new-comp-year">Új verseny éve</label>
            <input type="number" name="add-new-comp-year" id="add-new-comp-year" value="2025" min="2025" wire:model="newYear">
            @error('newYear')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="add-new-comp-lang">Milyen nyelven fog folyni a verseny</label>
            <select name="add-new-comp-lang" id="add-new-comp-lang" wire:model="newLang">
                <option value="hu" selected>magyar</option>
                <option value="en">angol</option>
                <option value="de">német</option>
            </select>
        </div>

        <div>
            <label for="points-for-right">Jó válaszért járó pont</label>
            <input type="number" name="points-for-right" id="points-for-right" value="1" min="1" wire:model="pointsForRight">
        </div>

        <div>
            <label for="points-for-wrong">Rossz válaszért járó pont</label>
            <input type="number" name="points-for-wrong" id="points-for-wrong" value="-1" max="0" wire:model="pointsForWrong">
        </div>

        <div>
            <label for="points-for-empty">Üres válaszért járó pont</label>
            <input type="number" name="points-for-empty" id="points-for-empty" value="0" wire:model="pointsForEmpty">
        </div>

        <button type="submit">Felvétel</button>
    </form>
</div>

