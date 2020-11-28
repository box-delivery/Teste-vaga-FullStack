<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\Movies\Services\ImportMovieService;

class ImportMovieCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:movies {--l|limit=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import movie list';

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
    public function handle(ImportMovieService $service)
    {
        $limit = $this->option('limit');
        $service($limit);
        return 0;
    }
}
