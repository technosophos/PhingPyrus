# Using MetaPhing

This short document explains how you, the developer, can use MetaPhing to build a project.

## Getting Started

To create a new package, type:

  metaphing MyProject

(where MyProject is the name of your project).

This will create build files, a source code repository tree, and stubs for many important files, including licenses, READMEs and other things. Here's an abbreviated overview of what your directories should look like:

    MyProject/
       |
       |---- bin/ (Tools that are *not* part of your releasable code)
       |
       |---- data/ (Data to be included in releases)
       |
       |---- dist/ (Packages that Phing builds for you when you cut a release)
       |
       |---- doc/ (Documentation you write or PhpDocumentor generates for you)
       |
       |---- examples/ (Example code that you write)
       |
       |---- scripts/ (Scripts that *are* part of releasable code. Will be included in releases.)
       |
       |---- src/ (The PHP code that you write)
       |
       |---- test/ (Unit tests, functional tests, reports, coverage, etc.)
       |
       |---- README.md (Your README file for your project's users)
       | 
       |---- COPYING-MIT.txt (The license file. We use MIT by default, but you can use whatever)
       |
       |---- CREDITS (Credits file in the PEAR2 format. Necessary if you use Pyrus)
       |
       |---- build.xml (The Phing build.xml file)
       |
       |---- project.properties (Your project's configuration properties. EDIT THIS.)
       |
       |---- .gitignore (A stub containing Git ignore directives.)

The first thing to do with your new project is edit the `project.properties` file. This contains many pieces of metadata and information about your new project. This pieces are used to automatically generate packages, documentation, and unit tests.

Once you have this edited, you can run `phing info` to double-check your settings.

You should probably also write a little basic info in `README.md`. This file is a plain text file that allows Markdown formatting. We follow this convention primarily because we use GitHub, and GitHub uses Markdown.

From here, you can begin adding code, writing tests, and doing your thing.

## Source Code

All of your PHP source code should go into the `src/` filter. You may structure your code however you want, using whatever your typical conventions are. Automated tasks attempt to ignore the details of code structure.

## Documentation, Tutorials, and Examples

Documentation goes in `doc/`. You can either write your own documentation or use PhpDocumentor. Note, however, that using PhpDocumentor is strongly encouraged.

In the future, we will also support doxygen.

When writing PhpDocumentor documentation, you can use three types of documentation:

  * Source code documentation *inline* in your src/ source code.
  * DocBook formatted tutorials stored in the tutorials/ directory.
  * Example code goes in `examples/`.

If you put code in the `examples/` directory, it will also be included in the documentation output. But you should use {@link} and @see directives to direct users to the examples.

## Building and Packaging

When you run the build command (`phing build -Dversion=1.2.3`), Phing will first make a release copy of your code, stored in `bin/build`, and then package that code into the form you requested. By default, it will build a Gzipped Tar archive in the form of a PEAR package and a plain old Zip file.

When your code is packaged, the tgz and zip files will be placed in `dist/`. Example:

    dist/
      |
      |---- MyPackage-1.2.4.tgz
      |
      |---- MyPackage-1.2.4.zip

The TGZ will be a PEAR package.

What does a PEAR package look like? It's a tgz file with the following format:

    MyProject-1.2.3.tgz
      |
      |---- package.xml (the PEAR package file)
      |
      |---- MyProject-1.2.3
               |
               |---- src/
               |       |
               |       |---- index.php (and all other code)
               |
               |---- doc/
               |       |
               |       |---- index.html (and all other docs)
               |
               |---- data/
               |
               |---- examples/
               |
               |---- test/

In most cases, this is suitable for standard distributions as well as hosting your code as a PEAR package on a PEAR channel server.

## Testing

All testing material should go in the `test/`.

Unit Tests should go in `test/Tests`.

Coverage and analytic reports will be stored in `tests/reports`.

Other testing data can be included where it is convenient.

## Data

The `data/` directory is for supporting data.

## Things you can delete

You can delete this file, and most README.txt files throughout here. If you are not using Git, you can delete `.gitignore`. If you do not use examples, testing, documentation, data, or scripts, you can delete any or all of those directories. None of them are required. Note, however, that if you delete doc directories, you cannot run `phing doc`. Likewise, if you delete test directories, you cannot run `phing test`.

And feel free to hack on build.xml. Nothing is written in stone.

## About Conventions

The conventions followed when building MetaPhing are derived from two sources:

  * Project layout follows the PEAR recommendation (http://pear.php.net).
  * Source code follows the Drupal coding standard, which differs only slightly from the PEAR coding standard.

While Zend-style source layouts will work, MetaPhing does not *assume* any of the conventions that typify Zend-style source code.