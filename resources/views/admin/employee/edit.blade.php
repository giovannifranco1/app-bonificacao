<x-app>
  <div class="container">
    <a href="{{route('employee.index')}}" class="btn btn-primary my-4">
      Voltar
    </a>
    {!! Form::open()
    ->method('put')
    ->autocomplete('off')
    ->fill($employee)
    ->route('employee.update', ['id' => $employee->id]) !!}
    <div class="form-row">
      <div class="form-group col-12">
        {!! Form::text('full_name', 'Full name')
        ->attrs(['class' => 'w-full'])
        ->placeholder('Full name')
        ->required()
        ->min(0)
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-md-6 col-12">
        {!! Form::text('login', 'Login')
        ->attrs(['class' => 'w-full'])
        ->min(0)
        ->required()
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-md-6 col-12">
        {!! Form::text('password', 'Senha')
        ->attrs(['class' => 'w-full'])
        ->type('password')
        ->min(0)
        ->max(1000)
        !!}
      </div>
      <div class="form-group col-12">
        {!! Form::submit('Save')
        ->success()
        ->attrs(['class' => 'col-12'])
        !!}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</x-app>
