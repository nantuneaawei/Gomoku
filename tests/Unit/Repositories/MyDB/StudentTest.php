<?php

namespace Tests\Unit\Repositories\MyDB;

use App\Models\MyDB\Student as StudentModel;
use App\Repositories\MyDB\Student as StudentRepositories;
use Mockery;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    /**
     * testGetStudentAll 取得全部學生名單
     *
     * @return void
     */
    public function testGetStudentAll()
    {
        $aStudentList = [
            0  => [
                'student_id'    => 1,
                'student_name'  => 'John',
                'student_birth' => '1995-05-21',
                'student_sex'   => '男',
            ],
            1  => [
                'student_id'    => 2,
                'student_name'  => 'Peter',
                'student_birth' => '1992-11-11',
                'student_sex'   => '男',
            ],
            2  => [
                'student_id'    => 3,
                'student_name'  => 'John',
                'student_birth' => '1995-05-21',
                'student_sex'   => '男',
            ],
            3  => [
                'student_id'    => 4,
                'student_name'  => 'Alice',
                'student_birth' => '1994-05-21',
                'student_sex'   => '女',
            ],
            4  => [
                'student_id'    => 5,
                'student_name'  => 'Mandy',
                'student_birth' => '1985-02-11',
                'student_sex'   => '女',
            ],
            5  => [
                'student_id'    => 6,
                'student_name'  => 'Alice',
                'student_birth' => '1994-04-21',
                'student_sex'   => '女',
            ],
            6  => [
                'student_id'    => 14,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            7  => [
                'student_id'    => 15,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            8  => [
                'student_id'    => 16,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            9  => [
                'student_id'    => 17,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            10 => [
                'student_id'    => 21,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            11 => [
                'student_id'    => 23,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
        ];
        $oStudentModel = Mockery::mock(StudentModel::class);
        $oStudentModel->shouldReceive('get')
            ->andReturn(Mockery::self())
            ->shouldReceive('toArray')
            ->withAnyArgs()
            ->andReturn($aStudentList);

        $aExpected = [
            0  => [
                'student_id'    => 1,
                'student_name'  => 'John',
                'student_birth' => '1995-05-21',
                'student_sex'   => '男',
            ],
            1  => [
                'student_id'    => 2,
                'student_name'  => 'Peter',
                'student_birth' => '1992-11-11',
                'student_sex'   => '男',
            ],
            2  => [
                'student_id'    => 3,
                'student_name'  => 'John',
                'student_birth' => '1995-05-21',
                'student_sex'   => '男',
            ],
            3  => [
                'student_id'    => 4,
                'student_name'  => 'Alice',
                'student_birth' => '1994-05-21',
                'student_sex'   => '女',
            ],
            4  => [
                'student_id'    => 5,
                'student_name'  => 'Mandy',
                'student_birth' => '1985-02-11',
                'student_sex'   => '女',
            ],
            5  => [
                'student_id'    => 6,
                'student_name'  => 'Alice',
                'student_birth' => '1994-04-21',
                'student_sex'   => '女',
            ],
            6  => [
                'student_id'    => 14,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            7  => [
                'student_id'    => 15,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            8  => [
                'student_id'    => 16,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            9  => [
                'student_id'    => 17,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            10 => [
                'student_id'    => 21,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
            11 => [
                'student_id'    => 23,
                'student_name'  => 'Peter',
                'student_birth' => '1996-12-21',
                'student_sex'   => '男',
            ],
        ];
        $oStudent = new StudentRepositories($oStudentModel);
        $aActual  = $oStudent->getStudentAll($aStudentList);
        $this->assertEquals($aExpected, $aActual);
    }
}
