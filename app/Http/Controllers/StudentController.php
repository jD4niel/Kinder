<?php

namespace App\Http\Controllers;

use App\Address;
use App\Colony;
use App\Credentials;
use App\Student;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
//use Dompdf\Exception;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
//use FontLib\Table\Type\name;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use LaravelQRCode\Facades\QRCode;
use QR_Code\QR_Code;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::get(); //entonces me equivoque los belong to es alrevez
        $padre = User::where('role_id',3)->get();
        $tutor_sustituto = User::where('role_id',2)->get();
       // dd($student->student);
        return view('AdminView/admin_student',compact('student','tutor_sustituto','padre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request;
        if($data->tutor_id==0){
            $colony_get_id = Colony::select('id')->where('post_code','=',$data->post_code)->where('colony','=',$data->colonia)->where('municipality','=',$data->municipio)->get();

            $address = new \App\Address;
            $address->num_ext=$data->num_ext;
            $address->street=$data->tutor_calle;
            $address->colony_id=$colony_get_id[0]['id'];
            $address->save();
            $last_address_id = Address::select('id')->max('id');

            $contraseña=Hash::make($data->tutor_pass);

            $tutor = new \App\User;
            $tutor->name = $data->tutor_nombre;
            $tutor->last_name = $data->tutor_apellido_p;
            $tutor->second_last_name = $data->tutor_apellido_m;
            $tutor->phone_number = $data->tutor_phone;
            $tutor->email = $data->tutor_email;
            $tutor->password = $contraseña;
            $tutor->role_id=3;
            $tutor->address_id=$last_address_id;
            $tutor->save();
            $last_tutor_id = User::select('id')->max('id');

            $student = new \App\Student;
            $student->name = $data->alumno_nombre;
            $student->last_name = $data->alumno_apellido_p;
            $student->second_last_name = $data->alumno_apellido_m;
            $student->degree = $data->grado;
            $student->group = $data->grupo;
            $student->user_id = $last_tutor_id[0]['id'];
            $student->save();
        }
        else {
            $student = new \App\Student;
            $student->name = $data->alumno_nombre;
            $student->last_name = $data->alumno_apellido_p;
            $student->second_last_name = $data->alumno_apellido_m;
            $student->degree = $data->grado;
            $student->group = $data->grupo;
            $student->user_id = $data->tutor_id;
            $student->save();
        }
        return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request;

        $student = Student::findOrFail($id);
        $student->name = $data->nombre;
        $student->last_name = $data->apellido_p;
        $student->second_last_name = $data->apellido_m;
        $student->degree = $data->grado;
        $student->group = $data->grupo;
        $student->save();

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::destroy($id);
        return response()->json($student);
    }
    public function createView(){
        $user = User::all();
        $colony = Colony::all();
        $municipality = Colony::select('municipality')->groupBy('municipality')->get();
        return view('AdminView/admin_create_student',compact('user','colony','municipality'));
    }
    public function fillSelect(Request $request){
        $colony=Colony::where('municipality',$request->municipio)->get();
        return response()->json($colony);
    }
    public function uploadImg(Request $request){

        DB::beginTransaction();
        try{

            $data = $request->all();
            foreach ($data["file"] as $file) {
                $attr = exif_read_data($file);
                $filename_img = $file->getClientOriginalName();
                $mime = $file->getMimeType();

                if (($mime == 'image/jpeg') || ($mime == 'image/jpg' ) || ($mime == 'image/png') || ($mime == 'image/.png')) {

                    $destinationPath = public_path() . '/images';
                    $filename_img = $file->getClientOriginalName();
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true);
                    }
                    $destinationPath1 = $destinationPath . '/' . $filename_img;

                    copy($file, $destinationPath1);
                } else {
                    return "Tipo de archivo invalido mime: " . $mime;
                    abort(500);
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            return $e;
        }
        DB::commit();

    }
    public function makeQR(){
        $last_student = Student::select('id')->max('id');
        $id_alumno = $last_student;
        $alumno=Student::find($id_alumno);
        $QR_name = $id_alumno.'_'.$alumno->name.'_'.$alumno->last_name.'.png';

        $alumno->qr_code=$QR_name;
        $alumno->save();

        $file=public_path('images/qr_codes/'.$QR_name);
        \QRCode::text($QR_name)->setOutfile($file)->png();
         return response()->json($alumno);
    }

}
