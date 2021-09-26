@extends('layouts.master')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css1/mdb-pro.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css1/mdb.ecommerce.min.css') }}">
@section('title')
    item Detail
@endsection
@section('headername')
<a href="{{ url()->previous() }}" class="btn btn-info" style="float: right">Back</a>
    Product Detail
@endsection

@section('content')
<div class="card">
  <body class="skin-light">

    <!--Main Navigation-->
  
    <!--Main Navigation-->
  
    <!--Main layout-->
    <main>
      <div class="container">
  
        <!--Section: Block Content-->
        <section class="mb-1">
  
          <div class="row">
            <div class="col-md-6 mb-0 mb-md-0">
  
              <div id="mdb-lightbox-ui"></div>
  
              <div class="mdb-lightbox">
  
                <div class="row product-gallery mx-1">
  
                  <div class="col-12 mb-0">
                    <figure class="view overlay rounded z-depth-1 main-img" style="max-height: 450px;">
                      <a href="{{ asset($item->item_image) }}"
                        data-size="710x823">
                        <img src="{{ asset($item->item_image) }}"
                          class="img-fluid z-depth-1" style="margin-top: -90px;">
                      </a>
                    </figure>
                    <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                      <a href="{{ asset($item->item_image) }}"
                        data-size="710x823">
                        <img src="{{ asset($item->item_image) }}"
                          class="img-fluid z-depth-1">
                      </a>
                    </figure>
                    <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                      <a href="{{ asset($item->item_image) }}"
                        data-size="710x823">
                        <img src="{{ asset($item->item_image) }}"
                          class="img-fluid z-depth-1">
                      </a>
                    </figure>
                    <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                      <a href="{{ asset($item->item_image) }}"
                        data-size="710x823">
                        <img src="{{ asset($item->item_image) }}"
                          class="img-fluid z-depth-1">
                      </a>
                    </figure>
                  </div>
                  {{-- <div class="col-12">
                    <div class="row">
                      <div class="col-3">
                        <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                          <img src="{{ asset($item->item_image) }}"
                            class="img-fluid">
                          <div class="mask rgba-white-slight"></div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                          <img src="{{ asset($item->item_image) }}"
                            class="img-fluid">
                          <div class="mask rgba-white-slight"></div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                          <img src="{{ asset($item->item_image) }}"
                            class="img-fluid">
                          <div class="mask rgba-white-slight"></div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                          <img src="{{ asset($item->item_image) }}"
                            class="img-fluid">
                          <div class="mask rgba-white-slight"></div>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                </div>
  
              </div>
  
            </div>
            <div class="col-md-6">
  
              <h1 style="font-size: 60px" class="text-uppercase ">{{ $item->item_name }}</h1>
              @hasrole('admin')
              <p style="font-size: 40px;color:#1b5a90"><span class="mr-1"><strong>${{ number_format((float)$item->price, 2, '.', '') }}</strong></span></p>
              @endhasrole
              <p class="pt-1" style="font-size: 20px">{{ $item->item_note }}</p>
              <div class="table-responsive">
                <table class="table table-sm table-borderless mb-0">
                  <tbody>
                    <tr>
                      <th class="pl-0 w-25" scope="row" style="font-size: 15px"><strong>Code</strong></th>
                      <td style="font-size: 15px">{{ $item->item_code }}</td>
                    </tr>
                    <tr>
                      <th class="pl-0 w-25" scope="row" style="font-size: 15px"><strong>Number</strong></th>
                      <td style="font-size: 15px">{{ $item->item_numbers }}</td>
                    </tr>
                    <tr>
                      <th class="pl-0 w-25" scope="row" style="font-size: 15px"><strong>Model</strong></th>
                      <td style="font-size: 15px">{{ $item->item_model }}</td>
                    </tr>
                    <tr>
                      <th class="pl-0 w-25" scope="row" style="font-size: 15px"><strong>Make</strong></th>
                      <td style="font-size: 15px">{{ $item->item_make }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <hr>
              <div class="table-responsive mb-2">
                <table class="table table-sm table-borderless">
                  <tbody>
                    <tr>
                    
                      <td>
                        <div class="mt-1" style="font-size: 20px">
                          <div class="form-check form-check-inline pl-0">
                              <b>Platinum</b> &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="form-check-label small text-uppercase card-link-secondary"
                              for="small">{{ $item->platinum_percentage }}%</label>&nbsp;&nbsp;&nbsp;&nbsp;
                              <b>Pladium</b> &nbsp;&nbsp;&nbsp;&nbsp;
                              <label class="form-check-label small text-uppercase card-link-secondary"
                                for="medium">{{ $item->pladium_percentage }}%</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Rhodium</b> &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="form-check-label small text-uppercase card-link-secondary"
                              for="large">{{ $item->rhodium_percentage }}%</label>
                          </div>
                          <br>
                          <div class="form-check form-check-inline pl-0">
      
                             
                          </div>
                          <br>
                          <div class="form-check form-check-inline pl-0">
                              
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
  
        </section>
        <!--Section: Block Content-->
  
        <!-- Classic tabs -->
        <div class="classic-tabs">
  
          <ul class="nav tabs-primary nav-justified" id="advancedTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active show" id="description-tab" data-toggle="tab" href="#description" role="tab"
                aria-controls="description" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="info-tab" data-toggle="tab"  role="tab" aria-controls="info"
                aria-selected="false"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="reviews-tab" data-toggle="tab"  role="tab" aria-controls="reviews"
                aria-selected="false"></a>
            </li>
          </ul>
          <div class="tab-content" id="advancedTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <h5>Product Description</h5>
              <p class="small text-muted text-uppercase mb-2" style="font-size: 25px">{{ $item->item_name }}</p>

              <h6 style="font-size: 30px">${{ number_format((float)$item->price, 2, '.', '') }}</h6>
              <p class="pt-1" style="font-size: 20px">{{ $item->item_note }}</p>
            </div>
            
              </div>
              <div>
                
              </div>
            </div>
          </div>
  
        </div>
        <!-- Classic tabs -->
  
      </div>
    </main>

      </body>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js1/jquery-3.4.1.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js1/popper.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js1/bootstrap.js')  }}"></script>
<script type="text/javascript" src="{{ asset('js1/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js1/mdb.ecommerce.min.js') }}"></script>
@endsection