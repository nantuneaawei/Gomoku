<?php

namespace App\Http\Controllers\Lession;

use App\Http\Controllers\Controller;
use App\Repositories\MyDB\Student as StudentRepositories;
use App\Services\Lession\Student as StudentServices;

class Student extends Controller
{
    private $oStudentServices;
    private $oStudentRepositories;

    public function __construct(StudentServices $_oStudentServices, StudentRepositories $_oStudentRepositories)
    {
        $this->oStudentServices     = $_oStudentServices;
        $this->oStudentRepositories = $_oStudentRepositories;
    }

    public function get()
    {
        $aStudent = $this->oStudentServices->handleStudentList($this->oStudentRepositories);
        return view('lession.student', ['data' => $aStudent]);
    }
}
