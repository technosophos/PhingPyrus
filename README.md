# PhingPyrus

Basic information about the project.

## Installation

Instructions on how to install

## Usage

To use this package in your Phing build.xml scripts, you will need to include the following somewhere in your build.xml:

    <!-- Path to Pyrus.phar (do not include pyrus.phar in the path). -->
    <includepath classpath="/path/to/directory/which/has/pyrus"/>
    <!-- Path to PhingPyrus. Not necessary if you installed via PEAR. -->
    <includepath classpath="/path/to/PyrusPhing"/>

    <!-- Pyrus tasks. -->
    <taskdef classname="PhingPyrus.Task.PyrusMakeTask" name="pyrusmake"/>
    <taskdef classname="PhingPyrus.Task.PyrusExecTask" name="pyrusexec"/>

This package provides the following tasks.

### pyrusmake

Use this to execute a Pyrus make command.

To enable:

    <taskdef classname="PhingPyrus.Task.PyrusMakeTask" name="pyrusmake"/>

Basic example:

    <pyrusmake/>

Full example:

    <pyrusmake packageformat="tgz" packagexmlscript="some.php"/>

## pyrusexec

Execute a raw Pyrus command. This simulates a command-line run of Pyrus (though Pyrus is 
bootstrapped within Phing.)

To enable:

    <taskdef classname="PhingPyrus.Task.PyrusExecTask" name="pyrusexec"/>

Basic Example:

    <pyrusexec command="help"/>
    
(Equivalent to `php pyrus.phar help`)

Full Example:

    <pyrusexec command="help package"/>
    
(Equivalent to `php pyrus.phar help package`)

## pyrushelp

To enable:

    <taskdef classname="PhingPyrus.Task.PyrusHelpTask" name="pyrushelp"/>

Basic example:

    <pyrushelp/>

Prints pyrus's help page.

## More information

Where to learn more

----
PhingPyrus by mbutcher (2010)