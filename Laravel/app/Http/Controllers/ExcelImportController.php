<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourImportClass;
use App\User;

class ExcelImportController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new YourImportClass, $file);

        $users = User::paginate(5);

        if ($request->ajax()) {
            return view('users.partials.index', ['users' => $users]);
        }

        return view('excel-index', ['users' => $users]);
    }
}
