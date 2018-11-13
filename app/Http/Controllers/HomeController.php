<?php

namespace App\Http\Controllers;

use App\Registry;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function dataUpdate(){
        $faltantes=DB::table('students')
            ->leftJoin('registries','registries.student_id','=','students.id')
            ->whereDate('registries.created_at', Carbon::today())
            ->orWhereNull('registries.id')->get()->count();
        $ingresados=Registry::whereDate('created_at', Carbon::today())->get()->count();
        return response()->json([$faltantes,$ingresados]);
    }
}
