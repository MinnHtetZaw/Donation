@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">User List Table</h3>

          <div class="card-tools">
            <form action="{{ route('admin#searchUser') }}">
              @csrf
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="searchUser" class="form-control float-right" placeholder="Search">

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
                <th>User Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $userData as $item )
              <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['role'] }}</td>
                <td>{{ $item['phone'] }}</td>
                <td>{{ $item['address'] }}</td>

                @if (auth()->user()->role =='admin')
                <td>
                  <a href="{{ route('admin#editUser',$item['id']) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                  <a href="{{ route('admin#deleteUser',$item['id']) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
