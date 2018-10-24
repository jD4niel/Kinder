<?php

namespace App\Http\Controllers;

use App\Registry;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VigilantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('VigilantView/vigilant_scan');
    }

    public function dataRead(Request $request){
        $now=Carbon::now();
        $hora=$now->hour;
        $minuto=$now->minute;
        $entrada=$hora.":".$minuto;
        $student=Student::findOrFail($request->id);
        $tutor=User::findOrFail($student->user_id);
        return response()->json([$student,$tutor,$entrada]);
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
        $student=Student::findOrFail($request->id);
        $tutor=User::findOrFail($student->user_id);
        $registry = new \App\Registry;
        $registry-> student_id=$request->id;
        $registry-> vigilante=Auth::user()->id;
        $registry-> tutor=$tutor->id;

        $registry->save();
        return ($request->id);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
