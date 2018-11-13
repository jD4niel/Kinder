@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h1 class="h1">Lista de Alumnos</h1>
    </div>
    <hr>
    <div class="text-right">
    <a href="{{route('student.crear')}}" class="btn btn-primary text-center">Añadir nuevo alumno</a>
    </div>
    <div class="row justify-content-center">

        <table id="students_table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Grado</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($student as $item)
                        <tr id="id{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->last_name}}&nbsp;{{$item->second_last_name}}</td>
                            <td>{{$item->degree}}</td>
                            <td>{{$item->group}}</td>
                            <td>
                                <button onclick="borrar({{$item->id}})" class="btn btn-danger">Borrar</button>
                                <button onclick="modificar('{{$item->id}}','{{$item->name}}','{{$item->last_name}}',
                                        '{{$item->second_last_name}}','{{$item->degree}}','{{$item->group}}')"
                                        data-nombre="{{$item->name}}" class="btn btn-success"  data-toggle="modal" data-target="#ModificarAlumnoModal">Modificar</button>
                            </td>
                        </tr>


                    @endforeach
                </tbody>
            </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ModificarAlumnoModal" tabindex="-1" role="dialog" aria-labelledby="ModificarAlumnoModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos alumno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="">
                <div class="modal-body">
                    <input type="text" id="identificador_alumno" hidden>
                    <div class="form-group row">
                        <label for="alumno_nombre" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control col-md-12" id="input_name" placeholder="Nombre completo" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido_p" class="col-sm-2 col-form-label">Apellidos:</label>
                        <div class="form-group col-md-5">
                            <input type="text" id="input_ap" class="form-control col-md-12" placeholder="Apellido Paterno" required>
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" id="input_am" class="form-control col-md-12" placeholder="Apellido Materno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <select class="form-control col-md-12" name="Grado" id="Grado">
                                <option value="" disabled selected>Grado</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control col-md-12" name="Grupo" id="Grupo">
                                <option value="" disabled selected>Grupo</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>

                        <hr>
                        <label for="nombre_tutor" class="col-form-label">Tutor principal/padre</label>
                        <select name="" id="nombre_tutor" class="form-control">
                            @foreach($padre as $item)
                                <option value="{{$item->student_id}}">{{$item->name}}&nbsp;{{$item->last_name}}</option>
                            @endforeach
                        </select>
                        <label for="nombre_tutor_sustituto" class="col-form-label">Asignar tutor sustituto</label>
                        <select name="" id="nombre_tutor_sustituto" class="form-control">
                            <option value="0" selected disabled>- Seleccione nuevo tutor -</option>
                            @foreach($tutor_sustituto as $item)
                                <option value="{{$item->student_id}}">{{$item->name}}&nbsp;{{$item->last_name}}</option>
                            @endforeach
                        </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="update()" class="btn btn-primary">Modificar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_section')
    <script>
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
            $('#students_table').DataTable();
        } );

        function borrar(id){
            swal({
                title: "¿Eliminar registro?",
                text: "Una vez eliminado, no se podrán recuperar los datos",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/alumno/borrar/'+id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {id: id},
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            $('#id'+id).hide();
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                    swal("El registro fue eliminado correctamente", {
                        icon: "success",
                    });
                }
        });

        }
        function modificar(id,nombre,apellido_p,apellido_m,grado,grupo) {
            $('#nombre_tutor').val(id);
            $('#input_name').val(nombre);
            $('#input_ap').val(apellido_p);
            $('#input_am').val(apellido_m);
            $('#Grado').val(grado);
            $('#Grupo').val(grupo);
            $('#identificador_alumno').val(id);
        }
        function update() {
            var id = $('#identificador_alumno').val();
            var nombre = $('#input_name').val();
            var apellido_p = $('#input_ap').val();
            var apellido_m = $('#input_am').val();
            var grado = $('#Grado').val();
            var grupo = $('#Grupo').val();
          /*  var Grado  = $('#input_am').val();
            var Grupo*/
            $.ajax({
              url: '/alumno/modificar/'+id,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {'id': id,'nombre':nombre,'apellido_p':apellido_p,'apellido_m':apellido_m,'grado':grado,'grupo':grupo},
              type: 'PUT',
              dataType: 'json',
              success: function (data) {
                  $('#ModificarAlumnoModal').modal('hide');
                  console.log(data);
                  swal(
                      'Cambios guardados',
                      'Alumno correctamente modificado',
                      'success'
                  )
                  $('#id'+id).html('<td>'+id+'</td>\n' +
                      '                            <td>'+nombre+'</td>\n' +
                      '                            <td>'+apellido_p+'&nbsp;'+apellido_m+'</td>\n' +
                      '                            <td>'+grado+'</td>\n' +
                      '                            <td>'+grupo+'</td>\n' +
                      '                            <td>\n' +
                      '                                <button onclick="borrar('+id+'" class="btn btn-danger">Borrar</button>\n' +
                      '                                <button onclick="modificar("'+id+'","'+nombre+'","'+apellido_p+'","'+apellido_m+'","'+grado+'","'+grupo+'")" class="btn btn-success"  data-toggle="modal" data-target="#ModificarAlumnoModal">Modificar</button>\n' +
                      '                            </td>')
              },
                error: function (data) {
                  console.log(data);
              }
          });
        }
    </script>
@endsection
