<?php
    include_once 'includes/dbh.php'; //filepath.
?>

<!DOCTYPE html>
<html>
    <head>
        <title> data view </title>
    </head>
    <body>
        <h3>
            <b>Data View.  Escape to return back to the menu.</b>
        </h3>
        <?php

            //adding database information, excluding the command.
            $database = array($_POST['title'], $_POST['author'],
            $_POST['ISBN'], $_POST['publisher'], $_POST['year']);

            if( strcmp($_POST['dbCommand'], 'add') == 0 )
            {
            }
            if( strcmp($_POST['dbCommand'], 'search_all') == 0 )
            {
            }
            if( strcmp($_POST['dbCommand'], 'delete') == 0 )
            {
            }
            if( strcmp($_POST['dbCommand'], 'edit') == 0 )
            {
                //echo("test");
            }
        ?>
    </body>
</html>