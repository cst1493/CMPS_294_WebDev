<?php
    include_once 'includes/dbh.php'; //filepath.
    include 'includes/shortcuts.php';
    //http://localhost/CMPS_294_WebDev/CST/PHP&MySQL/books.php connect locally.
?>

<!DOCTYPE html>
<html>
    <head>
        <title> books.php </title>
    </head>
    <body>
        <h3> <b>Data View.  Exit to return back to the menu.</b> </h3>
        <?php
            $userInputArr = array($_POST['title'], $_POST['author'],
            $_POST['ISBN'], $_POST['publisher'], $_POST['year']);
            
            //find the correct operation.
            if( strcmp($_POST['dbCommand'], 'add') == 0 )
            {
                addToDB($connection, $userInputArr);
            }
            if( strcmp($_POST['dbCommand'], 'search_all') == 0 )
            {
                printResult($connection, "SELECT * FROM books;");
            }
            if( strcmp($_POST['dbCommand'], 'delete') == 0 )
            {
                $deleteTitle = $userInputArr[0];
                deleteFromDB($connection, $deleteTitle);
            }
            if( strcmp($_POST['dbCommand'], 'edit') == 0 )
            {
                editBookByTitle($connection, $userInputArr);
            }
        ?>
    </body>
</html>