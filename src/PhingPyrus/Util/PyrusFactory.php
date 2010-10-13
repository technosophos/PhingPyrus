<?php

//require_once 'phar://pyrus.phar/PEAR2_Pyrus-2.0.0a1/php/PEAR2/Pyrus/ScriptFrontend/Commands.php';

class PyrusFactory {
  
  private static $pyrus = NULL;
  private static $pyrusPath = 'pyrus.phar';
  
  public static function instance() {
    
    if (empty($pyrus)) {
      
      // Find the right version of Pyrus.
      
      $includes = explode(PATH_SEPARATOR, get_include_path());
      
      $pyrusPath = NULL;
      foreach ($includes as $path) {
        $candidate = $path . DIRECTORY_SEPARATOR . 'pyrus.phar';
        if (is_file($candidate)) {
          $pyrusPath = $candidate;
          break;
        }
      }
      
      if (empty($pyrusPath)) {
        throw new Exception('No suitable pyrus.phar was found on the path.');
      }
      
      self::$pyrusPath = $pyrusPath;
      
      // Register an autoloader and build a new frontend.
      spl_autoload_register("PyrusFactory::pyrusAutoload");
      self::$pyrus = new \PEAR2\Pyrus\ScriptFrontend\Commands();
    }
    
    return self::$pyrus;
  }
  
  /**
   * Issue a command to a Pyrus instance.
   *
   * This will print information directly to the console.
   *
   * @param string $command
   *  The name of the command. Run `php pyrus.phar help` to see the commands.
   * @param array $params
   *  The parameters to pass into the command.
   * @return
   *  Integer success string.
   */
  public static function issueCommand($command, array $params) {
    $inst = self::instance();
    array_unshift($params, $command);
    $inst->run($params);
  }
  
  /**
   * Derived from the Pyrus autoloader.
   */
  public static function pyrusAutoload($class){
    $class = str_replace(array('_','\\'), '/', $class);
    //print $class . PHP_EOL;
    if (file_exists('phar://' . self::$pyrusPath . '/PEAR2_Pyrus-2.0.0a1/php/' . $class . '.php')) {
      include 'phar://' . self::$pyrusPath . '/PEAR2_Pyrus-2.0.0a1/php/' . $class . '.php';
    }
  }
  
}
?>