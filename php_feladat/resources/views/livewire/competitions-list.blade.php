<div>
    <center>
        <h2 class="mt-5">Versenyek</h2>
        <div class="row p-3 justify-content-md-center">
            @foreach ($competitions as $competition)
                <div class="col-md-5 mb-4">
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
    </center>
</div>