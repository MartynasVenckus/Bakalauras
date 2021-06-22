<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Važtaraštis</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <style>
     body {
            font-family: "dejavu sans";
            font-size: 6px;
            }
            hr { margin: 1px 0 1px 0; }
            br{ line-height: 0.8px;}

            table.myclass{
            width: 100%;
            height:auto;
            }
            table.myclass td, table.myclass th {
            border: 1px solid #AAAAAA;
            }
    </style> 




<table class="myclass">
<tbody>
<tr>
    <td style="width: 550px;vertical-align: text-top;" colspan=6 >
        1 Siuntejas&nbsp;(pavadinimas, adresas, šalis) <br>
        Sender (name, address, country) &nbsp;<hr> <br> &nbsp;<hr> <br>&nbsp; <hr>&nbsp; <br>
    </td>
    <td colspan=6>

    TARPTAUTINIS KROVINIŲ TRANSPORTAVIMO VAŽTARAŠTIS <br>
    INTERNATIONAL CONSIGNMENT NOTE <br>
    Šis pervežimas vykdomas, neatsižvelgiant į kitus susitarimus, pagal Tarptautinių krovinių pervežimo sutarčių konvenciją (CMR) <br>
    This carriage is subject, notwithstanding any clause to the contrary, to the Convention on the Contract for the International Carriage of goods by road (CMR)
    </td>
</tr>
<tr>
    <td colspan=6 style="vertical-align: text-top;">

    2 Gavėjas (pavadinimas, adresas, šalis) <br>
    Consignee (name, address, country)  <hr> <br> {{$customer['name']}}<hr> <br>{{$customer['address']}} <hr>{{$customer['nationality']}} <br> <hr> <br>{{ $customer['VATCode']}}<hr> <br>&nbsp;
    </td>
    <td colspan=6>

    16 Vežėjas (pavadinimas, adresas, šalis) <br>
    Carrier (name, address, country) <hr> <br>
    UAB ,,KLEMITRA" <hr> <br>
    &nbsp;  <hr> <br>
    &nbsp;  <hr> <br>
    &nbsp;  <hr> <br>
    E-mail: &nbsp;  <br>
    </td>
</tr>
<tr>
    <td colspan=6>
        3 Krovinio iškrovimo vieta <br>
        Place of delivery of the goods <hr> <br>
        Vieta/Place &nbsp;&nbsp;&nbsp; {{$order['deliveryAddress']}}<hr>  <br>
        Šalis/Country <hr> <br>&nbsp;
    </td>
    <td colspan=6 style="vertical-align: text-top;">

    17 Kitas vežėjas (pavadinimas, adresas, šalis) <br>
  Following carrier (name, address, country) <hr> <br>  &nbsp; <hr> <br> &nbsp; <hr> <br>
    </td>
</tr>
<tr>
    <td colspan=4>

    4 Krovinio pakrovimo vieta ir data <br>
    Place and date of taking over the goods <hr> <br>
    Vieta/Place &nbsp;&nbsp;&nbsp; {{$order['loadingAddress']}} <hr> <br>
    Šalis/Country <hr><br>
    Data/Date
    </td>
    <td colspan=4 style="vertical-align: text-top;">
        5 Pridedami dokumentai <br> Annexed documents <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>
    </td>
    <td colspan=4 style="vertical-align: text-top;">

    18 Vežėjo salygos ir pastabos <br>
    Carrier's reservations and observations <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>
    </td>
</tr>
<tr>
    <td colspan=6>

    6 Ženklai ir numeriai &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 7 Vietų skaičius &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  8 Įpakavimo būdas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9 Krovinio pavadinimas*
   <br> Marks and numbers &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Number of packages &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Method of packing &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Nature of the goods*
              <hr> <br> &nbsp; <hr> <br>&nbsp;&nbsp;&nbsp;&nbsp; {{$truck['licensePlate']}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{$order['purpose']}} <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; 


    </td>
    <td colspan=2 style="vertical-align: text-top;">
    10 Statistinis N.  
    <br> Statist. number <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp;
    </td>
    <td colspan=2 style="vertical-align: text-top;">
    11 Svoris brutto, kg  
    <br> Gross weight in kg <hr> <br> &nbsp; <hr> <br> {{$order['weight']}} <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp;
    </td>
    <td colspan=2 style="vertical-align: text-top;"> 12 Tūris, m3 
    <br> Volume in m3 <hr> <br> &nbsp; <hr> <br> {{$order['length'] * $order['width'] * $order['height']}}   <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp;
    </td>
