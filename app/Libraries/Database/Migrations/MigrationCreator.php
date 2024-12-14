<?php

namespace App\Libraries\Database\Migrations;

use Illuminate\Filesystem\Filesystem;

class MigrationCreator
{
  protected $files;

  public function __construct(Filesystem $files) 
  {
    $this->files = $files;
  }

  public function create(string $dbConn, string $path, string $table, ?string $column, ?string $index, bool $create=false) 
  {
    $stub = $this->getStub($create, $column, $index);

    $this->files->put(
      $path = $this->getPath($table, $path),
      $this->populateStub($dbConn, $stub, $table, $column, $index)
    );

    return $path;
  }

  protected function getStub($create, $column, $index) 
  {
    $stub = 'migration_TYPE.stub';

    if (is_string($column)) {
      $type = 'column';
    } elseif (is_string($index)) {
      $type = 'index';
    } else {
      $type = $create ? 'create' : 'update';
    }

    $stub = str_replace('TYPE', $type, $stub);

    return $this->files->get($this->stubPath() . "/{$stub}");
  }

  protected function populateStub($dbConn, $stub, $table, $column, $index)
  {
    $stub = str_replace('{DB_CONN}', $dbConn, $stub);
    $stub = str_replace('{TABLE}', $table, $stub);
    $stub = str_replace('{CLASS}', $table, $stub);
    
    if (is_string($column)) {
      $stub = str_replace('{COLUMN}', $column, $stub);
    }

    if (is_string($index)) {
      $stub = str_replace('{INDEX}', $index, $stub);
    }

    return $stub;
  }

  protected function getPath($table, $path)
  {
    return $path . '/' . $this->getDatePrefix() . '_' . $table . '_table' . '.php';
  }

  protected function getDatePrefix() 
  {
    return date('Y_m_d_His');
  }

  protected function generateColumnProperty($column) 
  {
    $newLine = PHP_EOL;

    $str = '';
    $str .= $newLine . $newLine;
    $str .= '     /**' . $newLine;
    $str .= '      * The focused column name.' . $newLine;
    $str .= '      *' . $newLine;
    $str .= '      * @var string' . $newLine;
    $str .= '     */' . $newLine;
    $str .= '     protected $column = \'' . $column . '\';';

    return $str;
  }

  public function stubPath() 
  {
    return __DIR__ . '/Stubs';
  }

  public function getFilesystem()
  {
    return $this->files;
  }
  
}