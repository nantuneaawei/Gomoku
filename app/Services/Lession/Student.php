<?php

namespace App\Services\Lession;

use App\Repositories\MyDB\Student as StudentRepositories;

class Student
{
    public function handleStudentList(StudentRepositories $_oStudentRepositories)
    {
        $aStudent = $_oStudentRepositories->getStudentAll();
        return $aStudent;
    }
}
