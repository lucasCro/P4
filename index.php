<?php
require('Controller/FrontEnd/controller.php'); 

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'displayChapters') {
        displayChapters();
    }
    elseif ($_GET['action'] == 'displayContact') {
        displayContact();
    }
    elseif ($_GET['action'] == 'displayHome') {
        displayHome();
    }
    elseif ($_GET['action'] == 'displayAdmin') {
        displayAdmin();
    }
} else {
    displayHome();
}

?>  