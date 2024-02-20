<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\User;
use App\CourseClass;

class UserImportClass implements ToModel
{
    private $importStatus = true;

    public $allImportedUsers = [];

    public function model(array $row)
    {
        $userNames = User::pluck('name');
        if(strtolower($row[0]) == 'name'){
            return null;
        }
        else if(strtolower($row[4]) != '' && strtolower($row[5]) == 'formando'){
            foreach($userNames as $userName){
                if(strtolower($row[0]) == strtolower($userName)){
                    return null;
                }
            }
            $courseClassId = CourseClass::where('description', $row[4])->first()->id;

            $importedUser = new User([
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
            array_push($this->allImportedUsers, $importedUser);

            return $importedUser;
        }
        else if(strtolower($row[5]) == 'formador'){

            $importedUser = new User([
                'name' => $row[0],
                'username' => $row[1],
                'email' => $row[2],
                'contact' => $row[3],
                'password' => 'temporary',
                'notes' => '',
                'isActive' => 1,
                'isStudent' => 0,
                'course_class_id' => null,
                'role_id' => 1,
            ]);
            array_push($this->allImportedUsers, $importedUser);

            return $importedUser;
        }
        else if(strtolower($row[5]) == 'tecnico'){
            $importedUser = new User([
                'name' => $row[0],
                'username' => $row[1],
                'email' => $row[2],
                'contact' => $row[3],
                'password' => 'temporary',
                'notes' => '',
                'isActive' => 1,
                'isStudent' => 0,
                'course_class_id' => null,
                'role_id' => 4,
            ]);
            array_push($this->allImportedUsers, $importedUser);

            return $importedUser;
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
