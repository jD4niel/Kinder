@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h1 class="h1">CREAR USUARIO</h1>
    </div>
    <hr>
    <div class="row">
    <form action="" class="col-md-6">
        <div class="form-group">
            <label class="h4" for="nombre">Nombre:</label>
            <input class="form-control" id="nombre" type="text">
        </div>
        <div class="form-group">
            <label class="h4" for="apellido_p">Apellido paterno:</label>
            <input class="form-control" id="apellido_p" type="text">
        </div>
        <div class="form-group">
            <label class="h4" for="apellido_m">Apellido materno:</label>
            <input class="form-control" id="apellido_m" type="text">
        </div>
        <div class="form-inline">
            <label class="h4" for="grado">Grado:</label>
            <input class="form-control" id="grado" type="text">
            <label class="h4" for="grupo">Grupo:</label>
            <input class="form-control" id="grupo" type="text">
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block form-control" value="Registrar Alumno">
        </div>
    </form>
        <div class="col-md-6 text-center">
            <h3>Agregar Imagen</h3>
            {{--dropzone para subir imagenes--}}
            <div class="control-label col-md-12" id="drop" >
                <div class="dropzone dropzone-file-area" id="my-dropzone" style="width: 100%; height: 350px; margin-top: 50px; border-width: 4px; border-color: rgb(54, 198, 211);">
                    <h3 class="sbold">Arrastre aquí su archivo para adjuntarlo</h3>
                    <div class="fallback">
                        <input name="file" type="file" id="file_" multiple >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <br><br><button id="submit" class="btn blue  btn-block" ><i class="fa fa-upload"></i>Subir</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_section')
    <script>
        // Codigo js para subir imagenes /DropZone/
        Dropzone.options.myDropzone = {

            url: "{{ route('imagenes.up') }}",
            headers: {
                'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value
            },
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 2,
            maxFiles: 20,
            maxFilesize: 50,
            dictDefaultMessage: "",
            dictMaxFilesExceeded: "No puedes subir más archivos",
            dictInvalidFileType: "No se puede subir este tipo de archivo",
            dictFileTooBig: "El archivo es muy pesado",
            acceptedFiles: "image/*",

            init: function () {

                var wrapperThis = this;
                var submitButton = document.querySelector("#submit");

                submitButton.addEventListener("click", function () {
                    wrapperThis.processQueue();
                });

                this.on("addedfile", function (file) {

                    console.log();

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

                    this.removeFile(file);
                });

                this.on("success", function (file, response) {
                    console.log(response);
                    swal("Solicitud enviada correctamente!", "", "success");
                });
            }
        };
    </script>
@endsection
