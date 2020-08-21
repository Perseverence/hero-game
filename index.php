<?php
/**
 * Created by PhpStorm.
 * User: valentin.dobrica
 * Date: 20.08.2020
 * Time: 10:50 AM
 */

ini_set('display_errors',1);
error_reporting(1);

require __DIR__ .'/vendor/autoload.php';

use App\Controllers\GameController as GameController;

$game = new GameController();

$game->battle();

