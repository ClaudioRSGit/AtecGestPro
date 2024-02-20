<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\User;
use App\CourseClass;

class StudentImportClass implements ToModel
{
    private $importStatus = true;

    public $allImportedStudents = [];

    public function model(array $row)
    {
        if(strtolower($row[0]) == 'name'){
            return null;
        }
        else if(strtolower($row[0]) != '' && strtolower($row[0]) != null){
            $courseClasses = CourseClass::all();
            $courseClassId = $courseClasses->count() - 1;

            $importedStudent = new User([
                'name' => $row[0],
                'username' => $row[1],
                'email' => $row[2],
                'contact' => $row[3],
                'password' => null,
                'notes' => '',
                'isActive' => 1,
                'isStudent' => 1,
                'course_class_id' => $courseClassId,
                'role_id' => 3,
            ]);
            array_push($this->allImportedStudents, $importedStudent);

            return $importedStudent;
        }

        dd($row);
        $this->importStatus = false;

        return null;
    }

    public function getImportStatus()
    {
        return $this->importStatus;
    }
}
