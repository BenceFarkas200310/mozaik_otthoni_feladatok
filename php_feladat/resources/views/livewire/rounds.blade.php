<div>
    <div class="container">
        <h1>Fordulók</h1>
        <form wire:submit.prevent="addRound">
            <div class="form-group">
                <label for="newRoundName">Új forduló neve</label>
                <input type="text" id="newRoundName" wire:model="newRoundName" class="form-control">
                @error('newRoundName') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Hozzáadás</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Forduló azonosító</th>
                    <th>Forduló neve</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rounds as $round)
                    <tr>
                        <td>{{ $round->id }}</td>
                        <td>{{ $round->name }}</td>
                        <td><a href="/rounds/{{$round->id}}">Részletek</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
