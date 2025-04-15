
<div>
    <h2>Új verseny felvétele</h2>
    <form action="">
        @csrf
        <label for="new-competition-name">Verseny neve:</label>
        <input type="text" name="new-competition-name" required>
        <label for="new-competition-year">Megrendezés éve:</label>
        <input type="number" name="new-competition-year" required>
        <button>Felvétel</button>
    </form>
</div>

