@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">

        @if (Session::has('expenseDelete'))
        <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
            {{(Session::get('expenseDelete'))}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card-header">

          <h3 class="text-center mb-5">Expense List Table</h3>
          <h4 class="">Total Expense Usage - {{$totalamount[0]['total']}} Kyats</h4>

          <div class="card-tools">
            <form action="{{ route('admin#searchExpense') }}">
              @csrf
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="searchExpense" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Expense User</th>
                <th>Amount</th>
                <th>Expense Description</th>
                <th>Category</th>
                <th>Expensed Date</th>
                <th>Updated Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $listData as $item )
              <tr>
                <td>{{ $item['expense_id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['expense_amount'] }} Kyats</td>
                <td>{{ $item['expense_description'] }}</td>
                <td>{{ $item['category_name'] }}</td>
                <td>{{ $item['created_at'] }}</td>
                <td>{{ $item['updated_at'] }}</td>


                @if (auth()->user()->role =='admin')
                <td>
                  <a href="{{ route('admin#editExpense',$item['expense_id']) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                  <a href="{{ route('admin#deleteExpense',$item['expense_id']) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                </td>
                @endif
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
