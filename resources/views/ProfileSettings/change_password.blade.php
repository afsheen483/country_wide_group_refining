@extends('layouts.master')


@section('title')
    Change Password
@endsection

@section('headername')
    Change Password
@endsection

@section('content')
                   
					{{-- dashboard --}}
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link"  href="/profile">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="/change_password">Password</a>
                            </li>
                        </ul>
                    </div>	
                    {{-- dashboard --}}
                
                <!-- Change Password Tab -->
                
             
                
                    <div class="card">
                    <br>
                       <div class="col-4" style="margin-left: 5%">
                        @if (Session::has('message') == 'password updated successfully')
                             <p class="alert alert-success">{{ Session::get('message') }}</p>
                        @elseif (Session::has('message') == 'new password can not be the old password!' || Session::has('message') == 'old password doesnt matched')
                            <p class="alert alert-danger">{{ Session::get('message') }}</p>
                        @endif
                       </div>
                        <div class="card-body">
                            <h5 class="card-title">Change Password</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-4" style="margin-left:18%;">
                                    <form action="{{ url('change_password') }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" required name="old_password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" required name="new_password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" required name="confirm_password">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
              
                <!-- /Change Password Tab -->
                
           



@endsection

@section('scripts')
          {{-- <script>
               $(document).ready(function () {
        var url = window.location;
    // Will only work if string in href matches with location
        $('.nav-link a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
        $('.nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');

        });
          </script> --}}
@endsection