</tr>
<tr>
    <td colspan=4  style="vertical-align: text-top;">
    13 Siuntėjo nurodymai (muitinės ir kita informacija) <br>
    Sender's instructions (Customs and other formalities) <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>  &nbsp; <hr> <br>

    Pareikštoji krovinio vertė <br>
    Declared value of goods <hr> <br> &nbsp; <hr> <br>  &nbsp;

    </td>
    <td colspan=2 style="line-height: 8px; vertical-align: text-top;">
    19 Apmokėjimui <br> To be paid by: <hr> <br>
  Pervežimo kaina <br> Carriage charges <br> Nuolaidos <br>  Reductions&nbsp;&nbsp; - <hr> <br>
  Skirtumas <br> Balance <br> Priedas <br> Supplem. charges <br> Papildoma rinkliava <br> Other charges <br> Kiti <br> Miscellaneous&nbsp;&nbsp; + <hr> <br> Viso apmokėjimui <br> Total to be paid
    </td>
    <td colspan=2 style="vertical-align: text-top;">Siuntėjas <br> Sender
     <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp;
    </td>
    <td colspan=2 style="vertical-align: text-top;">Valiuta <br> Currency
    <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp;       
    </td>
    <td colspan=2 style="vertical-align: text-top;">Gavėjas <br> Consignee
    <hr> <br> &nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp; <hr> <br> &nbsp; <hr> <br>&nbsp; <hr> <br>&nbsp;      
    </td>
</tr>
<tr>
    <td colspan=12>14 Grąžinimas <br> Cash on delivery</td>
</tr>
<tr>
    <td colspan=6>15 Apmokėjimo sąlygos <br> Directions as to freight payment
     <hr> <br> &nbsp; <hr> <br> &nbsp;
    </td>
    <td colspan=6>20 Ypatingos suderintos sąlygos <br> Special agreements
    <hr> <br> &nbsp; <hr> <br> &nbsp;
    </td>

</tr>
<tr>
    <td colspan=12>21 Surašyta
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Data <br>
      Established
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Date
      </td>
</tr>
<tr>
    <td colspan=4  style="vertical-align: text-top;">
        22 <br> Atvykimas pakrovimui &nbsp;&nbsp;&nbsp; ______________ val. ______________ min. <br>
        Arrival for loading  &nbsp;&nbsp;&nbsp; ______________ h. ______________ min. <br>   
        Išvykimas  &nbsp;&nbsp;&nbsp; ______________ val. ______________ min. <br>  
        Departure &nbsp;&nbsp;&nbsp; ______________ h. ______________ min. <br> &nbsp; <br>&nbsp; <br> &nbsp; <br> &nbsp; <br> &nbsp; <br>

        
        Siuntėjo parašas ir spaudas <br>
        Signature and stamp of the sender
    </td>
    <td colspan=4  style="vertical-align: text-top;">
        23 <br> Kelionės lapas ____________________________________201______ <br>
        Vairuotojų _____{{$driver['name']}}___________________________________________ <br>
        Pavardės _______{{$order['surname']}}_________________________________________ <br> &nbsp; <br>&nbsp; <br> &nbsp; <br> &nbsp; <br> &nbsp; <br> &nbsp; <br>

        Vežėjo parašas ir spaudas <br>
        Signature and stamp of the carrier
    </td>
    <td colspan=4  style="vertical-align: text-top;">

        24 krovinys gautas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Data <br> 
        &nbsp; Goods recieved &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
         on _________________________________ 201______ <br>
        
        
        Atvykimas pakrovimui &nbsp;&nbsp;&nbsp; ______________ val. ______________ min. <br>
        Arrival for loading  &nbsp;&nbsp;&nbsp; ______________ h. ______________ min. <br>   
        Išvykimas  &nbsp;&nbsp;&nbsp; ______________ val. ______________ min. <br>  
        Departure &nbsp;&nbsp;&nbsp; ______________ h. ______________ min. <br> &nbsp;  <br>&nbsp; <br> &nbsp; <br>

        Gavėjo parašas ir spaudas <br>
        Signature and stamp of the consignee
    </td>
