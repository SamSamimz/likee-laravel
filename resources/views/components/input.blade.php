<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ ucfirst($name) }} :</label>
    <input type="{{ $name === 'password' || $name === 'password_confirmation' ? 'password' : 'text' }}" name="{{ $name }}" class="form-control" autocomplete="off">
</div>