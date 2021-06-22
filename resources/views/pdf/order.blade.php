<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Užsakymo informacija</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <style>
            body {
                font-family: "dejavu sans";
                font-size: 8px;
            }
            table {
              width: 100%;
            }
    </style>

    

<div class=" text-primary mb-3" style="font-size: 24px; text-align: center;">{{$customer['name']}}</div>
<div>UŽSAKYMO SUTARTIS NR. {{$order['id']}} Data: {{ date("Y-m-d", strtotime($order['creationDate'] )) }}}</div>
<div class="mb-3">Tarp užsakovo - {{$customer['name']}} ir vežėjo - KLEMITRA UAB</div>

<table style="border: 1px solid black">
  <thead>
    <tr>
      <td style="text-align: center; border: 1px solid black; ">Pakrovimas</td>
      <td style="text-align: center; border: 1px solid black;">Iškrovimas</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="border: 1px solid black;">
        Krovinys: {{$order['purpose']}} <br>
        Data: <br>
        Vieta: {{ $order['loadingAddress']}}
      </td>
      <td class="align-middle" style="border: 1px solid black;">
        Data: {{ $order['deliveryDate']}} <br>
        Vieta: {{ $order['deliveryAddress']}}
      </td>
    </tr>
    <tr style="border: 1px solid black;">
      <td>Bendras Krovinys: LDM,</td>
      <td style="text-align: right;">Pilna mašina</td>
    </tr>
  </tbody>
</table>
<br>
<div>Kitos sąlygos: <br> {{$order['additionalInformation']}}</div> <br>

<table style="border: 1px solid black">
    <tr>
      <td style="border: 1px solid black; vertical-align: text-top;">A/m tipas:</td>
      <td style="border: 1px solid black; vertical-align: text-top;">A/m numeriai: {{$truck['trailerNumber']}}</td>
      <td style="border: 1px solid black; vertical-align: text-top;">A/m marke:</td>
    </tr>
