<?php

require ('config/paths.php');
require ('config/constants.php');
require ('config/database.php');

//SPL autoload can rweplace this
require ('libs/Bootstrap.php');
require ('libs/Controller.php');
require ('libs/View.php');
require ('libs/Model.php');

// library
require ('libs/Database.php');
require ('libs/Session.php');


$app = new Bootstrap();