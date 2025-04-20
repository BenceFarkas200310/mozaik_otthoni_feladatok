<div class="container-md mt-5 ml-auto mr-auto col-5 col-sm-10">

    <center><h2 class="mb-5">Regisztráció</h2></center>
    <form wire:submit.prevent="register">
        @csrf
        <div class="row">
            <label for="name" class="col-md form-label">Név:</label>
            <input type="text" id="name" wire:model="name" class="col input-group-text mb-3">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <label for="email" class="col-md form-label">Email:</label>
            <input type="email" id="email" wire:model="email" class="col input-group-text mb-3">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <label for="password" class="col-md form-label">Jelszó:</label>
            <input type="password" id="password" wire:model="password" class="col input-group-text mb-3">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <label for="phone_number" class="col-md form-label">Telefonszám:</label>
            <input type="text" id="phone_number" wire:model="phone_number" class="col input-group-text mb-3" >
            @error('phone_number') <span class="error">{{ $message }}</span> @enderror
        </div class="row">

        <div class="row">
            <label for="address" class="col-md form-label">Cím:</label>
            <input type="text" id="address" wire:model="address" class="col input-group-text mb-3">
            @error('address') <span class="error">{{ $message }}</span> @enderror
        </div>

        <center><button type="submit" class="btn btn-primary">Regisztráció</button></center>
    </form>
</div>