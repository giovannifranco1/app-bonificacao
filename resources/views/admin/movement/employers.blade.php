<x-app>
  <div class="container">
    <a href="{{route('employee.index')}}" class="btn btn-primary my-4">
      Voltar
    </a>
    <h5>
      Records
    </h5>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Movements</h6>
        <a href="{{route('movement.create', ['employeeId' => $employeeId])}}" class="btn btn-success btn-icon-split position-absolute" style="right: 30px; top:7px">
          <span class="icon text-white-50">
            <i class="fas fa-plus-circle"></i>
          </span>
          <span class="text">Add</span>
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Created at</th>
                <th>Type</th>
                <th>Value</th>
                <th>Note</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="30%">Name</th>
                <th width="10%">Type</th>
                <th width="20%">Value</th>
                <th width="40%">Note</th>
                <th></th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($movements as $movement)
              <tr>
                <td class="text-left">{{ $movement->created_at }}</td>
                <td class="text-left">{{ ucfirst($movement->movement_type) }}</td>
                <td class="text-left">
                  @if ($movement->movement_type === 'income')
                    <span class="text-success">{{ $movement->value }}</span>
                  @else
                    <span class="text-danger">{{'-' . $movement->value }}</span>
                  @endif
                </td>
                <td class="text-left">{{ $movement->note }}</td>
                <td>
                  <a href="{{route('movement.edit', ['id' => $movement->id])}}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app>
