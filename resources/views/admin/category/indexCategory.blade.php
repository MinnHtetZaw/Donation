@extends('admin.layouts.index')

@section('content')
<div class="row">

    <div class="col-4" style="margin-top: 3%">

      <div class="card">
        <div class="card-header text-center">
          <h4>Create Category</h3>
        </div>

        <div class="card-body">
          <form action="{{ route('admin#createCategory') }}" method="POST">
            @csrf
          <div class="form-group row">
            <label class="col-sm-5 col-form-label"> Category Name</label>
            <div class="col-sm-7">
              <input type="text" name="categoryName" class="form-control" placeholder="Enter Category...">
              @error('categoryName')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <div class="offset-sm-5 col-sm-10  mt-2">
              <button type="submit" class="btn bg-dark text-white">Create</button>
            </div>
          </div>
        </form>
        </div>

      </div>


    </div>

    <div class="col-7 ml-5" style="margin-top: 3% ">
      <div class="card">
        <div class="card-header">

          <div class="card-tools">
            <form action="{{ route('admin#searchCategory') }}" >
              @csrf
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="searchCategory" class="form-control float-right" placeholder="Search">

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
                <th>Category Name</th>
                <th>Created Date</th>
                <th>Updated Date</th>
              </tr>
            </thead>
            <tbody>
             @foreach ($categoryData as $item)
             <tr>
              <td>{{ $item['category_id'] }}</td>
              <td>{{ $item['category_name'] }}</td>
              <td>{{ $item['created_at'] }}</td>
              <td>{{ $item['updated_at'] }}</td>
              <td>
                <a href="{{ route('admin#editCategory',$item['category_id']) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                <a href="{{ route('admin#deleteCategory',$item['category_id']) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
              </td>
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