</table>
<br>
<div>
Apmokėjimas: {{ $order['price']}} EUR + 21% PVM per 30 k.d. nuo sąskaitos ir CMR važtaraščio gavimo dienos. Nesumokėjus laiku už krovinio
pervežimą, Užsakovas įsipareigoja sumokėti Vežėjui 0,2 % dydžio delspinigius nuo pervežimo sumos už kiekvieną uždelstą dieną.
</div>
<br>
<div style="font-size: 7px; border: 1px solid black; padding:0.1rem;">
BENDROS SĄLYGOS: - Krovinio vežimas atliekamas pagal CMR konvencijos, Lietuvos ir kitų valstybių, per kurias vežamas krovinys, norminių aktų nuostatas.
Prastova turi būti pažymėta CMR važtaraštyje ir patvirtinta atsakingų asmenų parašais ir antspaudais. <br>
- Užsakovo ir vežejo abipusiu susitarimu gali būti koreguojamas pervežimo maršrutas ir krovinio kiekis.<br>
-Alm pakrovimui / iškrovimui skirtos 24 val. (NVS šalyse - 48 val.). jei tai nėra savaitgalis, šventės dienos ar nėra nurodyta kitaip.<br>
- Ginčai, susiję su šia Sutartimi-užsakymu, sprendžiami derybų keliu, o šalims nesusitarus - Lietuvos Respublikos teismuose, Lietuvos įstatymų numatyta tvarka, Sutarčiai taikant CMR konvenciją bei
Lietuvos Respublikos teisę. Teismo vieta - priklausomai nuo ginčo sumos, Lietuvos Respublikos Vilniaus miesto apylinkės teismas arba Vilniaus apygardos teismas.<br>
- Sutartis-užsakymas galioja nuo jos pasirašymo momento iki tol, kol abi šalys faktiškai įvykdys šia sutartimi - užsakymu prisiimtus įsipareigojimus.
Užsakovas neatsako už veterinarinio daktaro ir muitinės tarnybos sukeltas prastovas.<br>
- Vienašališki šios sutarties pakeitimai ar pataisymai neturi juridinės galios.<br>
VEŽEJO PAREIGOS:<br>
- Atvykti i pasikrovima / išsikrovimą sutartyje nurodytu laiku ir techniškai tvarkinga, švaria, be pašalinių kvapų alm.<br>
- Laiku neatvykus i pakrovimo / iškrovimo vietą už kiekvieną uždelstą dieną vežėjas turi sumokėti 100 EUR baudą. Daliniams kroviniams - 60 EUR baudą.<br>
- Turi turėti visus vežimui reikalingus dokumentus (Ly. galiojantį vežėjo civilinės atsakomybės ir CMR draudimą, CMR važtaraštį, licenciją, leidimus, ir kt.).<br>
- Vežėjas atsakingas už dokumentų, minimų CMR važtaraštyje ar jam įteiktų, pametimą ar neteisingą jų panaudojimą.<br>
- Turi garantuoti pilna neutralumą Užsakovo klientų atžvilgiu ir visiškai už tai atsakyti, priešingu atveju bus taikomos finansinės sankcijos.<br>
- Visas prievoles, kylančias iš šios sutarties, Vežėjas privalo vykdyti asmeniškai. Vežėjas, perleidęs bet kokios iš šios sutarties kylančios prievolės vykdymą trečiajam asmeniui be Užsakovo leidimo sutinka,
jog šio sutarties punkto pažeidimas bus įvardijamas, kaip tyčia sąmoningai atlikti veiksmai. Jei dėl vežėjo pasitelktų trečiųjų asmenų bus sugadinta arba prarasta dalis ar visas krovinys, Vežėjas įsipareigoja
atlyginti visus nuostolius, netaikant svorio limito apribojimo apibrėžto CMR konvencijos 23 str 3 p.<br>
- Apie visas iškilusias problemas informuoti Užsakovą nedelsiant, nesant galimybei - dviejų valandų laikotarpyje. Pranešus vėliau ir nesant tam objektyvių priežasčių, visa su tuo susijusi atsakomybė tenka
vežejui.<br>
- Vairuotojui draudžiama palikti vilkiką su kroviniu be priežiūros. Priešingu atveju vežėjo veiksmai bus vertinami, kaip tyčinis neatsargumas ir jam grės neribota atsakomybė už prarastą krovini.<br>
- Vairuotojas turi stebėti pakrovimą/iškrovimą ir užtikrinti, kad krovinys atitiktų įrašus CMR važtaraščiuose ir krovinio pervežimo sutartyje.<br>
- Vairuotojas privalo patikrinti krovinį prieš Il priimant. Vairuotojas yra atsakingas už krovinio pakrovimą ir tvirtinimą bel viršsvorį ant ašles. Jel krovinys arba jo pakuotė buvo pažeisti prieš krovinlul pereinant
vežėjo atsakomybėn, arba vežėjui buvo draudžiama dalyvauti krovimo procese, ir jo atstovas - vairuotojas, apie tai neįrašė CMR važtaraštyje, bei siuntėjas nepasirašė prie minėtų įrašų, už iškrovimo vietoje
mastebėtus pažeidimus visa atsakomybė tenka Vežėjui.
- Vežėjas priimdamas vežti krovinį patvirtina, kad sutinka su pervežimo užsakymo sąlygomis. Priėmimu laikomas raštiškas pranešimas: gauto užsakymo pasirašymas, vežėjo antspaudo uždėjimas ir tokio
užsakymo išsiuntimas elektroniniu paštu arba konkliudentiniai veiksmai, kai vežėjas užsakyme nurodytu laiku priima krovinį ir pradeda jį vežti.<br>
-Vežėjas neturi teisės sulaikyti kaip užstato užsakovo krovinio.
</div>

<div style="margin-top: 4rem; margin-left: 5rem;">
    {{$customer['name']}}<br> <br> Signature........................
</div>

<div style="margin-left: 23rem;">
    Vežėjas KLEMITRA UAB<br> <br> Parašas........................
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<div class="font-weight-bold" style="font-size: 10px">„{{$customer['name']}}“</div>
<div class="font-weight-bold">Įmonės kodas: {{$customer['companyCode']}}, PVM kodas: {{$customer['VATCode']}}</div>
<div >Bankas: {{$customer['bank']}}, banko kodas: 73000, A/s {{$customer['checkingAccount']}}</div>
<div class="font-weight-bold">Rezidencijos adresas: {{$customer['address']}}</div>
<div class="mb-3">Telefono numeris: {{$customer['phone']}}, El. Paštas: {{$customer['email']}}</div>
<div class="font-weight-bold" style="font-size: 10px; text-align: center;">Užsakymas - sutartis krovinio pervežimui Nr.: {{$order['id']}}</div>
<table style="border: 1px solid black">
    <tr class="font-weight-bold" style="font-size: 10px; text-align: center;">
      <td style="border: 1px solid black;">{{$customer['name']}}</td>
      <td style="border: 1px solid black;">UAB „Klemitra“</td>
    </tr>
