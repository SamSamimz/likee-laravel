<x-main-layout>
    <div class="card col-8 mx-auto">
            <img id="profilePic" style="cursor: pointer; height: 300px;width:400px;border-radius:50%" src="{{ '\storage/'.$user->image->path}}" class="card-img-top pointer mx-auto" alt="">
            <div class="card-body">
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->email }}</p>
                <h5>Total: {{ $total }} {{ Str::plural('like', $total) }}</h5>
                
            </div>
          </div>


          
    <div class="col-9 mx-auto">
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
                                    <li><a class="dropdown-item" href="#">Edit</a></li>
                                @endif
                                <li><a class="dropdown-item" href="#">Save</a></li>
                            @endauth
                          <li><a class="dropdown-item" href="{{route('download',$post)}}">Download Image</a></li>
                          @can('delete', $post)
                          <li><form action="{{route('posts.destroy',$post)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">Delete Post</button>
                            </form></li>
                            @endcan
                        </ul>
                      </div>
    
                </div>
                <div>{{ $post->title }}</div>
                <a href="{{ route('posts.show',$post) }}">
                    <img style="cursor: pointer" class="img-fluid" src="{{ '\storage/'.$post->image }}" alt="">
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

