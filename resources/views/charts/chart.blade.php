<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apžvalga</title>

    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>

</head>
<body>

<div class="flex justify-between logo h-16 mb-12">
  <div class="flex items-center text-white text-2xl ml-8 font-medium">Užsakymų charakteristikų statistika</div>
  <a href="{{ route('main') }}" class="flex items-center text-white text-2xl mr-8 font-medium">Atgal</a>
</div>

<div class="d-flex justify-content-center">
    <div class="w-2/6 mr-40" style="height: 40vh;">
        <div class="h-14 border-t-2 border-r-2 border-l-2 flex items-center justify-content-center">
            <div class="text-lg font-medium mr-3">Užsakymų būklės</div>
        </div>
        
        <div class="h-14 border-t-2 border-r-2 border-l-2 flex items-center justify-content-center">
                    <div class="flex-initial">
                        <form action="{{ route('orderChartSearch') }}" method="get">
                            <div class="input-group">
                            <div class="flex items-center text-lg font-medium mr-3">Nuo: </div>
                            <input type="date" name="search1" class="form-control mr-2">
                            <div class="flex items-center text-lg font-medium mr-3">Iki: </div>
                            <input type="date" name="search2" class="form-control">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn btn-primary ml-2 flex items-center">
                                    Ieškoti
                                </button>
                            </span>
                            </div>
                        </form>
                    </div>
            </div>
            @if ($data['statusorder'])
                <div class="p-2 rounded-lg text-center border-2 bg-danger text-white">
                    {{ $data['statusorder'] }}
                </div>
            @endif
           
        <canvas id="orderChart" class="border-2"></canvas>
    </div>

    <div class="w-2/6" style="height: 40vh;">
    <div class="h-14 border-t-2 border-r-2 border-l-2 flex items-center justify-content-center">
            <div class="text-lg font-medium mr-3">Sąskaitų būklės</div>
        </div>
        <div class="h-14 border-t-2 border-r-2 border-l-2 flex items-center justify-content-center">
                    <div class="flex-initial">
                        <form action="{{ route('paymentChartSearch') }}" method="get">
                            <div class="input-group">
                            <div class="flex items-center text-lg font-medium mr-3">Nuo: </div>
                            <input type="date" name="search1" class="form-control mr-2">
                            <div class="flex items-center text-lg font-medium mr-3">Iki: </div>
                            <input type="date" name="search2" class="form-control">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn btn-primary ml-2 flex items-center">
                                    Ieškoti
                                </button>
                            </span>
                            </div>
                        </form>
                    </div>
            </div>
            @if ($data['statuspayment'])
                <div class="p-2 rounded-lg text-center border-2 bg-danger text-white">
                    {{ $data['statuspayment'] }}
                </div>
            @endif

        <canvas id="paymentChart" class="border-2"></canvas>
    </div>
</div>

<script>
    $(function() {

        
        var data = <?php echo json_encode($data['data']); ?>;
        console.log(data);
        var order = data.toString().split(',', 3);
        console.log(order);
        var pieChartCanvas = $('#orderChart');
        var pieChart = new Chart(pieChartCanvas, {
            type:'pie',
            data:{
                labels: ['Atlikta', 'Vykdoma', 'Atšaukta'],
                datasets:[
                        {
                    label:'Užsakymų būklės',
                    data:order,
                    backgroundColor:['#6ab04c', '#f9ca24', '#eb4d4b'] 
                    }
                ]
            },
        })
    })

    $(function() {
        var datas = <?php echo json_encode($data['data']); ?>;
        console.log(datas);
        var payment = {};
        payment = datas.splice(3, 3);
        console.log(payment);
        var pieChartCanvas = $('#paymentChart');
        var pieChart = new Chart(pieChartCanvas, {
            type:'pie',
            data:{
                labels: ['Sumokėta', 'Išsiųsta', 'Neišsiųsta'],
                datasets:[
                        {
                    label:'Sąskaitų būklės',
                    data:payment,
                    backgroundColor:['#6ab04c', '#f9ca24', '#eb4d4b'] 
                    }
                ]
            },
        })
    })
</script>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
</body>
</html>