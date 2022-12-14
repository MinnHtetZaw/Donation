@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
<div class="col-6 offset-3 mt-4">
    <div class="col-md-9">
        <div class="mb-3">
            <a href="{{ route('admin#Dashboard') }}">
                <button class="btn btn-secondary text-center">Back</button>
            </a>
        </div>
        @if (Session::has('updatePasswordSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{(Session::get('updatePasswordSuccess'))}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (Session::has('fails'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{(Session::get('fails'))}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      <div class="card">
        <div class="card-header p-2">

          <legend class="text-center">Password Change Page</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action ="{{ route('admin#changePassword',auth()->user()->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Old Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="oldPassword" class="form-control"  placeholder="Enter Old Password...">
                  </div>
                  @error('oldPassword')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                 @enderror
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="newPassword" class="form-control" placeholder="Enter New Password...">
                    </div>
                    @error('newPassword')
                    <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                   @enderror
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Confirmed Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="confirmedPassword" class="form-control" placeholder="Enter Confirmed Password..">
                    </div>
                    @error('confirmedPassword')
                    <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                   @enderror
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update Password</button>
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
