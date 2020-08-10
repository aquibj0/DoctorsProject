


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <img src="{{asset('image/logo2.jpg')}}" class="mt-4" alt="">

    Yo boy!
    {{$data}}
    {{$data->user}}
</body>
</html> --}}


<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Aloha!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- CSS only -->
<link rel="stylesheet" href="https://stasckpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Styles -->
{{-- <link href="{{ public_path('css/app.css') }}" rel="stylesheet"> --}}
{{--Custom Styles --}}
<style>
    *{
        font-family: Calibri, sans-serif !important;
        }
        .maroon{
            color: rgb(97, 13, 13);
        }

        .thead-dark{
            background-color: rgb(97, 13, 13) !important;
        }
        .white{
            color: #fff;
        }
        .mt-0{
            margin-top: 0;
        }
        .mb-0{
            margin-bottom: 0
        }
        .size-12{
            font-size: 12px;
          
        }
        .border{
            border: 2px solid #000;
        }
    }
</style>

</head>
<body>

    <div>



    </div>


  <table width="100%">
    <tr>
        <td valign="top">
           <img src="{{public_path('image/logo.jpg')}}" style="max-width:50px"  alt=""> <img src="{{public_path('image/logo2.jpg')}}" alt="" width="170"/>
            <p class="maroon mb-0 size-12" >Registered Address : 36 Elgin Road, Kolkata 700020</p>
            <p class="maroon mt-0 size-12">Email : birthclinic@gmail.com | Website : www.birtheclinic.com</p>

        
        </td>
        {{-- <td align="right">
            <h3>Shinra Electric power company</h3>
            <pre>
                Company representative name
                Company address
                Tax ID
                phone
                fax
            </pre>

            {{$data}}
            {{$data->user}}
        </td> --}}
    </tr>

  </table>

  <table width="100%">
    <tr class="border">
        <td>
            <strong class="mb-0">By - Dr. Gautam Khastgir</strong> 
            <p class="mb-0 ">Date :  {{date('d/m/Y ', strtotime($data->srRecievedDateTime))}}</p>
            <p class="mb-0 mt-0">Invoice No. : ONL2020-00001 </p>
        </td>
        <td>
                <strong class="mb-0">{{$data->patient->patFirstName}} {{$data->patient->patLastName}}</strong> 
                <p class="mb-0 ">M : {{$data->patient->patMobileNo}}</p>
                <p class="mb-0 mt-0">{{$data->patient->patGender}}, {{$data->patient->patAge}}</p>
                <p class="mb-0 mt-0">Address : {{$data->patient->patAddrLine1}},  @isset($data->patient->patAddrLine2){{$data->patient->patAddrLine2}},@endisset<br>
                    {{$data->patient->patCity}}, {{$data->patient->patDistrict}}, {{$data->patient->patState}}, {{$data->patient->patCountry}} </p>    
        </td>
    </tr>

  </table>

  <br/>

  <table width="100%" class="table table-bordered">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Procedure</th>
        <th>Unit Cost</th>
        <th>Quantity</th>
        <th>Discount</th>
        <th>Tax</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">01</th>
        <td>{{$data->service->srvcName}}</td>
        <td align="right">₹ {{$data->service->srvcPrice}}.00</td>
        <td align="right">1</td>
        <td align="right">₹ 0</td>
        <td align="right">₹ 0.0</td>
        <td align="right"> {!!'$'. $data->service->srvcPrice!!}.00</td>

      </tr>
    
    </tbody>
    
    <tfoot style="margin-top:25px">
 
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" ></td>
            <td align="right" style="background-color: lightgray;">Subtotal $</td>
            <td align="right">1635.00</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" ></td>
            <td align="right"style="background-color: lightgray;">Tax $</td>
            <td align="right">294.3</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" ></td>
            <td align="right"style="background-color: lightgray;" >Total $ </td>
            <td align="right" class="gray">$ 1929.3</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>