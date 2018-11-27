@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="text-center">Profile</h4>
                <div class="form-control"><i>Name : </i> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{auth()->user()->name}}</div>
                <div class="form-control"><i>Email : </i> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp {{auth()->user()->email}}</div>
                <div class="form-control"><i>Gender : </i> &nbsp &nbsp &nbsp &nbsp <span id="gender">{{auth()->user()->gender}}</span></div>
                <div class="form-control"><i>National Id : </i> &nbsp {{auth()->user()->national_id}}</div>
            </div>
            <div class="col-md-8 posts">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-dark">
                            <div class="card-header">Share Your Post</div>

                            <div class="card-body">
                                <form action="{{url('post')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="title">Post Title</label>
                                        <input type="text" name="p_title" class="form-control{{ $errors->has('p_title') ? ' is-invalid' : '' }}">
                                        <input type="hidden" id="userid" value="{{auth()->user()->id}}" name="user_id">
                                        @if ($errors->has('p_title'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('p_title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Post content</label>
                                        <textarea name="p_content" rows="1" class="form-control{{ $errors->has('p_content') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('p_content'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('p_content') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">post</button>
                                </form>
                            </div>
                        </div>
                        <post></post>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection