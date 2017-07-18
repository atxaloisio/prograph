<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use Mail;

class sinc_erp extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:syncerp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para sincronização de pedidos com ERP integrado';
    private $users = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        $from = Carbon::yesterday();
        $to = Carbon::today();

        $this->users = User::whereBetween('created_at', [$from, $to])->get();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        //
        Mail::raw('Text to e-mail', function ($message) {
            //
            $message->from('webmaster@atxsoftware.com.br', 'Laravel');

            $message->to('atxaloisio@gmail.com')->cc('atxaloisio@hotmail.com');
        });
    }

}
