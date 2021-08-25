<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

<style>
     .body-main {
     background: #ffffff;
     border-bottom: 15px solid #1E1F23;
     border-top: 15px solid #1E1F23;
     margin-top: 30px;
     margin-bottom: 30px;
     padding: 40px 30px !important;
     position: relative;
     box-shadow: 0 1px 21px #808080;
     font-size: 10px
 }

 .main thead {
     background: #1E1F23;
     color: #fff
 }

 .img {
     height: 100px
 }

 h1 {
     text-align: center
 }
 
    body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
</style>


<page size="A4" size="portrait">
 
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Order Summary</h2>
        </div>
    </div> <br />

                <div class="container-fluid" style="margin-left: 100px; margin-right: 100px">
                    <br>
                    <br>
                    <br>
                   
                        {{-- <div class="col-md-4"> <img class="img" alt="Invoce Template" src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png" /> </div> --}}
                        <div class="col-md-8">
                            <h4 style="color: #5a8bf7;"><strong>Generate By</strong></h4>
                            @if ($items[0]->created_by == '' || $items[0]->created_by == NULL)
                                <p>{{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}</p>
                                <p> {{ Auth::user()->phone_num }}</p>
                                <p>{{ Auth::user()->address }}</p>
                                <p>{{ Auth::user()->city_name }}{{ ", " }}{{ Auth::user()->postal_code }}</p>
                            @else
                               @php
                               
                                   $data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
                              
                             echo   "<p>".$data[0]->first_name . " " . $data[0]->last_name."</p>";
                              echo "<p>" .$data[0]->phone_num."</p>";
                               echo "<p>".$data[0]->address ."</p>";
                               echo "<p>". $data[0]->city_name.", " . $data[0]->postal_code."</p>";
                                @endphp
                            @endif
                        </div>
                    </div> <br /><br>
                    <br>
                   
                    <div class="container-fluid" style="margin-left: 100px; margin-right: 100px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Item Name
                                    </th>
                                    <th>
                                        Code
                                    </th>
                                    <th>Number</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    
                               
                                <tr>
                                    <td class="col-md-3 col-lg-3 col-3">{{ $item->item_name }}</td>
                                    <td class="col-md-3 col-lg-3 col-3">{{ $item->item_code }}</td>
                                    <td class="col-md-6 col-lg-6 col-6">{{ $item->item_numbers }}</td>
                                    <td class="col-md-6 col-lg-6 col-6">{{ $item->item_note }}</td>
                                    <td class="col-md-6 col-lg-6 col-6">${{ $item->price }}</td>
                                </tr>
                                @endforeach
                                
                               
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <div class="col-md-12" style="margin-left: 100px; margin-right: 100px">
                            <p><b>Date :</b> 6 June 2019</p> <br />
                            <p><b>Signature</b></p><img src="{{ url('/'.$item->vendor_signature) }}" alt="" height="100px" width="200px">
                        </div>
                    </div>
                </div>
       
</page>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>