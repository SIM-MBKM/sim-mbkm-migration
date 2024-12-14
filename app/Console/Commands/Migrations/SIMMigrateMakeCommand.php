<?php

namespace App\Console\Commands\Migrations;

use App\Libraries\Database\Migrations\MigrationCreator;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SIMMigrateMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     * example usage:
     * - php artisan sim:mm user users -c   | create new sim_users.users table
     * - php artisan sim:mm registration mbkm | update sim_registration.mbkm table
     * - php artisan sim:mm user users --column=status | update status column in sim_user.users table
     * @var string
     */
    protected $signature = 'sim:mm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mm = make migration - Make a new migration file for SIM MKMB environment';

    protected $creator;
    protected $composer;
    protected $migrationBaseDir;
    /**
 * Execute the console command.
     */

    public function __construct(MigrationCreator $creator, Composer $composer) 
    {
        parent::__construct();

        $this->addArgument('db_conn', InputArgument::REQUIRED, 'the database connection (see: config/database.php) > connections');
        $this->addArgument('table', InputArgument::REQUIRED, 'the table name');
        $this->addOption('create', 'c', InputOption::VALUE_NONE, 'for creating new table');
        $this->addOption('column', null, InputOption::VALUE_REQUIRED, 'for focused column');
        $this->addOption('index', null, InputOption::VALUE_REQUIRED, 'for focused index');

        $this->creator = $creator;
        $this->composer = $composer;
        $this->migrationBaseDir = config('database.Mv1.base_dir');
    }

    public function handle()
    {
        $table = Str::snake(trim($this->argument('table')));

        // Disable the columns option for specific condition
        if ($this->option('create')) {
            $this->input->setOption('column', null);
            $this->input->setOption('index', null);
        } elseif ($this->option('column')) {
            $this->input->setOption('create', false);
            $this->input->setOption('index', null);
        } elseif ($this->option('index')) {
            $this->input->setOption('create', false);
            $this->input->setOption('column', null);
        }

        $this->ensureMainDirExists();

        $file = $this->writeMigration($table);

        shell_exec('code' . $this->getMigrationPath() . '/' . $file . '.php');

        $this->composer->dumpAutoloads();
    }

    protected function writeMigration($table) 
    {
        $file = pathinfo($this->creator->create(
            $this->argument('db_conn'),
            $this->getMigrationPath(),
            $table,
            $this->option('column'),
            $this->option('index'),
            $this->option('create')
        ), PATHINFO_FILENAME);

            $this->line("<info>Created Migration:</info> {$file}");

            return $file;
    }

    protected function getMigrationPath()
    {
        return $this->laravel->basePath() . '/' . $this->migrationBaseDir . '/' . $this->argument('db_conn');
    }

    protected function ensureMainDirExists() 
    {
        $basePath = $this->migrationBaseDir;

        if (! $this->creator->getFilesystem()->exists($basePath)) {
            $this->creator->getFilesystem()->makeDirectory($basePath);
        }

        $dbConns = array_keys(config('database.connections'));
        foreach ($dbConns as $dbConn) {
            $_basePath = $basePath . '/' . $dbConn;

            if (! $this->creator->getFilesystem()->exists($_basePath)) {
                $this->creator->getFilesystem()->makeDirectory($_basePath);
            }
        }
    } 
}
