<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sąskaita</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <style>
        body {
            font-family: "dejavu sans";
            font-size: 12px;
        }
        table {
          width: 100%;
        }
    </style>
    
<div>PVM SĄSKAITA FAKTŪRA</div>
<div>Serija KL Nr.</div>
<br>
<table>
    <tr>
      <td style="padding-right: 9rem;">UAB „KLEMITRA“</td>
      <td>{{$customer['name']}}</td>
    </tr>
    <tr>
      <td>Kodas: &nbsp; </td>
      <td>Įmonės kodas: {{$customer['companyCode']}}</td>
    </tr>
    <tr>
      <td>PVM kodas: &nbsp; </td>
      <td>PVM kodas: {{$customer['VATCode']}}</td>
    </tr>
    <tr>
      <td>&nbsp; </td>
      <td>{{$customer['address']}}</td>
    </tr>
    <tr>
      <td>A/S &nbsp; </td>
      <td>{{$customer['checkingAccount']}}</td>
    </tr>
    <tr>
      <td>AB "SEB bankas"</td>
      <td>AB {{$customer['bank']}}</td>
    </tr>
</table>
<br>
<div style="text-align: center; margin-bottom:5rem;">{{ date("Y-m-d", strtotime($order['creationDate'] )) }}</div>
<table>
    <tr>
      <td></td>
      <td>Pasl. kaina</td>
      <td>PVM</td>
      <td>Viso</td>
    </tr>
    <tr>
      <td></td>
      <td>Eurai</td>
      <td>21%</td>
      <td>Eurai</td>
    </tr>
    <tr>
      <td>Už transporto paslaugas <br> {{$truck['licensePlate']}} <br> Maršrutu <br> {{ date("Y-m-d", strtotime($order['creationDate'] )) }}</td>
      <td>{{ $order['price'] }}</td>
      <td>{{ round($order['price'] * 21 / 100, 2) }}</td>
      <td>{{ round($order['price'] * 21 / 100, 2) + $order['price'] }}</td>
    </tr>
</table>
<br>
<div>Užsakymo Nr. {{$order['id']}}</div>
<br>
<br>
<div>
    Viso: {{ round($order['price'] * 21 / 100, 2) + $order['price'] }} EUR
</div>

<table style="margin-top:6rem; margin-left:9rem;">
    <tr style="text-align: center;">
      <td>Buhalterė</td>
      <td style="padding-right: 3rem;">&nbsp; </td>
    </tr>
</table>





    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>