</tr>
<tr>
    <td colspan=3 style="vertical-align: text-top;">

    25 Registracinis numeris/ Registration No <br>
    Vilkikas/ Truck Puspriekabė/ Trailer <hr> <br> {{$truck['licensePlate']}} <hr> <br> {{$truck['trailerNumber']}}
    </td>
    <td colspan=3  style="vertical-align: text-top;">
    26 Markė/ Type <br>
    Vilkikas/ Truck Puspriekabė/ Trailer <hr> <br> {{$truck['brand']}} {{$truck['model']}} <hr> <br> &nbsp;
    </td>
    <td colspan=1 style="vertical-align: text-top;">
    27 Tarifas už 1km <hr> <br> &nbsp; <hr> <br> &nbsp;

    </td>
    <td colspan=1 style="vertical-align: text-top;">
    Tarifinis atstumas <hr> <br> &nbsp; <hr> <br> &nbsp;

    </td>
    <td colspan=1 style="vertical-align: text-top;">
    vilkiku/puspriekabe <br> %_už_naudojimasi <hr> <br> &nbsp; <hr> <br> &nbsp;

    </td>
    <td colspan=1 style="vertical-align: text-top;">
    Zonos <br> koef. <hr> <br> &nbsp; <hr> <br> &nbsp;

    </td>
    <td colspan=1 style="vertical-align: text-top;">
    Kiti <br> mokėjimai <hr> <br> &nbsp; <hr> <br> &nbsp;

    </td>
    <td colspan=1 style="vertical-align: text-top;">
    VISO <br> &nbsp; <hr> <br> &nbsp; <hr> <br> &nbsp;

    </td>
</tr>
<tr>
    <td colspan=1>28 <br> II <br> Tarifas</td>
    <td colspan=1 style="vertical-align: text-top; line-height:5px;">Tarifinis <br> atstumas, km <hr><br> &nbsp;</td>
    <td colspan=1 style="vertical-align: text-top; line-height:5px;">Schema <br>&nbsp; <hr><br> &nbsp;</td>
    <td colspan=1 style="vertical-align: text-top; line-height:5px;">Tarifinis <br> svoris, t <hr><br> &nbsp;</td>
    <td colspan=1 style="vertical-align: text-top;line-height:5px;">Tarifas <br> už 1t <hr><br> &nbsp;</td>
    <td colspan=1 style="vertical-align: text-top;line-height:5px;">Priedai <br>&nbsp;<hr><br> &nbsp;</td>
    <td colspan=1 style="vertical-align: text-top;line-height:5px;">Nuolaidos <br>&nbsp; <hr><br> &nbsp;</td>
    <td colspan=1 style="vertical-align: text-top;line-height:5px;">Kiti <br> mokėjimai <hr><br> &nbsp;</td>
    <td colspan=2 style="vertical-align: text-top;line-height:5px;">Apmokėjimui <br>&nbsp; <hr><br> &nbsp;</td>
    <td colspan=2 style="line-height:5px;">Atsiskaitymai <hr> <br> Apmokėta <br>užsakovui <hr> <br> Apmokėjimui </td>
</tr>
<tr>
    <td colspan=1>29 <br>Tarifas <br> II</td>
    <td colspan=1></td>
    <td colspan=1></td>
    <td colspan=1></td>
    <td colspan=1></td>
    <td colspan=1></td>
    <td colspan=1></td>
    <td colspan=1></td>
    <td colspan=2></td>
    <td colspan=2  style="vertical-align: text-top;">Valiuta  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Mokėtojo kodas <hr></td>
</tr>
</tbody>
</table>


</body>
</html>








