<div>
    @if(auth()->user()->is_admin == 1)
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
    @else
    <div class="containter">
        <h3>A versenyek, amelyekhez rendelve vagy:</h3>
            <div class="row">
                @foreach ($userCompetitions as $competition)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                {{ $competition->name }}
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $competition->year }}</p>
                                <form action="/competitions/{{ $competition->id }}" method="GET">
                                    @csrf
                                    <button class="btn btn-primary">Részletek</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    @endif
</div>
