<x-main-layout>

    <div class="col-12 col-md-10 col-lg-6  mx-auto">
        <div class="bg-light px-4 py-3 mt-5 rounded">
            <h4 class="py-2 text-center">Edit Post</h4>
            <img class="py-2 rounded" src="{{ '\storage/'.$post->image }}" alt="{{ $post->title }}" height="250">
            <form action="{{ route('posts.update',$post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title :</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}"/>
                </div>
                <x-error for="title"/>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" name="description" id="" cols="20" rows="4">{{ $post->description }}</textarea>
                </div>
                <x-error for="description"/>
                <x-button color="primary"/>
            </form>
        </div>
    </div>

</x-main-layout>