<div>
    <h2>Bejelentkezés</h2>
    <form wire:submit.prevent="login">
        @csrf
        <div>
            <label for="email-input">Email cím:</label>
            <input type="text" name="email-input" wire:model="email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password-input">Jelszó:</label>
            <input type="password" name="email-input" wire:model="password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit">Bejelentkezés</button>
        <p>Nincs még fiókod? <a href="register">Regisztrálj</a></p>
    </form>
</div>
