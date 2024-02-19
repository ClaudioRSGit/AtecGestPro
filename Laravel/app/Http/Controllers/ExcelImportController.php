<?php

namespace App\Http\Controllers;

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
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Create an instance of UserImportClass
        $userImport = new UserImportClass;

        // Process the Excel file
        Excel::import($userImport, $file);

        // Check the import status
        if ($userImport->getImportStatus()) {
            $message = 'Utilizadores importados com sucesso!';
        } else {
            $message = 'Ocorreu um problema ao importar os utilizadores. Por favor, tente novamente.';
        }

        $users = User::paginate(5);

        if ($request->ajax()) {
            return view('users.partials.index', ['users' => $users, 'message' => $message]);
        }

        return view('excel.excel-index', ['users' => $users, 'message' => $message]);
    }



    public function importStudents(Request $request)
    {
        if ($request->has('withStudents')) {

            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            // Get the uploaded file
            $file = $request->file('file');

            Excel::import(new StudentImportClass, $file);

            return view('excel.studentsSuccess');
        } else {
            return redirect()->route('course-classes.index')->with('success', 'Turma criada com sucesso sem alunos!');
        }
    }
}
