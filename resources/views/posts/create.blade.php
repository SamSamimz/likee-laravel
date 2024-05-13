<x-main-layout>

    <div class="col-12 col-md-10 col-lg-6  mx-auto">
        <div class="bg-light px-4 py-3 mt-5 rounded">
            <h4 class="py-2 text-center">Whats cooking on your mind?</h4>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Photo :</label>
                    <input type="file" name="image" class="form-control">
                    <x-error for="image"/>
                </div>
                <x-input name="title" />
                <x-error for="title"/>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" name="description" id="" cols="20" rows="4"></textarea>
                </div>
                <x-error for="description"/>
                <x-button color="primary"/>
            </form>
        </div>
    </div>

</x-main-layout>