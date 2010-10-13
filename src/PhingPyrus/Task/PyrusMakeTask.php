<?php
/**
 * Task for creating a package.xml file from a project using Pyrus.
 */
require_once 'PhingPyrus/Util/PyrusFactory.php';
require_once 'phing/Task.php';

class PyrusMakeTask extends Task {
  
  /**
   * Format for packages.
   * By default, this creates a phar, a tgz, and a zip.
   */
  protected $format = 'phar,tgz,zip';
  
  /**
   * File that contains a package configuration script.
   *
   * By default, no extra configuration script is used. (Though 
   * Pyrus will look for packagexmlsetup.php and use it if it
   * finds it.)
   */
  protected $configurationScript = NULL;
  
  protected $packageName = NULL;
  
  protected $channel = NULL;
  
  protected $baseDirectory = NULL;
  
  protected $stub = NULL;
  
  protected $dryRun = FALSE;
  
  public function init(){}
  public function main(){
    
    $this->preFlightCheck();
    
    // Basic params.
    $params = array(
      $this->packageName,
      $this->channel,
      $this->baseDirectory,
    );
    
    if (isset($this->configurationScript)) {
      array_unshift($params, '-s', $this->configurationScript);
    }
    if (isset($this->stub)) {
      array_unshift($params, '-u', $this->stub);
    }
    if (isset($this->packageFormat)) {
      array_unshift($params, '-p', $this->packageFormat);
    }
    
    if ($this->dryRun) {
      print "Would issue the equivalent of this command: " . PHP_EOL;
      print "\t php pyrus.phar make " . implode(' ', $params);
      return;
    }
    
    PyrusFactory::issueCommand('make', $params);
  }
  
  protected function preFlightCheck() {
    
    if (empty($this->packageName)) {
      throw new BuildException('You must supply a valid package name in "packagename".');
    }
    
    if (is_null($this->baseDirectory)) {
      throw new BuildException('Directory is required. Use "dir" to set the directory.');
    }
    
    if (!is_dir($this->baseDirectory)) {
      throw new BuildException('Value passed in "dir" is not a directory: ' . $this->baseDirectory);
    }
    
    if (empty($this->channel)) {
      throw new BuildException('Channel is required. Use "channel" to set the PEAR channel.');
    }
    
    if (isset($this->stub) && !is_file($this->stub)) {
      throw new BuildException(sprintf('Stub %s was not found.', $this->stub));
    }
    
    if (isset($this->configurationScript) && !is_file($this->configurationScript)) {
      throw new BuildException(
        sprintf('Configuration script %s was not found.', $this->configurationScript)
      );
    }
    
  }
  
  public function setPackageFormat($format) {
    $this->format = $format;
  }
  
  public function setPackageXMLSetup($filename) {
    $this->configurationScript = $filename;
  }
  
  public function setPackageName($name) {
    $this->packageName = $name;
  }
  
  public function setChannel($channel) {
    $this->channel = $channel;
  }
  
  public function setDir($directory) {
    $this->baseDirectory = $directory;
  }
  
  public function setStub($filename) {
    $this->stub = $filename;
  }
  
  public function setDryRun($val) {
    $this->dryRun = filter_var($val, FILTER_VALIDATE_BOOLEAN);
  }
}