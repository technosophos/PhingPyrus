<?php
/**
 * Task for print Pyrus help text.
 */
require_once 'PhingPyrus/Util/PyrusFactory.php';
require_once 'phing/Task.php';

class PyrusHelpTask extends Task {
  
  protected $packageXML = 'package.xml';
  protected $outputFile = NULL;
  protected $stub = NULL;
  protected $extrasetup = NULL;
  
  public function init(){}
  
  public function main(){
    $this->preFlightCheck();
    $params = $this->buildParams();
    PyrusFactory::issueCommand('package', $params);
  }
  
  /**
   * Set the path to the package.xml file.
   *
   * If this is not set, we assume there is a package.xml in
   * the base directory.
   */
  public function setPackageXML($filename) {
    $this->packageXML = $filename;
  }
  
  /**
   * Set the output file.
   *
   * If this is not set, Pyrus will build a package 
   * based on package.xml.
   */
  public function setOutputFile($filename) {
    $this->outputFile = $filename;
  }
  
  /**
   * Set a stub for the archive (Phar only).
   */
  public function setStub($filename) {
    $this->stub = $filename;
  }
  
  /**
   * Set an extrasetup.php file to execute.
   */
  public function setExtraSetup($filename) {
    $this->extrasetup = $filename;
  }
  
  /**
   * Set which formats to build.
   *
   * @param string $formats
   *  A comma-separated list of formats. e.g. 'phar' or 'phar,tar,tgz,zip'.
   */
  public function setArchiveFormat($formats) {
    $this->formats = explode(',', $formats);
  }
  
  protected function buildParams() {
    $params = array();
    
    foreach ($this->formats as $format) {
      $format = trim($format);
      switch ($format) {
        case 'tgz':
          $params[] = '-g';
          break;
        case 'tar':
          $params[] = '-t';
          break;
        case 'zip':
          $params[] = '-z';
          break;
        case 'phar':
          $params[] = '-p';
          break;
        default:
          throw new BuildException('Unknown format: ' . $format);
      }
    }
    
    if (isset($this->outputFile)) {
      array_push($params, '-o', $this->outputFile);
    }
    if (isset($this->stub)) {
      array_push($params, '-s', $this->stub);
    }
    if (isset($this->extrasetup)) {
      array_push($params, '-e', $this->extrasetup);
    }
    
    array_push($params, $this->packageXML);
    
    return $params;
    
  }
  
  protected function preFlightCheck() {
    
    if (!isset($this->packageXML)) {
      throw new BuildException('No path to package.xml file was supplied. Try setting "packagexml".');
    }
    if (!is_file($this->packageXML)) {
      throw new BuildException(sprintf('Could not find a file named %s.', $this->packageXML));
    }
    
  }
}