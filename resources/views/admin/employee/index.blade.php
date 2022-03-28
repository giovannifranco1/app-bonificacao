<x-app>
  <div class="container">
    {!! Form::open()->method('get')->autocomplete('off')->route('employee.search')->fill($inputs ?? '')!!}
    <div class="form-row">
      <div class="form-group col-md-4 col-12">
        {!! Form::text('full_name', 'Full name')
        ->attrs(['class' => 'w-full'])
        ->placeholder('Full name')
        ->min(0)
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-md-4 col-12">
        {!! Form::text('created_at', 'Create at')
        ->attrs(['class' => 'w-full'])
        ->type('date')
        ->min(0)
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-md-4 col-12">
        {!! Form::submit('search')
        ->info()
        ->attrs(['style' => 'margin-top:30px'])
        !!}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
  <div class="container">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Employers</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Balance</th>
                <th>Created at</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="5%">ID</th>
                <th width="30%">Name</th>
                <th width="15%">Balance</th>
                <th width="30%">Created at</th>
                <th width="30%"></th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($employers as $employee)
              <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->full_name }}</td>
                <td>{{ "R$ " . number_format($employee->current_balance, 2, ",", "."); }}</td>
                <td>{{ $employee->created_at }}</td>
                <td class="d-flex">
                  <a href="{{route('employee.edit', ['id' => $employee->id])}}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <a href="{{route('employee.movements', ['id' => $employee->id])}}" class="ml-2 btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exchange-alt"></i>
                    </span>
                    <span class="text">Movements</span>
                  </a>
                  <form action="{{route('employee.destroy', ['id' => $employee->id]) }}" method="post" title="Delete">
                    @csrf
                    @method('delete')
                    <button type="submit" class="ml-2 btn btn-danger btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                      </span>
                      <span class="text">Delete</span>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @if (isset($inputs))
          {!! $employers
          ->appends($inputs)
          ->links('vendor.pagination.bootstrap-4')
          !!}
          @else
          {!! $employers->links('vendor.pagination.bootstrap-4') !!}
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app>
