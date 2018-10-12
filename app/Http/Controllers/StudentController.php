<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;

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
        //
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
    public function uploadImg(Request $request){
        DB::beginTransaction();
        try{

            $data = $request->all();
            dd($data);

            foreach ($data["file"] as $file) {

                $attr = exif_read_data($file);
                $size = getimagesize($file, $info);

                if(isset($info['APP13']))
                {
                    $iptc = iptcparse($info['APP13']);
                }

                $byLineTittle = implode(" <br> " , $iptc['2#085']);
                $objectName = implode(" <br> " , $iptc['2#005']);
                $keywords = implode(" <br> " , $iptc['2#025']);
                $f_today = new Carbon();
                $f_year = $f_today->year;
                $f_month = $f_today->month;
                $f_day = $f_today->day;
                $filename_img = $file->getClientOriginalName();
                $mime = $file->getMimeType();
                $fechaDir = $f_year . '/' . $f_month . '/' . $f_day;

                if (($mime == 'image/jpeg') || ($mime == 'image/jpg' ) || ($mime == 'image/png')) {

                    $destinationPath = public_path() . '/Repositorio/fotos/' . $fechaDir;
                    $destinationPath2 = public_path() . '/Repositorio/thumbs/' . $fechaDir;
                    $filename_img = $file->getClientOriginalName();
                    $filename_img2 = $file->getClientOriginalName(). 'thumbnail.';
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true);
                    }
                    if (!File::exists($destinationPath2)) {
                        File::makeDirectory($destinationPath2, 0755, true);
                    }
                    $destinationPath1 = $destinationPath . '/' . $filename_img;
                    $destinationPath2 = $destinationPath2 . '/' . $filename_img;

                    copy($file, $destinationPath1);
                    $image = \Image::make($destinationPath1);
                    $image->fit(256, 144);

                    $image->save($destinationPath2);


                    $foto = new Datapic();
                    $foto->caption = $attr['ImageDescription'];
                    $foto->writer = $attr['Artist'];
                    $foto->headline = 'NULL';
                    $foto->writer = $attr['Artist'];
                    $foto->byline = $attr['Artist'];
                    $foto->byline_title = $byLineTittle;
                    $foto->objectname = $objectName;
                    $foto->prioridad = 0;
                    $foto->directorio = $fechaDir;
                    $foto->nombre = $file->getClientOriginalName();
                    $foto->fecha_in = $f_today;
                    $foto->publicada = 0;
                    $foto->fecha_crea = $attr['DateTimeDigitized'];
                    $foto->keywords = $keywords;
                    $foto->tipo_medio = 1;
                    $foto->save();
                    //  return "foto" . $foto;
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

}
