<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
   </head>
<body>
            <table style="width: 100%;height: 300px;" border="1">
                <tbody>
                <tr>
                    <td  width="50%">
                        <div style="float: top; background-color: #1b4b72;width: 100%;height: 65px;">
                           <div style="color: #fff;font-family:Arial, Helvetica, sans-serif;margin-left: 10px;font-size: 25px;"><span style="position: absolute;top:15px;">Jardín de niños  </span><img style="height: 65px;width: auto;float: right" src="{{ public_path()}}/images/escudo.jpg" alt=""></div>

                        </div>
                        <div style="position: absolute;top:100px;background: #fff;padding: 10px;width: 100%">
                            <div style="display: inline-block;width:70%;bottom: 250px;">
                                <div style="font-family:Arial, Helvetica, sans-serif;padding: 10px; background-color: #e4e4e4;border-radius: 15px;"><Strong>ALUMNO:&nbsp;</Strong>{{$student->name}}&nbsp;{{$student->last_name}}&nbsp;{{$student->second_last_name}}</div>
                                <div style="font-family:Arial, Helvetica, sans-serif;padding: 10px; background-color: #e4e4e4;border-radius: 15px;margin-top:5px;"><Strong>TUTOR:&nbsp;</Strong>{{$student->user->name}}&nbsp;{{$student->user->last_name}}&nbsp;{{$student->user->second_last_name}}</div>
                                <div style="margin-top: 10px">
                                    <div style="font-family:Arial, Helvetica, sans-serif;padding: 10px; background-color: #e4e4e4;border-radius: 15px;display: inline-block"><Strong>Grado:&nbsp;</Strong>{{$student->degree}}</div>
                                    <div style="font-family:Arial, Helvetica, sans-serif;padding: 10px; background-color: #e4e4e4;border-radius: 15px;display: inline-block"><Strong>Grupo:&nbsp;</Strong>"{{$student->group}}"</div>
                                </div>
                            </div>
                            <div style="display: inline-block;padding-left: 15px;">
                                <img style="height: 100px;width: auto;margin-top: 50px" src="{{ public_path()}}/images/imagen.jpg" alt="">
                            </div>

                        </div>
                        <div style="position:absolute;top:265px;float: bottom; background-color: #b6cade;width: 100%;height: 30px;">
                            <span style="color: #2a4353;font-family:Arial, Helvetica, sans-serif;position: absolute;top:10px;">Ciclo escolar {{$now->year}}-{{$agno}}</span>
                                <span style="color: #2a4353;font-family:Arial, Helvetica, sans-serif;position: absolute;top:10px;float: right;">Fecha de expedición: {{$fecha}}</span>
                        </div>
                    </td>
                    <td width="50%">
                        <img width="200px" src="{{public_path()}}/images/qr_codes/{{$student->qr_code}}" alt="">
                    </td>
                </tr>
                </tbody>
            </table>
</body>
</html>

