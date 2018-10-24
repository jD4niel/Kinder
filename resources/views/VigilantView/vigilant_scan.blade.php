@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center" id="camara" style="background-color: #5058b0;padding: 20px;">
            <video style="background-color: white; margin: auto;" id="preview"></video>
        </div>
        <div class="row" id="datos" style="display: none; background-color: #1b4b72;padding-top: 30px;">
            <br>
            <div class="form-group col-md-12 text-center">
                <label for="nombre" class="h3" style="color: white">Nombre:</label>
                <div class="form-group col-md-12">
                    <input type="text" id="id_student" hidden>
                    <input type="text" id="nombre" class="form-control" value="">
                </div>
            </div>

            <div class="form-group col-md-12 text-center">
                <label for="tutor" class="h3" style="color: white">Tutor:</label>
                <div class="input-group mb-3">
                    <input type="text" id="tutor" class="form-control" value="">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button">Designar tutor</button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12 text-center">
                <label for="nombre" class="h3" style="color: white">Hora entrada:</label>
                <div class="form-group col-md-12">
                    <input type="text" id="hora_entrada" class="form-control" value="">
                </div>
            </div>
            <div class="form-group col-md-12 text-center">
                <label for="observaciones" class="h3" style="color: white">Observaciones:</label>
                <div class="form-group col-md-12">
                    <textarea name="" class="form-control" id="observaciones" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row text-center col-md-8" style="margin: auto;padding-bottom: 20px;">
                <button id="registrar_entrada" onclick="registrar()" class="btn btn-block btn-lg btn-warning" style="width: 100%;position:fixed;font-weight: bold;margin: auto;bottom: 0px;left: 0px;">REGISTRAR ENTRADA</button>
            </div>
        </div>
    </div>


@endsection
@section('script_section')
    <script src="https://rawgit.com/cirocosta/qcode-decoder/master/build/qcode-decoder.min.js"></script>
    <script src="{{ asset('js/instascan.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            scanner.addListener('scan', function (content) {
                console.log(content);
                //alert(content);
                var route = "{{route('registry.data')}}";
                $.ajax({
                    url: route,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id':content,
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#id_student').val(data[0]["id"]);
                        alert( $('#id_student').val());
                        $('#nombre').val(data[0]["name"]+' '+data[0]["last_name"]+' '+data[0]["second_last_name"]);
                        $('#tutor').val(data[1]["name"]+' '+data[1]["last_name"]+' '+data[1]["second_last_name"]);
                        $('#hora_entrada').val(data[2]);
                        $('#camara').toggle('slow');
                        $('#datos').toggle('slow');
                    },
                    error: function (data) {
                        console.log(data);

                    }
                });
            });
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });
        });
        function registrar() {
            var id = $('#id_student').val();
            alert(id);
            var route = "{{route('store.entry')}}";
            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id':id,
                },
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    /*$('#id_student').val(data["id"]);
                    $('#nombre').val(data[0]["name"]+' '+data[0]["last_name"]+' '+data[0]["second_last_name"]);
                    $('#tutor').val(data[1]["name"]+' '+data[1]["last_name"]+' '+data[1]["second_last_name"]);
                    $('#hora_entrada').val(data[2]);*/
                    $('#camara').toggle('slow');
                    $('#datos').toggle('slow');
                },
                error: function (data) {
                    console.log(data);

                }
            });
        }
    </script>
    {{--<script>
        var qr = new QCodeDecoder();
        var video = document.querySelector('video');
        var reset = document.querySelector('#reset');
        var stop = document.querySelector('#stop');

        function resultHandler(err, result) {
            console.log('entra');
            if (err) return console.log(err.message);
            alert(result);
            console.log(result)
        }

        qr.decodeFromCamera(video, resultHandler);

        reset.onclick = function () {
            qr.decodeFromCamera(video, resultHandler);
        };

        stop.onclick = function () {
            qr.stop();
        };
    </script>--}}
@endsection
