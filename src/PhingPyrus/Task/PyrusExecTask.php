<?php
/**
 * Task for executing a Pyrus command, simulating the command line.
 */
require_once 'PhingPyrus/Util/PyrusFactory.php';
require_once 'phing/Task.php';

class PyrusExecTask extends Task {
  
  protected $cmd = NULL;
  
  public function init(){}
  public function main(){
    
    if (empty($this->cmd)) {
      throw new BuildException('You must specify a command using \'command\'.');
    }
    
    $task = array_shift($this->cmd);
    
    PyrusFactory::issueCommand($task, $this->cmd);
  }
  
  public function setCommand($cmd) {
    $this->cmd = explode(' ', $cmd);
  }
}