<x-app>
  <div class="container col-12 col-md-8">
    <a href="{{route('employee.index')}}" class="btn btn-primary my-4">
      Voltar
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
            ->attrs(['class' => 'w-full money2', 'pattern' => '[0-9]*'])
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
  {{-- <script>
      $(document).ready(function(){
          $('.money2').mask('000.000.000.000.000,00', {reverse: true});
      });
  </script> --}}
</x-app>

