@extends('layouts.frontLayout.front_design')
@section('content')
 <div class="container">
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>        
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="box" id="contact">
    <div class="col-md-9">
        <form action="{{url('contact')}}" method="post">
            {{csrf_field()}}
            <div class="box">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" name="fname" class="form-control" id="firstname">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lname" class="form-control" id="lastname">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text"  name="subject"class="form-control" id="subject">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send message</button>

                </div>
            </div>
            <!-- /.row -->
        </form>
    </div>
</div>    
@endsection