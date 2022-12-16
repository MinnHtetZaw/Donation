@extends('admin.layouts.index')

@section('content')
<div class="m-2">
    <a href="{{ route('admin#incomeCsvDownload') }}"><button class="btn btn-success mt-3">CVS download </button></a>
</div>
<canvas id="myIncomeChart" height="100px"></canvas>

@endsection

@section('chartIncomeJsScript')

<script type="text/javascript">

    var incomelabels =  {{ Js::from($incomelabels) }};
    var incomeusers =  {{ Js::from($incomedata) }};

    const incomedata = {
      labels: incomelabels,
      datasets: [{
        label: 'Donate Chart',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: incomeusers,
      }]
    };

    const incomeconfig = {
      type: 'line',
      data: incomedata,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('myIncomeChart'),
      incomeconfig
    );

</script>
@endsection


