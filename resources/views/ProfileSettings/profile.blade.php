@extends('layouts.master')


@section('title')
    Profile
@endsection

@section('headername')
    Profile
@endsection

@section('content')

						
 
            {{-- dashboard --}}
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item">
                            <a class="nav-link active"  href="/profile">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="/change_password">Password</a>
                        </li>
                    </ul>
                </div>	
                {{-- dashboard --}}
                <!-- Personal Details Tab -->
                <div class="tab-pane fade show active" id="per_details_tab">
                
                    <!-- Personal Details -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Personal Details</span> 
                                      @hasrole('admin')
                                        <a class="edit-link"  href="/users_edit/{{ $profile[0]->id }}"><i class="fa fa-edit mr-1"></i>Edit</a>
                                      @endhasrole
                                    </h5>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                        <p class="col-sm-10">{{ $profile[0]->first_name }}{{ " " }}{{ $profile[0]->last_name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                        <p class="col-sm-10">
                                            {{ $profile[0]->email }}
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                        <p class="col-sm-10">{{ $profile[0]->phone_num }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                        <p class="col-sm-10 mb-0">{{ $profile[0]->address }}<br>
                                            {{ $profile[0]->city_name }} - {{ $profile[0]->postal_code }},<br>
                                        {{ $profile[0]->province }}.</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    
                    </div>
                    <!-- /Personal Details -->

                </div>
                <!-- /Personal Details Tab -->
                
           



@endsection

@section('scripts')
          
@endsection