@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h3 class="text-center">Donation List Table</h3>
          <h4 class="">Total Donation Income - {{ $totalamount[0]['total'] }} Kyats</h4>
          <div class="card-tools">
            <form action="{{ route('admin#searchDonate') }}">
              @csrf
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="searchDonate" class="form-control float-right" placeholder="Search">

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
                <th>Receive Name</th>
                <th>Donator Name</th>
                <th>Donation Amount</th>
                <th>Category</th>
                <th>Donated Date</th>
                <th>Updated Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $listData as $item )
              <tr>
                <td>{{ $item['donate_id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['donator_name'] }}</td>
                <td>{{ $item['donation_amount'] }} Kyats</td>
                <td>{{ $item['category_name'] }}</td>
                <td>{{ $item['created_at'] }}</td>
                <td>{{ $item['updated_at'] }}</td>

                @if (auth()->user()->role == 'admin')
                <td>
                  <a href="{{ route('admin#editDonation',$item['donate_id']) }}"><button class="btn btn-sm bg-dark text-white" ><i class="fas fa-edit"></i></button></a>
                  <a href="{{ route('admin#deleteDonation',$item['donate_id']) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
