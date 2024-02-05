<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Material;
use App\MaterialUser;
use App\Ticket;

class HardDeleteOldRecords extends Command
{



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hardDelete:softDeletedRecords';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apaga permanentemente os registos apagados há mais de 6 meses.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return true
     */
    public function handle(): bool
    {
        $sixMonthsAgo = now()->subMonths(6);

        User::onlyTrashed()
            ->where('deleted_at', '<=', $sixMonthsAgo)
            ->forceDelete();

        Material::onlyTrashed()
            ->where('deleted_at', '<=', $sixMonthsAgo)
            ->forceDelete();

        Ticket::onlyTrashed()
            ->where('deleted_at', '<=', $sixMonthsAgo)
            ->forceDelete();



        $this->info('Os registos apagados à mais de 6 meses foram apagados permanentemente.');

        return true;
    }


}
