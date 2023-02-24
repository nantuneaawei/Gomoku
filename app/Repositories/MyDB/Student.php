<?php

namespace App\Repositories\MyDB;

use App\Models\MyDB\Student as StudentModel;

class Student
{
    private $oStudentModel;

    public function __construct(StudentModel $_oStudentModel)
    {
        $this->oStudentModel = $_oStudentModel;
    }

    public function getStudentAll()
    {
       $aStudent = $this->oStudentModel->get()->toArray();
       return $aStudent;
    }
}
