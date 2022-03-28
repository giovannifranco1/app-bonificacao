<x-app>
  <div class="container">
    {!! Form::open()->method('get')->autocomplete('off')->route('movement.search')->fill($inputs ?? '')!!}
    <div class="form-row">
      <div class="form-group col-md-4 col-12">
        {!! Form::text('full_name', 'Employee')
        ->attrs(['class' => 'w-full'])
        ->placeholder('Full name')
        ->min(0)
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-md-3 col-12">
        {!! Form::text('created_at', 'Created at')
        ->attrs(['class' => 'w-full'])
        ->type('date')
        ->min(0)
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-md-3 col-12">
        {!! Form::select('movement_type', 'Type')
          ->options(app\Models\Movement::typesMovement()->prepend('Choose ...', ''))
        !!}
      </div>
      <div class="form-group col-md-2 col-12">
        {!! Form::submit('search')
        ->info()
        ->attrs(['style' => 'margin-top:30px'])
        !!}
      </div>
    </div>
    {!! Form::close() !!}
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Movements</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Value</th>
                <th>Employee</th>
                <th>Note</th>
                <th>Created at</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Value</th>
                <th>Employee</th>
                <th>Note</th>
                <th>Created at</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($movements as $movement)
              <tr>
                <td class="text-left">{{ $movement->id }}</td>
                <td class="text-left">{{ ucfirst($movement->movement_type) }}</td>
                <td class="text-left">
                  @if ($movement->movement_type === 'income')
                    <span class="text-success">{{ $movement->value }}</span>
                  @else
                    <span class="text-danger">{{'-' . $movement->value }}</span>
                  @endif
                </td>
                <td class="text-left">{{ $movement->employee->full_name }}</td>
                <td class="text-left">{{ $movement->note }}</td>
                <td class="text-left">{{ $movement->created_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @if (isset($inputs))
          {!! $movements
          ->appends($inputs)
          ->links('vendor.pagination.bootstrap-4')
          !!}
          @else
          {!! $movements->links('vendor.pagination.bootstrap-4') !!}
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app>
