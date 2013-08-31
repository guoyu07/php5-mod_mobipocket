# MOBIPocket Apache Module

PHP5 Apache module to display text and metadata of MOBIPocket files.
Requires [php5-mobipocket][mp].

[mp]: https://github.com/mrdragonraaar/php5-mobipocket

## Usage

    AddHandler mod_mobipocket .mobi
    Action mod_mobipocket /url/to/mod_mobipocket/mod_mobipocket.php
    
    SetEnv MOBIPocketHeader /path/to/templates/header-mobipocket.php
    SetEnv MOBIPocketFooter /path/to/templates/footer-mobipocket.php

The environment variables **MOBIPocketHeader** and **MOBIPocketFooter** are optional.
If not included then module uses default templates.

## Display

To display metadata...

   `http://sitename.com/path/to/mobi/book.mobi?D=M`

To display text...

   `http://sitename.com/path/to/mobi/book.mobi?D=T`

