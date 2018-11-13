@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <a href="{{route('student.missing')}}" class="a-free"><div class="card" style="width: 18rem; margin:10px;background-color: #cb5524;">
            <div class="card-body">
                <h2 class="card-title" style="z-index: 50;">Alumnos</h2>
                <h4 class="card-subtitle text-left mb-2">Faltantes</h4>
                <i class="fas fa-user-slash card-fa"></i>
                <div id="alumnos_restantes" class="variable-card text-right">
                </div>
            </div>
            </div></a>
        <a href="{{route('student.index')}}" class="a-free"><div class="card" style="width: 18rem; margin:10px;background-color: #34cb35;">
            <div class="card-body">
                <h2 class="card-title" style="z-index: 50;">Alumnos</h2>
                <h4 class="card-subtitle    mb-2 " style="color:#fff;">Ingresados</h4>
                <i class="fas fa-user-check card-fa"></i>
                <div id="alumnos_ingresados" class="variable-card text-right">

                </div>
            </div>
            </div></a>
        @if(Auth::user()->role_id == 1)
        <a href="{{route('student.index')}}" class="a-free">
        <div class="card" style="width: 18rem; margin:10px;background-color: #3d7fcb;">
                <div class="card-body">
                    <h2 class="card-title" style="z-index: 50;">Alumnos</h2>
                    <h4 class="card-subtitle    mb-2 " style="color:#fff;">lista</h4>
                    <i class="fas fa-user-graduate card-fa"></i>
                    <div class="variable-card text-right">
                        &nbsp;
                    </div>
                </div>
        </div>
        </a>
        <a href="{{route('tutor.index')}}" class="a-free"><div class="card" style="width: 18rem; margin:10px;background-color: #cb2430;">
            <div class="card-body">
                <h2 class="card-title" style="z-index: 50;">Tutores</h2>
                <h4 class="card-subtitle    mb-2 " style="color:#fff;">lista</h4>
                <i class="fas fa-user-friends card-fa"></i>
                <div class="variable-card text-right">
                    &nbsp;
                </div>
            </div>
            </div></a>
        <a href="{{route('student.index')}}" class="a-free"><div class="card" style="width: 18rem; margin:10px;background-color: #21a679;">
            <div class="card-body">
                <h2 class="card-title" style="z-index: 50;">Credenciales</h2>
                <h4 class="card-subtitle    mb-2 " style="color:#fff;">generar</h4>
                <i class="fas fa-id-card card-fa"></i>
                <div class="variable-card text-right">
                    &nbsp;
                </div>
            </div>
            </div></a>
        <a href="{{route('student.index')}}" class="a-free"><div class="card" style="width: 18rem; margin:10px;background-color: #cb2670;">
            <div class="card-body">
                <h2 class="card-title" style="z-index: 50;">Personal</h2>
                <h4 class="card-subtitle    mb-2 " style="color:#fff;">académico</h4>
                <i class="fas fa-chalkboard-teacher card-fa"></i>
                <div class="variable-card text-right">
                    &nbsp;
                </div>
            </div>
            </div></a>
        @endif
    </div>
</div>
@endsection
@section('script_section')
    <script>
        (function update() {
            var route="{{route('home.update')}}";
            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'get',
                dataType: 'json',
                success: function (data) {
                   console.log(data);
                   $('#alumnos_restantes').html(data[0]);
                   $('#alumnos_ingresados').html(data[1]);
                },
                error: function (data) {
                    console.log(data);
                }
        }).then(function() {           // on completion, restart
                setTimeout(update, 3000);  // function refers to itself
            });
        })();
    </script>
@endsection