<x-main-layout>
    <div class="card col-8">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <img id="profilePic" style="cursor: pointer; height: 400px;" src="{{$profilePic}}" class="card-img-top pointer" alt="{{auth()->user()->name}}">
            <input class="d-none" type="file" name="image" id="inputFile">
            <x-error for="image" />
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title">Name :</h5>
                    <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}">
                    <x-error for="name" />
                </div>
                
                <div class="mb-3">
                    <h5 class="card-title">Email :</h5>
                    <input type="text" class="form-control" name="email" value="{{auth()->user()->email}}">
                    <x-error for="email" />
                </div>
                <x-button color="danger" />
            </div>
          </div>
        </form>

      @push('scripts')
          <script>
            $('#profilePic').click(function () { 
              $('#inputFile').click();
            });
          </script>
      @endpush

</x-main-layout>

