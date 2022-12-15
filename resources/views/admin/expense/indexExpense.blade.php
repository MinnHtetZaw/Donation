@extends('admin.layouts.index')

@section('content')
<div class="row mt-4">
<div class="col-6 offset-3 mt-5">
    <div class="col-md-9">
        <div class="mb-3">
            <a href="{{ route('admin#listExpense') }}">
                <button class="btn btn-primary text-center">Expense List</button>
            </a>
        </div>
        @if (Session::has('ExpenseSuccess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{(Session::get('ExpenseSuccess'))}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Expense Page</legend>
        </div>

        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <form class="form-horizontal" action ="{{ route('admin#usageExpense',auth()->user()->id) }}" method="POST">
                    @csrf
                <div class="form-group row">
                  <label  class="col-sm-5 col-form-label">User Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="userName" class="form-control" value="{{ auth()->user()->name}}" disabled >
                  </div>

                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Expense Amount</label>
                  <div class="col-sm-10">
                    <input type="number" name="amount" class="form-control" value="{{ old('amount') }}">
                  </div>
                  @error('amount')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Category</label>
                  <div class="col-sm-10">
                    <select name="category" id="" class="form-control">
                        <option value="">Choose Options</option>
                        @foreach ( $category as $item )
                            <option value="{{ $item->category_id }}">{{ $item['category_name'] }}</option>
                        @endforeach
                    </select>
                  </div>
                  @error('category')
                  <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Expense Description</label>
                    <div class="col-sm-10">
                      <textarea name="expenseDescription" cols="20" rows="5" class="form-control">{{ old('expenseDescription') }}</textarea>
                    </div>
                    @error('expenseDescription')
                    <div style="margin-left:18%"  class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-5 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Expense</button>
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

@endsection
