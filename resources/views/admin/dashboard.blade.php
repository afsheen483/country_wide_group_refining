@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('headername')
    Dashboard
@endsection

@section('sidebar')
    Dashboard
@endsection

@section('content')
        

<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <a href="/ajaxdata">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary border-primary">
                            <i class="fe fe-users"></i>
                        </span>
                        <div class="dash-count">
                            <h3> {{ \App\Models\User::role('vendor')->get()->count() }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Users</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary w-50"></div>
                        </div>
                    </div>
                </div>
             </a>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
           <a href="/itemdata">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-success">
                        <i class="fe fe-credit-card"></i>
                    </span>
                    <div class="dash-count">
                        <h3>{{ \App\Models\ItemModel::where('is_deleted','=','0')->get()->count() }}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    
                    <h6 class="text-muted">Items</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success w-50"></div>
                    </div>
                </div>
            </div>
           </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-danger border-danger">
                        <i class="fe fe-money"></i>
                    </span>
                    <div class="dash-count">
                        <h3>{{ \DB::table('metals')->get()->count() }}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    
                    <h6 class="text-muted">Metals</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger w-50"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
           <a href="/viewhistory">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-warning border-warning">
                        <i class="fe fe-folder"></i>
                    </span>
                    <div class="dash-count">
                        <h3>{{ \DB::table('view_history')->get()->count() }}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    
                    <h6 class="text-muted">View History</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning w-50"></div>
                    </div>
                </div>
            </div>
           </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
           <a href="/invoice">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon text-warning border-warning">
                        <i class="fe fe-folder"></i>
                    </span>
                    <div class="dash-count">
                        <h3>{{ \DB::table('invoice_head')->where('is_deleted','=','0')->get()->count() }}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    
                    <h6 class="text-muted">Total Invoice</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning w-50"></div>
                    </div>
                </div>
            </div>
           </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
@endsection