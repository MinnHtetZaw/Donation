@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
<div class="col-6 offset-3 mt-4">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
            @if (Session::has('updateSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{(Session::get('updateSuccess'))}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
          <legend class="text-center">Category Edit Page</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action ="{{ route('admin#updateCategory',$categoryData->category_id) }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Category Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="categoryName" class="form-control" value="{{ old('categoryName',$categoryData->category_name) }}"  placeholder="Enter User Name...">
                  </div>
                  @error('categoryName')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                 @enderror
                </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
