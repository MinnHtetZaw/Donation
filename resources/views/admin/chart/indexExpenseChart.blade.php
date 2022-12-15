@extends('admin.layouts.index')

@section('content')

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
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
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
