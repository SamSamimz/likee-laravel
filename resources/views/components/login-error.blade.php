<div>
    @if (session()->has('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif    
</div>