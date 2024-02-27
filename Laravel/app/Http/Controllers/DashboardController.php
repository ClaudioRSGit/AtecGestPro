<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use App\User;
use App\CourseClass;
use App\Ticket;
use App\Course;
use App\Partner;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {

        if (auth()->user()->hasRole('tecnico')) {
            abort(403, 'Acesso não autorizado.');
        }

        //User
        $adminCount = User::where('role_id', 1)->count();
        $technicianCount = User::where('role_id', 2)->count();
        $employeeCount = User::where('role_id', 3)->count();
        $traineeCount = User::where('role_id', 4)->count();
        $partnerCount = Partner::count();
        $activeUserCount = User::where('isActive', true)->count();
        $inactiveUserCount = User::where('isActive', false)->count();

        //other
        $traningsCount = CourseClass::count();
        $coursesCount = Course::count();
        $externalTrainingsCount = DB::table('partner_training_users')->count();
        $usersWithMaterialsDelivered  = User::whereDoesntHave('materialUsers', function ($query) {
            $query->where('delivered_all', true);
        })
        ->where('username', '<>', '')
        ->where('name', '!=', 'Utilizador Padrao')
        ->where('name', '!=', 'Fila de Espera')
        ->where('role_id', '!=', '1')
        ->where('role_id', '!=', '4')
        ->get();

        //Material
        $internalMaterialCount = DB::table('materials')->where('isInternal', true)->count();
        $externalMaterialCount = DB::table('materials')->where('isInternal', false)->count();

        //Tickets
        $openedTicketsCount = DB::table('tickets')->where('ticket_status_id', 1)->count();
        $inProgressTicketsCount = DB::table('tickets')->where('ticket_status_id', 2)->count();
        $pendingTicketsCount = DB::table('tickets')->where('ticket_status_id', 3)->count();
        $solvedTicketsCount = DB::table('tickets')->where('ticket_status_id', 4)->count();
        $closedTicketsCount = DB::table('tickets')->where('ticket_status_id', 5)->count();
        $totalTicketsCount = DB::table('tickets')->count();

        $currentYear = date('Y');
        $startDateCounts = DB::table('partner_training_users')
            ->select(DB::raw('MONTH(start_date) as month'), DB::raw('count(*) as count'))
            ->whereYear('start_date', $currentYear)
            ->groupBy('month')
            ->get()
            ->keyBy('month')
            ->toArray();


        $months = range(1, 12);
        $counts = array_fill(0, 12, 0);

        foreach ($months as $month) {
            if (isset($startDateCounts[$month])) {
                $counts[$month - 1] = $startDateCounts[$month]->count;
            }
        }

        $chartDataStartDate = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => $counts,
        ];


        return view ('dashboard.index',
        compact('adminCount',
        'technicianCount',
        'employeeCount',
        'traineeCount',
        'partnerCount',
        'activeUserCount',
        'inactiveUserCount',
        'usersWithMaterialsDelivered',
        'internalMaterialCount',
        'externalMaterialCount',
        'openedTicketsCount',
        'inProgressTicketsCount',
        'pendingTicketsCount',
        'solvedTicketsCount',
        'closedTicketsCount',
        'totalTicketsCount',
        'chartDataStartDate',
        'traningsCount',
        'coursesCount',
        'externalTrainingsCount'
    ));
    }
}
