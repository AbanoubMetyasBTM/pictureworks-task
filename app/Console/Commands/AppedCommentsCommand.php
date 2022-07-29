<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppedCommentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comment:append {id} {comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        /**
         * @var $request Request
         */

        $id                  = $this->argument("id");
        $request             = app('request');
        $request["id"]       = $id;
        $request["password"] = "not required";
        $request["comments"] = $this->argument("comment");

        $matchRequest        = $request->create("/user/$id/update-comments","POST");
        $route               = app('router')->getRoutes()->match($matchRequest);

        echo App::call($route->action["controller"]);

        return 0;
    }
}
