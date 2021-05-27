@extends('layouts.app')

@section('content')

<div id="page-contents">

        <div class="container">
            <div class="row">

          <!-- Newsfeed Common Side Bar Left
          ================================================= -->
                <div class="col-md-3 static">
            <div class="profile-card">
                <img src="{{ asset('images/avatar/' . Auth::user()->avatar) }}" alt="user" class="profile-photo" />
                <h5><a href="timeline.html" class="text-white">{{ Auth::user()->name}}</a></h5>
            
            </div><!--profile card ends-->
      
          
          </div>
          
                <div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
            <div class="create-post">
                <div class="row">
                  <form  method="POST" action="{{ route('posts.post.store') }}" accept-charset="UTF-8" id="create_post_form" name="create_post_form" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="col-md-7 col-sm-7">
                  <div class="form-group">
                    <img src="{{ asset('images/avatar/' . Auth::user()->avatar) }}" alt="" class="profile-photo-md" />
                    <textarea id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish" name="Text" ></textarea>
                  </div>
                </div>
                    <div class="col-md-5 col-sm-5">
                  <div class="tools">
                    <ul class="publishing-tools list-inline">
                     <li><label for="upload-photo"><i class="ion-images"></i></label>
                    <input  onchange="readURL(this)" type="file" name="file" id="upload-photo" />
                  </li>

                     
                    </ul>
                    <button  class="btn btn-primary pull-right">Publish</button>
                  </div>

                </div>
                </form>

                </div>
                <img  id="blah" src=""  class="hidden"  style="padding: 20px;width: 150px; height: 150px;" >
            </div><!-- Post Create Box End-->



            @foreach($posts as $post)
            <!-- Post Content
            ================================================= -->
            <div class="post-content">
              @if($post->file)
              <img src="{{ asset('images/' . $post->file) }}" alt="post-image" class="img-responsive post-image" />
              @endif
              <div class="post-container">
                <img src="{{ asset('images/avatar/' . optional($post->user)->avatar) }}" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">{{ $post->user->name }}</a> </h5>
                    <p class="text-muted">Published a {{ $post->created_at }}</p>
                  </div>
                  <div class="reaction">
                    @if(Auth::user()->id == $post->user_id )
                      <form method="POST" action="{!! route('posts.post.destroy', $post->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                 
                       <button type="submit" class="btn btn-danger" style="background: transparent; border: transparent;color: red;" title="{{ trans('posts.delete') }}" onclick="return confirm(&quot;{{ trans('posts.confirm_delete') }}&quot;)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                          
                                </form>
                    @endif
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{ $post->Text }} </p>
                  </div>
                  <div class="line-divider"></div>
                  @foreach($post->commenter()->get() as $commenter)
                  <div class="post-comment">
                    <img src="{{ asset('images/avatar/' . optional($commenter->user)->avatar) }}" alt="" class="profile-photo-sm" />

                    <p><a href="#" class="profile-link">{{ $commenter->user->name }} </a>
                      <br>Published a {{ $commenter->created_at }}
                      <br> {{ $commenter->text }} </p>
                    @if(Auth::user()->id == $commenter->user_id )
                   <form method="POST" action="{!! route('commenters.commenter.destroy', $commenter->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}


                                      <button type="submit" class="btn btn-danger" style="background: transparent; border: transparent;color: red;" title="{{ trans('posts.delete') }}" onclick="return confirm(&quot;{{ trans('posts.confirm_delete') }}&quot;)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                            

                                </form>
                                
                     @endif
                  </div>

                 @endforeach
                  <div class="post-comment">

                    <img src="{{ asset('images/avatar/' . Auth::user()->avatar) }}" alt="" class="profile-photo-sm" />
                     <form method="POST" action="{{ route('commenters.commenter.store') }}" accept-charset="UTF-8" style="width: 600px;">
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{$post->id}}">
                    <input type="text" class="form-control" name="text" placeholder="Post a comment">
                  </form>
                  </div>
                </div>
              </div>
            </div>

            @endforeach

            

          </div>

         
            </div>
        </div>
    </div>

    
@endsection
