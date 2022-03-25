<x-app>
  <div class="container">
    {!! Form::open()->method('post')->autocomplete('off')->route('employee.store') !!}
      <div class="form-row">
        <div class="form-group col-md-6 col-12">
          {!! Form::text('full_name', 'Nome Completo')
            ->attrs(['class' => 'w-full'])
            ->placeholder('Nome completo')
            ->min(0)
            ->max(1000)
          !!}
        </div>
        <div class="form-group col-md-6 col-12">
          {!! Form::text('login', 'Login')
            ->attrs(['class' => 'w-full'])
            ->min(0)
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
        {{-- <div class="form-group col-md-6 col-12">
          {!! Form::text('current', 'Nome Completo')
            ->attrs(['class' => 'w-full'])
            ->min(0)
            ->max(1000)
          !!}
        </div> --}}
        <div class="form-group col-12">
          {!! Form::submit('Cadastrar')
            ->success()
            ->attrs(['class' => 'col-12'])
          !!}
          </div>
      </div>
    {!! Form::close() !!}
  </div>
</x-app>
