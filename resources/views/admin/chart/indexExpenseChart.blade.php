@extends('admin.layouts.index')

@section('content')
<div class="m-2">
    <a href="{{ route('admin#expenseCsvDownload') }}"><button class="btn btn-success mt-3">CVS download </button></a>
</div>
<canvas id="myExpenseChart" height="100px" ></canvas>

@endsection


@section('chartExpenseJsScript')

<script type="text/javascript">

  var expenselabels =  {{ Js::from($expenselabels) }};
  var expenseusers =  {{ Js::from($expensedata) }};

  const expensedata = {
    labels: expenselabels,
    datasets: [{
      label: 'Expense Chart',
      backgroundColor: 'rgba(240, 157, 157,0.5)',
      borderColor: 'rgb(255, 99, 132)',
      pointRadius: 10,
      pointHoverRadius: 20,
      data: expenseusers,
    }]
  };

  const expenseconfig = {
    type: 'line',
    data: expensedata,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myExpenseChart'),
    expenseconfig
  );

</script>

@endsection

<div class="" style="background-color: rgb(240, 157, 157)"></div>
