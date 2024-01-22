<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\User;
use App\CourseClass;

class StudentImportClass implements ToModel
{
    public function model(array $row)
    {
        if(strtolower($row[0]) == 'name'){
            return null;
        }
        else if($row[0] != null){
            $courseClasses = CourseClass::all();
            $courseClassId = $courseClasses->count() - 1;

            return new User([
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
        }
    }
}
