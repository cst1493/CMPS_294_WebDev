<?php
    include_once 'includes/dbh.php'; //filepath.
    //http://localhost/CMPS_294_WebDev/CST/PHP&MySQL/index.php connect locally. TODO remove
?>

<!DOCTYPE html>
<html>
    <head>
        <title> index.php </title>
    </head>
    <body>
        <h3> <b>Data View.  Exit to return back to the menu.</b> </h3>
        <?php
            $sqlCommand = "SELECT * FROM books;";
            $result = mysqli_query($conn, $sqlCommand); //$conn comes from dbh.php, the database handler.
            
            $resultCheck = mysqli_num_rows($result); //check if result is working.  if data exists, expect greater than 0.
            if ($resultCheck > 0) //if any entries exist, print them out.
            {
                while ($row = mysqli_fetch_assoc($result)) //while the database has more entries...
                {
                    echo $row['id'] . ", " . $row['title'] . ", " . $row['author'] . ", " . $row['isbn'] . ", " .
                    $row['publisher'] . ", " . $row['year'] . "; " . "<br>";
                }
            }
            else echo("Your database appears to be empty.");
            


            //find the correct operation.
            if( strcmp($_POST['dbCommand'], 'add') == 0 )
            {
                echo("add");
            }
            if( strcmp($_POST['dbCommand'], 'search_all') == 0 )
            {
                /*$sqlCommand = "SELECT * FROM books;";
                $result = mysqli_query($conn, $sqlCommand); //$conn comes from dbh.php, the database handler.
                
                $resultCheck = mysqli_num_rows($result); //if data exists, expect greater than 0.
                if ($resultCheck > 0) //if any entries exist, print them out.
                {
                    while ($row = mysqli_fetch_assoc($result)) //while the database has more entries...
                    {
                        echo $row['id'] . ", " . $row['title'] . ", " . $row['author'] . ", " . $row['isbn'] . ", " .
                        $row['publisher'] . ", " . $row['year'] . "; " . "<br>";
                    }
                }
                else echo("Your database appears to be empty.");*/
            }
            if( strcmp($_POST['dbCommand'], 'delete') == 0 )
            {
                echo("delete");
            }
            if( strcmp($_POST['dbCommand'], 'edit') == 0 )
            {
                echo("edit");
            }

            /*
            $database = array($_POST['title'], $_POST['author'],
            $_POST['ISBN'], $_POST['publisher'], $_POST['year']);
            echo("end..."); */
        ?>
    </body>
</html>