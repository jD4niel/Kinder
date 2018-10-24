@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h1 class="h1">CREAR USUARIO</h1>
    </div>
    <hr>
    <div class="row" id="form_create">
    <form action="" style="background-color: white; padding-top: 10px;" class="col-md-7 form-horizontal">
        <div style="margin: auto;">
            <center>
                <h3  style="margin: auto;">Datos del alumno</h3>
            </center>
        </div>
        <hr>
        <div class="form-group row">
            <label for="alumno_nombre" class="col-sm-2 col-form-label">Nombre:</label>
            <div class="col-md-10">
                <input type="text" class="form-control col-md-12" id="alumno_nombre" placeholder="Nombre completo" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="apellido_p" class="col-sm-2 col-form-label">Apellidos:</label>
            <div class="form-group col-md-5">
                <input type="text" id="alumno_apellido_p" class="form-control col-md-12" placeholder="Apellido Paterno" required>
            </div>
            <div class="form-group col-md-5">
                <input type="text" id="alumno_apellido_m" class="form-control col-md-12" placeholder="Apellido Materno">
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
        <br>
        <div class="form-group row">
            <label for="padre_select" class="h4 col-form-label col-md-4">Padre o tutor principal</label>
            <div class="form-group col-md-8">
            <select name="" id="padre_select" class="form-control h4">
                <option value="0" disabled selected>-Selecciona un padre/tutor-</option>
                @foreach($user as $item)
                    <option value="{{$item->id}}">{{$item->name}}&nbsp;{{$item->last_name}}&nbsp;{{$item->second_last_name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <button type="button" id="trigger_tutor" class="btn btn-block">Crear tutor</button>
        <div id="form-tutor" style="display: none; margin-top: 35px">
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
            <div class="form-group row">
                <label for="tutor_colony" class="col-sm-2 col-form-label">Dirección:</label>
                <div class="form-group col-md-5">
                    <select name="" id="tutor_municipality" class="form-control">
                        <option value="0" disabled selected>- Municipio -</option>
                        @foreach($municipality as $item)
                            <option value="{{$item->municipality}}">{{$item->municipality}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <select name="" id="tutor_colony" class="form-control">
                        <option value="0" disabled selected>- Colonia -</option>
                        <option value=""> Selecciona un municipio </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="tutor_cp" class="col-sm-2 col-form-label">Dirección:</label>
                <div class="form-group col-md-4">
                    <input type="text" id="tutor_cp" placeholder="Código Postal" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" id="tutor_num_ext" placeholder="Num ext" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" id="tutor_calle" class="form-control col-md-12" placeholder="Calle">
                </div>
            </div>
            <div id="passwordshow">
            </div>
        </div>

        <hr>
        <div class="form-group">
            <input onclick="guardar()" type="button" class="btn btn-primary btn-block form-control" value="Registrar Alumno">
        </div>
    </form>
    <div class="col-md-5 text-center" style="background-color: #79858b;">
        {{--dropzone para subir imagenes--}}
        <div class="control-label col-md-12" id="drop">
            <div class="dropzone dropzone-file-area" id="my-dropzone" style="width: 100%; height: 350px; margin-top: 50px; border-width: 4px; border-color: rgb(54, 198, 211);">
                <h3 class="sbold">Imagen del alumno</h3>
                <div class="fallback">
                    <input name="file" type="file" id="file_" multiple hidden>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <button id="submit" class="btn blue  btn-block" ><i class="fa fa-upload"></i>Subir</button>
        </div>
        <br>
    </div>


    </div>
    <div class="row">
        <div id="credencial_box" class="float-right" style="display: none;margin:auto;">
            <span></span>
            <hr>
            <div class="text-center" style="margin: auto;">
            <button onclick="generar_credencial()" class="btn btn-lg btn-danger" style="margin: auto">Generar credencial</button>
            <a href="{{route('student.index')}}" class="btn btn-lg btn-primary" style="margin: auto">Ir a lista de alumnos</a>
            <a href="{{route('student.crear')}}" class="btn btn-lg btn-success" style="margin: auto">Agregar <alumno></alumno></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_section')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        // Codigo js para subir imagenes /DropZone/
        Dropzone.options.myDropzone = {

            url: "{{ route('imagenes.up') }}",
            headers: {
                'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value
            },
            autoProcessQueue: true,
            uploadMultiple: false,
            parallelUploads: 20,
            maxFiles: 2,
            maxFilesize: 50,
            dictDefaultMessage: "",
            dictMaxFilesExceeded: "No puedes subir más archivos",
            dictInvalidFileType: "No se puede subir este tipo de archivo",
            dictFileTooBig: "El archivo es muy pesado",
            acceptedFiles: "image/*",

            init: function () {

                var wrapperThis = this;

                this.on("addedfile", function (file) {

                    console.log(file);

                    var removeButton = Dropzone.createElement("<button class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>");

                    removeButton.addEventListener("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        wrapperThis.removeFile(file);
                    });

                    file.previewElement.appendChild(removeButton);
                });

                this.on('sendingmultiple', function (data, xhr, formData) {

                });

                this.on("error", function (file, response) {
                    alert("error" + response);
                    console.log(response);

                    if (response == "No puedes subir más archivos") {
                        swal("¡Error!", "Solo se permite un archivo por orden", "error");
                    }
                    else if (response == "No se puede subir este tipo de archivo") {
                        swal("¡Error!", "No se puede subir este tipo de archivo", "error");
                    }
                    else if (response == "El archivo es muy pesado") {
                        swal("¡Error!", "El archivo es muy grande", "error");
                    }
                    else {
                        swal("¡Error!", "Hubo un error con su archivo", "error");
                    }
                    $('.textoAyuda').text('Error')
                    this.removeFile(file);
                    location.reload();
                });

                this.on("success", function (file, response) {
                    //console.log(response);
                    console.log(file['name']);
                    //$('#imageUrl').val(file['name']);
                    var nombre = $('#alumno_nombre').val();
                    var apellido_p = $('#alumno_apellido_p').val();
                    var apellido_m = $('#alumno_apellido_m').val();
                    $('#form_create').slideToggle();
                    $('#credencial_box span').html('<h1>El Alumno <strong>'+nombre+'&nbsp;'+apellido_p+'&nbsp;'+apellido_m+'</strong> se registro correctamente</h1>')
                    $('#credencial_box').slideToggle();
                    //  alert(response+file);
                    swal("Imagen guardada correctamente", "", "success");
                });
            }
        };
        $(document).ready(function () {
            $('#trigger_tutor').click(function () {
               $('#form-tutor').slideToggle();
            });

            $('#tutor_municipality').on('change',function () {
                var municipio= $('#tutor_municipality option:selected').val();
                var route = "{{route('colony.select')}}";
                $.ajax({
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'municipio':municipio},
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $('#tutor_colony').html('');
                        $('#tutor_cp').val('');
                      for(var i of data){
                          $('#tutor_colony').append('<option value="'+i["post_code"]+'">'+i['colony']+'</option>')
                          $('#tutor_cp').val(i['post_code']);
                      }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
            $('#tutor_colony').on('change',function () {
                var cp = $('#tutor_colony option:selected').val();
                $('#tutor_cp').val(cp);
            })
        });
        function guardar() {
            var alumno_nombre = $('#alumno_nombre').val();
            var alumno_apellido_p = $('#alumno_apellido_p').val();
            var alumno_apellido_m = $('#alumno_apellido_m').val();
            var grado = $('#Grado option:selected').val();
            var grupo = $('#Grupo option:selected').val();
            var tutor_id = $('#padre_select option:selected').val();

            var tutor_nombre = $('#tutor_nombre').val();
            var tutor_apellido_p = $('#tutor_apellido_p').val();
            var tutor_apellido_m = $('#tutor_apellido_m').val();
            var tutor_phone = $('#tutor_phone').val();
            var tutor_email = $('#tutor_email').val();

            var num_ext = $('#tutor_num_ext').val();
            var tutor_calle = $('#tutor_calle').val();

            var post_code = $('#tutor_cp').val();
            var colonia = $('#tutor_colony option:selected').text();
            var municipio = $('#tutor_municipality option:selected').val();

            var tutor_pass = Array(10).fill("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz").map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('');
           $('#passwordshow').html('<h1 style="background-color: #d1d4e7; padding: 15px;margin:auto;text-align: center;"><span style="color: #1b4b72">Contraseña:</span>&nbsp;'+tutor_pass+'</h1>')
            var route = "{{route('student.create')}}";
            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'alumno_nombre':alumno_nombre,
                    'alumno_apellido_p':alumno_apellido_p,
                    'alumno_apellido_m':alumno_apellido_m,
                    'grado':grado,
                    'grupo':grupo,
                    'tutor_id':tutor_id,
                    'tutor_nombre':tutor_nombre,
                    'tutor_apellido_p':tutor_apellido_p,
                    'tutor_apellido_m':tutor_apellido_m,
                    'tutor_phone':tutor_phone,
                    'tutor_email':tutor_email,
                    'num_ext':num_ext,
                    'tutor_calle':tutor_calle,
                    'post_code':post_code,
                    'colonia':colonia,
                    'municipio':municipio,
                    'tutor_pass':tutor_pass
                },
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    console.log('registro guardaro');
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
        function generar_credencial(){
            var route = "{{route('generate.qr')}}";
            var pdf_route = "{{route('credential.pdf')}}";
            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log('credencial');
                    console.log(data);
                    /*generar pdf de la credencial*/
                    /*$.ajax({
                        url: pdf_route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            console.log('credencial');
                            console.log(data);


                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });*/
                    window.location.href = pdf_route;
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    </script>
@endsection
