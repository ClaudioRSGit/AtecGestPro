<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\User;
use Maatwebsite\Excel\Concerns\WithUpserts;

class YourImportClass implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if(strtolower($row[0]) == 'name'){
            return null;
        }
        else if(strtolower($row[4]) != '' && strtolower($row[5]) == 'formando'){
            $courseClassId = \App\CourseClass::where('description', $row[4])->first()->id;
            return new User([
                'name' => $row[0],
                'username' => $row[1],
                'email' => $row[2],
                'contact' => $row[3],
                'password' => null,
                'notes' => null,
                'isActive' => 1,
                'isStudent' => 1,
                'course_class_id' => $courseClassId,
                'role_id' => 3,
            ]);
        }
        else if(strtolower($row[5]) == 'formador'){
            return new User([
                'name' => $row[0],
                'username' => $row[1],
                'email' => $row[2],
                'contact' => $row[3],
                'password' => 'temporary',
                'notes' => null,
                'isActive' => 1,
                'isStudent' => 0,
                'course_class_id' => null,
                'role_id' => 2,
            ]);
        }
        else if(strtolower($row[5]) == 'tecnico'){
            return new User([
                'name' => $row[0],
                'username' => $row[1],
                'email' => $row[2],
                'contact' => $row[3],
                'password' => 'temporary',
                'notes' => null,
                'isActive' => 1,
                'isStudent' => 0,
                'course_class_id' => null,
                'role_id' => 4,
            ]);
        }
    }
}
