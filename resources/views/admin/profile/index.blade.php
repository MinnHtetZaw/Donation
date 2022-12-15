@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
    <div class="col-5 mt-4">
        <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <legend class="text-center">User Profile</legend>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                      <div class="form-group row">
                        <label  class="col-sm-5 col-form-label">Name:</label>
                        <span class="col mt-2"> {{ $userData->name }}</span>
                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-5 col-form-label">Email:</label>
                        <span class="col mt-2"> {{ $userData->email }}</span>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Role:</label>
                        <span class="col mt-2"> {{ $userData->role }}</span>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Phone:</label>
                        <span class="col mt-2"> {{ $userData->phone }}</span>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Address:</label></label>
                        <span class="col mt-2"> {{ $userData->address }}</span>
                      </div>


                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 mt-4">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action ="{{ route('admin#editProfile',$userData->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label  class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" name="userName" class="form-control" value="{{ old('userName',$userData->name) }}"  placeholder="Enter User Name...">
                          </div>
                          @error('userName')
                          <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                         @enderror
                        </div>

                        <div class="form-group row">
                          <label  class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="userEmail" class="form-control" value="{{ old('userEmail',$userData->email) }}" placeholder="Enter User Email...">
                          </div>
                          @error('userEmail')
                          <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                         @enderror
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Role</label>
                          <div class="col-sm-10">
                            <input type="text" name="userRole" class="form-control" value="{{ old('userRole',$userData->role) }}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Phone</label>
                          <div class="col-sm-10">
                            <input type="text" name="userPhone" class="form-control" value="{{ old('userPhone',$userData->phone) }}" placeholder="Enter Phone">
                          </div>
                          @error('userPhone')
                          <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                         @enderror
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Address</label></label>
                          <div class="col-sm-10">
                           <textarea name="userAddress" class="form-control" id="" cols="20" rows="5" placeholder="Enter Address">{{ old('userAddress',$userData->address) }}</textarea>
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
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <a href="{{ route('admin#editPassword') }}">Change Password</a>
                        </div>
                      </div>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>


@endsection
