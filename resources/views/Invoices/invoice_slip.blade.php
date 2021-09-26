<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



   
</head>
<style>
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
</style>
<body>
    
<br>

    <page size="A4">
                    <div class="col-md-9" style="float: left">
                            <br>
                            @if ($items[0]->created_by == '' || $items[0]->created_by == NULL)
                                <h3 style="font-size: 30px">{{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}</h3>
                                <h4> {{ Auth::user()->phone_num }}</h4>
                                <h4>{{ Auth::user()->address }}</h4>
                                <h4>{{ Auth::user()->city_name }}{{ ", " }}{{ Auth::user()->postal_code }}</h4>
                            @else
                            @php
                            
                                $data = \App\Models\User::where('id','=',$items[0]->created_by)->get();
                            
                            echo   "<h3  style='font-size: 30px'>".$data[0]->first_name . " " . $data[0]->last_name."</h3>";
                            echo "<h4>" .$data[0]->phone_num."</h4>";
                            echo "<h4>".$data[0]->address ."</h4>";
                            echo "<h4>". $data[0]->city_name.", " . $data[0]->postal_code."</h4>";
                                @endphp
                            @endif
                            
                            <h3 style="color:#094479"><strong>Bill To</strong></h3>
                            <h4>Country Wide Group Refining</h4>
                           
                            <h3  style="color:#094479"><strong>Invoice Date</strong></h3>
                            <h4>{{ is_null($items[0]->invoice_date) ? date("F j, Y"): $items[0]->invoice_date  }}</h4>
                        </div>
                          <br>
                      <div class="col-md-2" style="float:right;">
                          <h2><strong>Invoice</strong></h2>
                          <h4># {{ rand(1,9999) }}</h4>
                              <br>
                         
                     
                      </div>
            <div class="container" style="margin-left: -2%;margin-right:-10px;">
                <div class="col-md-9 col-lg-8 col-xs-9" style="width: 21cm;">
                         
                                <table border="1" class="table" >
                                    <thead style="background-color:#094479;color:white;">
                                        <tr>
                                            <td  ><strong>Description</strong></td>
                                            <td ><strong>Unit Price($)</strong></td>
                                            <td ><strong>Amount($)</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        @foreach ($items as $item)
                                        <tr>
                                            <td >{{ $item->item_code }} {{ "_" }} {{ $item->item_name }} {{ "(" }}{{ $item->item_numbers }}{{ ")" }}</td>
                                            <td  class="p">{{ $item->price }}</td>
                                            <td class="tp" >{{ $item->price }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                          <td ></td>
                                          <td class="" ><strong>Total</strong></td>
                                          <td class="price" style="font-size: 15px;font-weight:bold"></td>
                                      </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
            <br>
            <div class="col-md-12" style="margin-left: 10px;">
                            
                <p><b>Signature</b></p><img src="{{ url('/'.$item->vendor_signature) }}" alt="" height="100px" width="200px">
            </div>

            <div class="col-6" style="text-align: center">
                
                <p style="font-weight: bold;font-size:14px">Thank you for your business!</p>
        </div>
</page>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  

$(document).ready(function(){
            var sum = 0;
            $(".p").each(function(){
                var val = $(this).text();
                console.log(val);
                sum += Number(val);
            });
            console.log(sum);
            $(".price").text("$"+sum.toFixed(2));

            var sum2 = 0;
            $(".tp").each(function(){
                var val2 = $(this).text();
                console.log(val2);
                sum2+= Number(val2);
            });
            console.log(sum2);
            $(".total_price").text("$"+sum2.toFixed(2));
        });
</script>

    
</html>