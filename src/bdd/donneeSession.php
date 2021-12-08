<?php
if (empty(session_id())) {
    // start session if it wasn't already started
    session_start();
    
}
// define this constant so we can always use it to check if the user is logged
define("LOGGED", !empty($_SESSION['LOGGED']));