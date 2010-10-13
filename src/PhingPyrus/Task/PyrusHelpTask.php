<?php
/**
 * Task for print Pyrus help text.
 */
require_once 'PhingPyrus/Util/PyrusFactory.php';
require_once 'phing/Task.php';

class PyrusHelpTask extends Task {
  
  protected $cmd = NULL;
  
  public function init(){}
  public function main(){
    $params = array();
    
    if (isset($this->cmd)) {
      $params[] = $this->cmd;
    }
    
    PyrusFactory::issueCommand('help', $params);
  }
  
  public function setCommand($cmd) {
    $this->cmd = $cmd;
  }
}