<x-app>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Login</th>
                  <th>Saldo atual</th>
                </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nome</th>
                <th>Login</th>
                <th>Saldo atual</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($employees as $employee)
                <tr>
                  <td>{{ $employee->full_name }}</td>
                  <td>{{ $employee->login }}</td>
                  <td>{{ $employee->current_balance }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>
</x-app>
