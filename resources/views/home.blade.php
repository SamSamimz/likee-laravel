<x-main-layout>
    <div class="col-9 mx-auto">

        <a href="{{route('posts.create')}}">
            <div class="col-12 text-center py-3 bg-light mt-3 rounded">
                <span class="text-secondary"><ion-icon style="font-size: 80px" name="add-circle-outline"></ion-icon></span>
                <p>What's cooking?</p>
            </div>
        </a>
            
    @foreach ($posts as $post)
        <div class="bg-light p-3 mt-2 rounded">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex gap-2 mb-2">
                    <a href="{{ route('userProfile',$post->user) }}"><img style="width: 54px; height: 54px; border-radius: 50%" src="{{$post->user->image ? '\storage/'.$post->user->image->path : '/storage/profiles/person.jpg' }}" />
                    </a>
                    <div class="">
                        <h6><a href="{{ route('userProfile',$post->user) }}" class="text-black">{{ $post->user->name }}</a></h6>
                        <p class="text-secondary">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                    </button>
                    <ul class="dropdown-menu">
                        @auth
                            @if ($post->user_id === auth()->user()->id)
                                <li><a class="dropdown-item" href="{{ route('posts.edit',$post) }}">Edit</a></li>
                            @endif
                            <li><a class="dropdown-item" href="#">Save</a></li>
                        @endauth
                      <li><a class="dropdown-item" href="{{route('download',$post)}}">Download Image</a></li>
                    </ul>
                  </div>

            </div>
            <div>{{ $post->title }}</div>
            <a href="{{ route('posts.show',$post) }}">
                <img style="cursor: pointer;width:100%;height:470px" class="img-fluid" src="{{ '\storage/'.$post->image }}" alt="">
            </a>

            <div class="text-danger d-flex align-items-center justify-content-between px-2">
                @if ($post->likes->count() > 0)
                <span class="pt-1 px-2">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                @endif
                @if ($post->comments->count() > 0)
                <span class="pt-1 px-2">{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
                @endif
            </div>

            @auth    
            <div class="py-3 d-flex align-items-center justify-content-between">
                <form action="{{ route('like.post',$post) }}" method="POST">
                    @csrf
                    <button type="submit" class="d-flex @if ($post->likedBy(auth()->user()))
                        text-primary
                        @endif align-items-center gap-1"><ion-icon name="thumbs-up-outline"></ion-icon>@if ($post->likedBy(auth()->user()))
                        UnLike
                        @else
                        Like
                        @endif</button>
                    </form>
                    <a href="{{ route('posts.show',$post) }}">
                        <Button class="d-flex align-items-center gap-1"><ion-icon name="chatbubble-ellipses-outline"></ion-icon>Comments</Button>
                    </a>
                </div>
                @endauth
        </div>
            @endforeach
    </div>

</x-main-layout>
