<x-app>
  <div class="container col-md-12 col-lg-5">
    <a href="{{route('employee.index')}}" class="btn btn-primary my-4">
      Back
    </a>
    {!! Form::open()->method('post')->autocomplete('off')->route('movement.store', ['employeeId' => $employeeId]) !!}
      <div class="form-row">
        <div class="form-group col-md-6 col-12">
          {!! Form::select('movement_type', 'Type')
          ->options(app\Models\Movement::typesMovement()->prepend('Choose ...', ''))
          ->required();
          !!}
        </div>
        <div class="form-group col-md-6 col-12">
          {!! Form::text('value', 'Value')
            ->attrs(['class' => 'w-full money2'])
            ->type('text')
            ->min(0)
            ->max(1000)
            ->required();
          !!}
        </div>
        <div class="form-group col-12">
          {!! Form::textarea('note', 'Note')
            ->attrs(['class' => 'w-full'])
            ->type('text')
            ->placeholder('Description ...')
            ->min(0)
            ->max(1000);
          !!}
        </div>
        <div class="form-group col-12">
          {!! Form::submit('Register')
            ->success()
            ->attrs(['class' => 'col-12'])
          !!}
          </div>
      </div>
    {!! Form::close() !!}
  </div>
</x-app>

