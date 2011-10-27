<?php
/**
 * Task for print Pyrus help text.
 */
require_once 'QueryPath/QueryPath.php';
require_once 'phing/Task.php';

class PackageXMLPostprocess extends Task {
  
  protected $cmd = NULL;
  
  public function init(){}
  public function main(){
  }
  
  public function setCommand($cmd) {
    $this->cmd = $cmd;
  }
}