
<div class="container-md mt-5 ml-auto mr-auto col-5 col-sm-10">
    <h2>Új verseny felvétele</h2>
    <form wire:submit.prevent="addCompetition" class="p-sm-0 p-md-2">
        @csrf
        <div class="row">
            <label for="add-new-comp-name" class="col-md form-label">Új verseny neve:</label>
            <input type="text" name="add-new-comp-name" id="add-new-comp-name" wire:model="newName" class="col input-group-text mb-3">
            @error('newName')
                <span class="error">{{ $message }}</span>
            @enderror

        </div>

        <div class="row">
            <label for="add-new-comp-year" class="col-md form-label">Új verseny éve:</label>
            <input type="number" name="add-new-comp-year" id="add-new-comp-year" value="2025" min="2025" wire:model="newYear" class="col input-group-text mb-3">
            @error('newYear')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <label for="add-new-comp-lang" class="col-md form-label">Milyen nyelven fog folyni a verseny:</label>
            <select name="add-new-comp-lang" id="add-new-comp-lang" wire:model="newLang" class="col form-select mb-3">
                <option value="hu" selected>magyar</option>
                <option value="en">angol</option>
                <option value="de">német</option>
            </select>
        </div>

        <div class="row">
            <label for="points-for-right" class="col-md form-label">Jó válaszért járó pont:</label>
            <input type="number" name="points-for-right" id="points-for-right" value="1" min="1" wire:model="pointsForRight" class="col input-group-text mb-3">
        </div>

        <div class="row">
            <label for="points-for-wrong" class="col-md form-label">Rossz válaszért járó pont:</label>
            <input type="number" name="points-for-wrong" id="points-for-wrong" value="0" max="0" wire:model="pointsForWrong" class="col input-group-text mb-3">
        </div>

        <div class="row">
            <label for="points-for-empty" class="col-md form-label">Üres válaszért járó pont:</label>
            <input type="number" name="points-for-empty" id="points-for-empty" value="0" wire:model="pointsForEmpty" class="col input-group-text mb-3">
        </div>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <center><button type="submit" class="btn btn-primary">Felvétel</button></center>
    </form>
</div>

