<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImportClass;
use App\Imports\StudentImportClass;
use App\User;

class ExcelImportController extends Controller
{
    public function index()
    {
        return view('excel.importStudents');
    }

    public function importUsers(Request $request)
    {
        try{

            // Validate the uploaded file
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);


        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Erro ao inserir utilizadores. Por favor, tente novamente.');
        }

        // Get the uploaded file
        $file = $request->file('file');

        // Create an instance of UserImportClass
        $userImport = new UserImportClass;

        // Process the Excel file
        Excel::import($userImport, $file);

        $importedUsers = $userImport->allImportedUsers;


        // Check the import status
        if ($userImport->getImportStatus()) {
            $message = 'Utilizadores importados com sucesso!';
        } else {
            $message = 'Ocorreu um problema ao importar os utilizadores. Por favor, tente novamente.';
        }

        $users= $importedUsers;

        if ($request->ajax()) {
            return view('users.partials.index', ['users' => $users, 'message' => $message]);
        }

        return view('excel.excel-index', ['importedUsers' => $importedUsers, 'message' => $message]);
    }



    public function importStudents(Request $request)
    {

//        dd($request->all());
        if ($request->has('withStudents')) {

            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            // Get the uploaded file
            $file = $request->file('file');

            $studentImport = new StudentImportClass;

            Excel::import($studentImport, $file);

            $importedStudents = $studentImport->allImportedStudents;



            if (empty($importedStudents)) {
                $message = 'Não foram encontrados alunos para importar!';
                $emptyStudents = true;
            } else {
                $message = 'Alunos importados com sucesso!';
                $emptyStudents = false;
            }


            $users= $importedStudents;
            $courses = Course::all();

            $students = User::where('isStudent', 1)->whereNull('course_class_id')->get();



            if (empty($importedStudents)){
                return view('excel.studentsSuccess', ['users' => $users, 'message' => $message], compact('courses', 'students', 'emptyStudents', 'importedStudents'));
           } else {
                return view('excel.studentsSuccess', ['importedStudents' => $importedStudents, 'message' => $message, 'emptyStudents' => $emptyStudents]);
              }

        } else {
            return redirect()->route('course-classes.index')->with('success', 'Turma criada com sucesso sem alunos!');
        }
    }
}