</table>
<br>
<div><b>{{$customer['name']}}</b>, toliau vadinama "UŽSAKOVU“ atstovaujama __________________________________________ ir <b>UAB „KLEMITRA“</b>,
toliau vadinama “VEŽĖJU“ atstovaujama  __________________________________________, sudarė krovinio
pervežimo sutartį, kuri įsigalioja nuo jos pasirašymo momento ir galioja kol šalys įvykdys šia sutartimi
priimtus įsipareigojimus.</div>
<br>
<table style="border: 1px solid black; ">
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Krovinio pasikrovimo adresas:</td>
      <td style="border: 1px solid black; text-align: center;">{{$order['loadingAddress']}}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Pasikrovimo nr:</td>
      <td style="border: 1px solid black; text-align: center;"></td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Krovinio pasikrovimo data:</td>
      <td style="border: 1px solid black; text-align: center;">{{ date("Y-m-d", strtotime($order['creationDate'] )) }}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Krovinys:</td>
      <td style="border: 1px solid black; text-align: center;">{{$order['purpose']}}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Automobilio markė ir Nr:</td>
      <td style="border: 1px solid black; text-align: center;">{{$truck['brand']}} {{$truck['model']}} {{$truck['licensePlate']}}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Priekabos tipas:</td>
      <td style="border: 1px solid black; text-align: center;"></td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Krovinio iškrovimo adresas:</td>
      <td style="border: 1px solid black; text-align: center;">{{$order['deliveryAddress']}}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Krovinio gavėjas:</td>
      <td style="border: 1px solid black; text-align: center;"></td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Krovinio pristatymas:</td>
      <td style="border: 1px solid black; text-align: center;">{{$order['deliveryDate']}}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Papildomos sąlygos:</td>
      <td style="border: 1px solid black; text-align: center;">{{$order['additionalInformation']}}</td>
    </tr>
    <tr class="font-weight-bold" style="font-size: 10px;">
      <td style="border: 1px solid black;">Apmokėjimo už pervežimą sąlygos:</td>
      <td style="border: 1px solid black; text-align: center;">{{$order['price']}} + PVM pavedimu per 30d. po s/f ir org. CMR pristatymo</td>
    </tr>
</table>
<br>
<div>
<b>Šalių įsipareigojimai:</b> <br>
1) „Vežėjas” privalo tureti CMR važtaraščių kompektą, licenzija , galiojantį CMR draudimą, ir visus
reikalingus dokumentus vykdyti tarptatutinius krovinių pervežimus. <br>
2) Atvykti į pakrovimą/iškrovimą techniškai tvarkingu, švariu be pašalinių kvapų a/m. <br>
3) Pakrovimui/iškrovimui skirtos 24val.(NVS šalyse – 48val.), jei tai nėra savaitgalis, šventės dienos ar
néra nurodyta kitaip. Nepateikus transporto priemonės kroviniui pakrauti bauda 10% nuo užsakyme
nurodytos sumos, bet ne mažiau 100Eur. Nesilaikant terminų bauda 100Eur. už kiekvieną parą. <br>
4) Pasikrovimo metu skaičiuoti krovinio kiekį, įpakavimo atitiktį , stebėti jo pakuotę, kontroliuoti
krovinio išdėstymą ant ašių, esamam krovinio trūkumui , pakuočių pažeidimams, būtinai informuoti
užsakovą ir atžymėti CMR-e. <br>
5) „Vežėjas” privalo krovinio pakrovimo/iškrovimo vietoje paimti visus dokumentus, reikalingus
tinkamam krovinio pervežimui pagal šią sutartį,taip pat atsako už krovinį lydinčių dokumentų
saugumą. Spręsti iškilusias problemas tik su „Užsakovu". <br>
6) Pervežti „Užsakovo” nurodytą krovinį į jo paskyrimo vietą bei priduoti gavėjui iki sutaryje nurodytos
datos bei valandos. <br>
7) Užsakovas“ ir „Vežėjas“ atsako už teisingą savo įsipareigojimų, numatytų šioje sutartyje ir
1956.05.19 Tarptatutinių Pervežimų Konvencijoje, vykdymą. <br>
8) „Užsakovas“ įsipareigoja pateikti sutartyje nurodytą krovinį bei nustatyta tvarka užpildytus
dokumentus nepateikus krovinio ir laiku neinformavus „Vežėjo“ bauda 10% nuo užsakyme
nurodytos sumos, bet ne mažiau 100Eur. <br>
9) Šis užsakymas yra konfidencialus. <br>
10) Ginčai tarp šalių dėl šių įsipareigojimų vykdymo sprendžiami derybose, o nepavykus – juos sprendžia
teismas. Jeigu sutartis sudaroma faksu, patvirtintą sutartį Jūsų antspaudu ir parašu prašome grąžinti
faksu (46) 321080 <br>
</div>

<table style="margin-top:4rem;">
    <tr class="font-weight-bold" style="font-size: 12px; text-align: center;">
      <td>UŽSAKOVAS</td>
      <td>VEŽĖJAS</td>
    </tr>
</table>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>