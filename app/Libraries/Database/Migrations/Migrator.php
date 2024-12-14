<?php 

namespace App\Libraries\Database\Migrations;

use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migrator as BaseMigrator;
use Illuminate\Console\OutputStyle;
use Symfony\Component\Console\Output\ConsoleOutput;
use ReflectionClass;

class Migrator extends BaseMigrator
{
  protected $output;

  public function __construct(
      $repository, 
      $resolver, 
      $files, 
      ?OutputStyle $output = null
  ) {
      parent::__construct($repository, $resolver, $files);
      $this->output = $output ?? new OutputStyle(
          new \Symfony\Component\Console\Input\ArgvInput(), 
          new ConsoleOutput()
      );
  }

  protected function runUp($file, $batch, $pretend) 
  {
      $migration = $this->resolvePath($file);

      $name = $this->getMigrationName($file);

      if ($pretend) {
          return $this->pretendToRun($migration, 'up');
      }

      $this->output->writeln("<comment>Migrating:</comment> {$name}");

      $starTime = microtime(true);

      $this->runMigration($migration, 'up');

      $diff = (microtime(true) - $starTime) * 1000;
      $unit = 'ms';

      if ($diff >= 1000) {
          $diff /= 1000;
          $unit = 's';
      }

      $runTime = number_format($diff, 2);

      $this->repository->log($name, $batch);

      $this->output->writeln("<info>Migrated:</info> {$name} ({$runTime}{$unit})");
  }

  protected function runDown($file, $migration, $pretend)
  {
    $instance = $this->resolvePath($file);

    $name = $this->getMigrationName($file);

    $this->output->writeln("<comment>Rolling Back:</comment> {$name}");

    if ($pretend) {
        return $this->pretendToRun($instance, 'down');
    }

    $startTime = microtime(true);

    $this->runMigration($instance, 'down');

    $diff = (microtime(true) - $startTime) * 1000;
    $unit = 'ms';

    if ($diff >= 1000) {
      $diff /= 1000;
      $unit = 's';
    }

    $runTime = number_format($diff, 2);

    $this->repository->delete($migration);

    $this->output->writeln("<info>ROlled Back:</info> {$name} ({$runTime}{$unit})");
  }
  
  protected function resolvePath(string $path)
  {
    $class = $this->getMigrationClass($this->getMigrationName($path));

    if (class_exists($class) && realpath($path) == (new ReflectionClass($class))->getFileName()) {
      return new $class;
    }

    $migration = $this->files->getRequire($path);

    return is_object($migration) ? $migration : new $class;
  }

  protected function getMigrationClass(string $migrationName): string
  {
    return Str::studly(implode("_", array_slice(explode('_', $migrationName), 4)));
  }
}