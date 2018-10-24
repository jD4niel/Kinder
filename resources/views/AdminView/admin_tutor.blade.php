@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h1 class="h1">Lista de tutores</h1>
    </div>
    <hr>
    <div class="text-right">
    <a href="{{route('student.crear')}}" class="btn btn-primary text-center">Añadir nuevo tutor</a>
    </div>
    <div class="row justify-content-center">

        <table id="tutor_table" class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Tutorados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tutor as $item)
                        <tr id="id{{$item->user_id}}">
                            <td>{{$item->user_id}}</td>
                            <td>{{$item['user']['name']}}</td>
                            <td>{{$item['user']['last_name']}}&nbsp;{{$item["user"]["second_last_name"]}}</td>
                            <td>{{$item['user']['phone_number']}}</td>
                            <td>{{$item['user']['email']}}</td>
                            <td>{{$item->name}}&nbsp;{{$item->last_name}}&nbsp;{{$item->second_last_name}}</td>
                            <td>
                                <button onclick="borrar({{$item->user_id}})" class="btn btn-danger">Borrar</button>
                                <button onclick="modificar('{{$item->user_id}}','{{$item["user"]["name"]}}','{{$item["user"]["last_name"]}}','{{$item["user"]["second_last_name"]}}','{{$item["user"]["phone_number"]}}','{{$item["user"]["email"]}})')" data-nombre="{{$item->name}}" class="btn btn-success"  data-toggle="modal" data-target="#ModificarTutorModal">Modificar</button>
                            </td>
                        </tr>


                    @endforeach
                </tbody>
            </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ModificarTutorModal" tabindex="-1" role="dialog" aria-labelledby="ModificarTutorModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header text-center">
                    <h3 class="modal-title text-center" id="exampleModalLabel">&nbsp;Editar datos tutor</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="">
                <div class="modal-body">
                    <input type="text" id="identificador_tutor" hidden>
                    <div id="form-tutor" style="margin-top: 35px;padding-left: 30px;padding-right: 30px;">
                        <div class="form-group row">
                            <label for="tutor_nombre" class="col-sm-2 col-form-label">Nombre:</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control col-md-12" id="tutor_nombre" placeholder="Nombre completo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tutor_apellido_m" class="col-sm-2 col-form-label">Apellidos:</label>
                            <div class="form-group col-md-5">
                                <input type="text" id="tutor_apellido_p" class="form-control col-md-12" placeholder="Apellido Paterno">
                            </div>
                            <div class="form-group col-md-5">
                                <input type="text" id="tutor_apellido_m" class="form-control col-md-12" placeholder="Apellido Materno">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tutor_phone" class="col-sm-2 col-form-label">Contacto:</label>
                            <div class="form-group col-md-5">
                                <input type="number" min="0" id="tutor_phone" class="form-control col-md-12" placeholder="Telefono">
                            </div>
                            <div class="form-group col-md-5">
                                <input type="email" id="tutor_email" class="form-control col-md-12" placeholder="Email">
                            </div>
                        </div>
                    </div>

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
            $('#tutor_table').DataTable();
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
                        url: '/tutores/borrar/'+id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'id': id},
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            $('#id'+id).hide();
                            swal("El registro fue eliminado correctamente", {
                                icon: "success",
                            });
                        },
                        error: function (data) {
                            console.log(data);
                            swal("Error al eliminar registro", {
                                icon: "warning",
                            });
                        }
                    });

                }
        });

        }
        function modificar(id,nombre,apellido_p,apellido_m,phone,email){
            alert(id + nombre + apellido_p);
            $('#identificador_tutor').val(id);
            $('#tutor_nombre').val(nombre);
            $('#tutor_apellido_m').val(apellido_p);
            $('#tutor_apellido_m').val(apellido_m);
            $('#tutor_phone').val(phone);
            $('#email').val(email);
        }
        function update() {
            var id = $('#identificador_tutor').val();
            var nombre = $('#tutor_nombre').val();
            var apellido_p = $('#tutor_apellido_p').val();
            var apellido_m = $('#tutor_apellido_m').val();
            var phone = $('#tutor_phone').val();
            var email = $('#email').val();

          /*  var Grado  = $('#input_am').val();
            var Grupo*/
            $.ajax({
              url: '/tutores/modificar/'+id,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {'id': id,'nombre':nombre,'apellido_p':apellido_p,'apellido_m':apellido_m,'phone':phone,'email':email},
              type: 'PUT',
              dataType: 'json',
              success: function (data) {
                  $('#ModificarTutorModal').modal('hide');
                  console.log(data);
                  swal(
                      'Cambios guardados',
                      'Tutor correctamente modificado',
                      'success'
                  )
                  $('#id'+id).html('<td>'+id+'</td>\n' +
                      '                            <td>'+nombre+'</td>\n' +
                      '                            <td>'+apellido_p+'&nbsp;'+apellido_m+'</td>\n' +
                      '                            <td>'+phone+'</td>\n' +
                      '                            <td>'+email+'</td>\n' +
                      '                            <td>\n' +
                      '                                <button onclick="borrar('+id+')" class="btn btn-danger">Borrar</button>\n' +
                      '                                <button onclick="modificar("'+id+'","'+nombre+'","'+apellido_p+'","'+apellido_m+'","'+phone+'","'+email+'")" class="btn btn-success"  data-toggle="modal" data-target="#ModificarTutorModal">Modificar</button>\n' +
                      '                            </td>')
              },
                error: function (data) {
                  console.log(data);
              }
          });
        }
    </script>
@endsection
