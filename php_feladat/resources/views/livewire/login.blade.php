<div class="container-md mt-5 ml-auto mr-auto col-5 col-sm-10">
    <center><h2 class="mb-5">Bejelentkezés</h2></center>
    <form wire:submit.prevent="login">
        @csrf
        <div class="row">
            <label for="email-input" class="col-md form-label">Email cím:</label>
            <input type="text" id="email-input" name="email-input" wire:model="email" class="col input-group-text mb-3">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <label for="password-input" class="col-md form-label">Jelszó:</label>
            <input type="password" id="password-input" name="email-input" wire:model="password" class="col input-group-text mb-3">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <center>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            <p>Nincs még fiókod? <a href="register">Regisztrálj</a></p>
        </center>
    </form>
</div>
