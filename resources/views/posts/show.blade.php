<x-main-layout>

  <!-- Modal -->
  <div class="modal fade" id="likeModal" tabindex="-1" aria-labelledby="likeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="likeModalLabel">Liked By</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @foreach ($likers as $liker)
          <div class="d-flex align-items-center justify-content-between py-2">
              <a href="{{ route('userProfile',$liker->user) }}"><img style="width: 34px; height: 34px; border-radius: 50%" src="{{$liker->user->image ? '\storage/'.$liker->user->image->path : '/storage/profiles/person.jpg' }}" />
                {{ $liker->user->name }}</a>
                <p class="text-secondary">{{ $liker->created_at->diffForHumans() }}</p>
            </div>
            @endforeach
        </div>


      </div>
    </div>
  </div>

        <div class="card col-8 p-3 mx-auto">

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


            <div class="">
              <h4>{{ $post->title }}</h4>
              <p>{{ $post->description }}</p>
          </div>

                <img id="image" style="height: 400px;" src="{{'\storage/'.$post->image}}" class="card-img-top pointer" alt="{{$post->title}}">
                <div class="d-flex align-items-center justify-content-between px-2">
                  @if ($post->likes->count() > 0)
                  <a data-bs-toggle="modal" data-bs-target="#likeModal" class="text-danger pt-1 px-2">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</a>
                  @endif
                  @if ($post->comments->count() > 0)
                  <a href="#comments" class="pt-1 px-2 text-danger">{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</a>
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
                        
                        <a href="#comments">
                          <Button class="d-flex align-items-center gap-1"><ion-icon name="chatbubble-ellipses-outline"></ion-icon>Comments</Button>
                      </a>
                    </div>
                    @endauth

                {{-- Comment Box --}}
                <form class="mb-2" action="{{ route('comment.post',$post) }}" method="POST">
                  @csrf
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment :</label>
                        <textarea class="form-control" name="comment" id="" cols="20" rows="2" placeholder="Write something..."></textarea>
                        <x-error for="comment" />
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>

                {{-- Comment List --}}
                <div id="comments">
                  @if ($commenters->count() > 0)
                  @foreach ($commenters as $commenter)
                  <div class="bg-light p-1 m-2 py-2">
                        <div>
                          <a href="{{ route('userProfile',$commenter->user) }}"><img style="width: 34px; height: 34px; border-radius: 50%" src="{{$commenter->user->image ? '\storage/'.$commenter->user->image->path : '/storage/profiles/person.jpg' }}" />
                            {{ $commenter->user->name }}</a>  
                          </div>
                          <div class="px-2 d-flex align-items-center justify-content-between">
                            <h6>{{ $commenter->comment }}</h6>
                            <p class="text-secondary">{{ $commenter->created_at->diffForHumans() }}</p>
                          </div>
                      </div>
                    @endforeach
                      @else 
                      <div class="text-center text-secondary">Be the first one to comment.</div>
                  @endif
                    <div>{{ $commenters->links('pagination::bootstrap-5') }}</div>
                </div>


              </div>

</x-main-layout>
