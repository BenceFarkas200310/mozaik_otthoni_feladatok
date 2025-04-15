<div>
    <h2>Regisztráció</h2>
    <form wire:submit.prevent="register">
        @csrf
        <div>
            <label for="name">Név</label>
            <input type="text" id="name" wire:model="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Jelszó</label>
            <input type="password" id="password" wire:model="password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="phone_number">Telefonszám</label>
            <input type="text" id="phone_number" wire:model="phone_number">
            @error('phone_number') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="address">Cím</label>
            <input type="text" id="address" wire:model="address">
            @error('address') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Regisztráció</button>
    </form>
</div>