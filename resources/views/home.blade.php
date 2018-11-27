@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Please Upgrade Your Gender</div>

                    <div class="card-body">
                        @if (auth()->user()->gender == null)
                            <div class="alert alert-danger" role="alert">
                                please update your Gender
                            </div>


                            <form action="{{url("profile",auth()->user()->id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <select name="gender" class="form-control">
                                        <option>Select Your Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">Save</button>

                            </form>
                        @else
                            <h4><a href="/post">go to your <i class="green">Timline</i></a></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
