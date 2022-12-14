@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
<div class="col-6 offset-3 mt-4">
    <div class="col-md-9">
      @if (Session::has('UserUpdateSuccess'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{(Session::get('UserUpdateSuccess'))}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action ="{{ route('admin#updateUser',$uData->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="userName" class="form-control" value="{{ old('userName',$uData->name) }}"  placeholder="Enter User Name...">
                  </div>
                  @error('userName')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                 @enderror
                </div>

                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="userEmail" class="form-control" value="{{ old('userEmail',$uData->email) }}" placeholder="Enter User Email...">
                  </div>
                  @error('userEmail')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                 @enderror
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Role</label>
                  <div class="col-sm-10">
                    <input type="text" name="userRole" class="form-control" value="{{ old('userRole',$uData->role) }}" >

                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" name="userPhone" class="form-control" value="{{ old('userPhone',$uData->phone) }}" placeholder="Enter Phone">
                  </div>
                  @error('userPhone')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                 @enderror
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Address</label></label>
                  <div class="col-sm-10">
                   <textarea name="userAddress" class="form-control" id="" cols="20" rows="5" placeholder="Enter Address">{{ old('userAddress',$uData->address) }}</textarea>
                  </div>
                  @error('userAddress')
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
