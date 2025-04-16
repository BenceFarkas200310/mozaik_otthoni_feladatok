<div>
    <h3>Versenyek</h3>
    <ul>
        @foreach ($competitions as $competition)
            <li>
                {{ $competition->name }}
                <form action="/competitions/{{ $competition->id }}" method="GET">
                    @csrf
                    <button>Részletek</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>