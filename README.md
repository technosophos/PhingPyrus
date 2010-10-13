# PhingPyrus: Pyrus tasks for the Phing build tool.

This package provides Phing tasks for managing PEAR packages with Pyrus.

## Installation

Requires:

  * PHP 5.3.x
  * [Pyrus.phar](http://pear2.php.net)
  * [phing](http://phing.info)

Install using PEAR:

    pear channel-discover pear.querypath.org
    pear install querypath/PhingPyrus

Or you can clone the github repository.

## Usage

To use this package in your Phing build.xml scripts, you will need to include the following somewhere in your build.xml:

    <!-- Path to Pyrus.phar (do not include pyrus.phar in the path). -->
    <includepath classpath="/path/to/directory/which/has/pyrus"/>
    <!-- Path to PhingPyrus. Not necessary if you installed via PEAR. -->
    <includepath classpath="/path/to/PyrusPhing"/>

    <!-- Pyrus tasks. -->
    <taskdef classname="PhingPyrus.Task.PyrusMakeTask" name="pyrusmake"/>
    <taskdef classname="PhingPyrus.Task.PyrusPackageTask" name="pyrusmake"/>
    <taskdef classname="PhingPyrus.Task.PyrusHelpTask" name="pyrushelp"/>
    <taskdef classname="PhingPyrus.Task.PyrusExecTask" name="pyrusexec"/>

This package provides common tasks. We will gradually expand the list of tasks, but if there is something you want to do with Pyrus, it is likely that you can do it with `pyrusexec`.

### pyrusmake

Use this to execute a Pyrus make command. This generates a `package.xml` file. Generally you will want to use this before running `pyruspackage` to build the actual package. In between, you may want to use the `qpreplace` task from [PhingQueryPath](http://github.com/technosophos) to modify the `package.xml` file.

To enable:

    <taskdef classname="PhingPyrus.Task.PyrusMakeTask" name="pyrusmake"/>

Basic example:

    <pyrusmake packagename="MyPackage" dir="mycode/" channel="pear.example.com"/>

Full example:

    <pyrusmake 
      packagename="MyPackage" 
      dir="mycode/" 
      channel="pear.example.com" 
      packageformat="tgz" 
      stub="stub.php"
      packagexmlscript="some.php"/>

### pyruspackage

Use this to execute a Pyrus build command (and build a PEAR package from package.xml).

To enable:

    <taskdef classname="PhingPyrus.Task.PyrusPackageTask" name="pyruspackage"/>

Basic example:

    <pyruspackage packagexml="path/to/package.xml"/>

Full example:

    <pyruspackage 
      packagexml="path/to/package.xml" 
      outputfile="mypackage-1.0.0" 
      stub="mypharstub.php"
      extrasetup="domorestuff.php"
      archiveformat="tgz,tar,zip,phar"
      />

Note that stub only works for Phar archives. By default, `archiveformat` is `tgz`.

## pyrusexec

Execute a raw Pyrus command. This simulates a command-line run of Pyrus (though Pyrus is 
bootstrapped within Phing.) Everything you pass into `pyrusexec` will be passed on to Pyrus.

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