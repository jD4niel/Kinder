@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form">
                <div class="form-group">
                    <input type="text" id="nombre" class="form-control" value="">
                </div>
                <div class="form-group">
                    <input type="text" id="apellido_p" class="form-control" value="">
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script_section')

    <script type="text/javascript">
        $(document).ready(function () {

        });

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
