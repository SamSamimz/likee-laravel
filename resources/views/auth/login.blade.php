<x-guest-layout>
    <div class="col-12 col-md-10 col-lg-6 mx-auto">
        <div class="bg-light px-4 py-5 rounded">
            <h4 class="py-2 text-center">Login now!</h4>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <x-login-error />
                <x-input name="email" />
                <x-error for="email"/>
                <x-input name="password" />
                <x-error for="password"/>
                <x-button color="primary"/>
                <x-link url="{{route('register')}}">Don't have an account?</x-link>
            </form>
        </div>
    </div>
</x-guest-layout>