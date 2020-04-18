<?php
    
    function printResult($connection, $sqlCommand)
    {
        $result = mysqli_query($connection, $sqlCommand); //$conn comes from dbh.php, the database handler.
        
        $resultCheck = mysqli_num_rows($result); //if data exists, expect greater than 0.
        if ($resultCheck > 0) //if any entries exist, print them out.
        {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) //while the database has more entries...
            {
                echo "book " . $i . ":<br>" . $row['title'] . ", " . $row['author'] . ", " . $row['isbn'] . ", " .
                $row['publisher'] . ", " . $row['year'] . "; " . "<br><br>";
                $i++;
            }
        }
        else echo("No entries found.");
    }

    function addToDB($connection, $userInputArr)
    {
        $foundDuplicate = false;
        $result = mysqli_query($connection, "SELECT title FROM books;");
        $titleDuplicateCheck = mysqli_num_rows($result);
        if ($titleDuplicateCheck > 0) //if any entries exist, check for duplicates
        {
            while ($row = mysqli_fetch_assoc($result)) //while the database has more entries...
            {
                if( strcmp($userInputArr[0], $row['title']) == 0 ){
                    $foundDuplicate = true;
                }
            }
        }
        if ($foundDuplicate)
        {
            echo "The title, \"$userInputArr[0],\" already exists.  Try another title or check if that book is already in the database.";
        }
        else //finally add to database.  Check if year or ISBN are null first.  if they are, replace with 0 for no error on SQL side.
        {
            if(strcmp($userInputArr[2], '') == 0){ //if the user doesn't add an ISBN.
                $userInputArr[2] = 0;
            }
            if(strcmp($userInputArr[4], '') == 0){ //if the user doesn't add a year.
                $userInputArr[4] = 0;
            }
            //SQL syntax: insert into books (title, author, isbn, publisher, year) VALUES ('The Book', 'Will Smith', 1234, 'The Publishers',  1999);
            $sqlCommand = "insert into books (title, author, isbn, publisher, year) VALUES 
            ('$userInputArr[0]', '$userInputArr[1]', '$userInputArr[2]', '$userInputArr[3]',  '$userInputArr[4]');";
            
            $result = mysqli_query($connection, $sqlCommand);
            echo "Successfully added new entry: <br>$userInputArr[0], $userInputArr[1], $userInputArr[2], $userInputArr[3], $userInputArr[4]; ";
        }
    }

    function deleteFromDB($connection, $deleteTitle)
    {
        $sqlCommand = "SELECT * FROM books WHERE title = '$deleteTitle';"; //check if any match exists.
        $result = mysqli_query($connection, $sqlCommand);
        
        $deleteTitleCheck = mysqli_num_rows($result);
        if ($deleteTitleCheck > 0)
        {
            $sqlCommand = "DELETE FROM books WHERE books.title = '$deleteTitle';"; //delete entry
            $result = mysqli_query($connection, $sqlCommand);
            echo "sucessfully deleted $deleteTitle from the database.";
        }
        else echo("No entries found.");
    }

    function editBookByTitle($connection, $userInputArr)
    {   //title[0], author[1], isbn[2], publisher[3], year[4]
        $editTitle = $userInputArr[0];
        $sqlCommand = "SELECT * FROM books WHERE title = '$editTitle';"; //check if title exists.
        $result = mysqli_query($connection, $sqlCommand);
        
        $editTitleCheck = mysqli_num_rows($result);
        if ($editTitleCheck > 0){
            $sqlCommand = "UPDATE books SET author = '$userInputArr[1]', isbn = '$userInputArr[2]',
            publisher = '$userInputArr[3]', year = '$userInputArr[4]' WHERE title = '$editTitle';";
            $result = mysqli_query($connection, $sqlCommand); //update

            echo "sucessfully changed \"$editTitle\".";
        }
        else echo("No entries found.");
    }

    