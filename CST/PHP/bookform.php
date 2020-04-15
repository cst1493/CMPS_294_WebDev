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
                //is adding/apending to the database/txt-file.  (change 'a' to 'w' to replace old text file)
                $textDB = fopen("database.txt", "a") or die("error");

                //set new database entry to a single string.
                $arrLength = count($database) - 1;
                $dbString = '';
                for($x = 0; $x <= $arrLength; $x++)
                {
                    $dbString = "$dbString" . "$database[$x]" . "#";
                }
                echo($dbString);
                fwrite($textDB, ($dbString . "\n")); //adding/apending to file
                fclose($textDB);
            }
            if( strcmp($_POST['dbCommand'], 'search_all') == 0 )
            {
                //echo "Search all is called.\n   ";
                $textDB = fopen("database.txt", "r") or die("error");
                $x = 0;
                while(!feof($textDB)) //while not the end of the text file.
                {
                    $char_ = fgetc($textDB); //get next character
                    if ($char_ == '#'){
                        $x++;
                        echo nl2br(", "); //nl2br is for HTML functionality.
                        if (($x % 5) == 0){
                            echo nl2br("\n"); //if end of an entry, new line.
                        }
                    }
                    else echo $char_;
                }
                fclose($textDB);
            }
            if( strcmp($_POST['dbCommand'], 'delete') == 0 )
            {
                $textDB = fopen("database.txt", "r") or die("error");
                $tempList = [];
                $found = false;
                $x = 0; $wordSlot = 0;
                while(!feof($textDB))  //find strings between the #'s and add to array
                {
                    $str = "";
                    $char_ = fgetc($textDB); //add chars together to make entry strings
                    while(($char_ != '#') && (!feof($textDB))) {
                        $str = "$str" . "$char_";
                        $char_ = fgetc($textDB);
                    } //full word is found
                    if($wordSlot % 5 == 0) //if in the 'title' slot, check for match.
                    {
                        $deleteKey = "\n" . "$database[0]"; //fgetc char always gets the new line.
                        if(strcmp($deleteKey, $str) == 0 ) {
                            //if found the deleted book title, skip the next 4 strings.
                            for($z = 1; $z < 5;) { //found 1 of 5 entries to delete
                                $char_ = fgetc($textDB);
                                if (($char_ == '#') || (feof($textDB))) {
                                    $z++;
                                }
                            } 
                            $found = true;
                        }
                        else {
                            $tempList[$x] = $str; //add entry to new DB text file array
                            $x++;
                        }
                    }
                    else {
                        $tempList[$x] = $str; //add entry to new DB text file array
                        $x++;
                    }
                    $wordSlot++;
                }
                fclose($textDB);
                $arrLength = $x-1;
                //write the new array over the old text file
                $textDB2 = fopen("database.txt", "w") or die("error");
                $dbString = '';
                for($x = 0; $x < $arrLength; $x++)
                {
                    $dbString = "$dbString" . "$tempList[$x]" . "#";
                    $j = $x+1;
                    if (($j % 5) == 0){//write a line to the text file
                        fwrite($textDB2, $dbString);
                        $dbString = "";
                    }
                }
                fwrite($textDB2, ("$dbString" . "\n"));
                fclose($textDB2);
                if($found){
                    echo("You have successfully deleted $deleteKey from the database. ");
                }
                else echo("Unable to find a successful book title match for \"$deleteKey\".  Please try again. ");
                //echo("Successfully ended.");
            }
            if( strcmp($_POST['dbCommand'], 'edit') == 0 )
            {
                $textDB = fopen("database.txt", "r") or die("error");
                $tempList = [];
                $found = false;
                $x = 0; $wordSlot = 0;
                while(!feof($textDB))  //find strings between the #'s and add to array
                {
                    $str = "";
                    $char_ = fgetc($textDB); //add chars together to make entry strings
                    while(($char_ != '#') && (!feof($textDB))) {
                        $str = "$str" . "$char_";
                        $char_ = fgetc($textDB);
                    } //full word is found
                    $tempList[$x] = $str; //add entry to new DB text file array
                    $x++;
                    if($wordSlot % 5 == 0) //if in the 'title' slot, check for match.
                    {
                        $editKey = "\n" . "$database[0]"; //fgetc char always gets the new line.
                        if(strcmp($editKey, $str) == 0 ) {
                            //if found the editing book title, edit the next 4 strings.
                            $str = ""; //reset string
                            for($z = 1; $z < 5;) { //found 1 of 5 entries to edit
                                $char_ = fgetc($textDB);
                                if (($char_ == '#') || (feof($textDB))) {
                                    $tempList[$x] = $database[$z]; //add the users new needs.
                                    $z++; $x++;  //reset array positions.
                                }
                            }
                            $found = true;
                        }
                    }
                    $wordSlot++;
                }
                fclose($textDB);
                $arrLength = $x-1;
                //write the new array over the old text file
                $textDB2 = fopen("database.txt", "w") or die("error");
                $dbString = '';
                for($x = 0; $x < $arrLength; $x++)
                {
                    $dbString = "$dbString" . "$tempList[$x]" . "#";
                    $j = $x+1;
                    if (($j % 5) == 0){//if it's a different entry, print to user & new line. //qqqqq
                        fwrite($textDB2, $dbString);
                        $dbString = "";
                    }
                }
                fwrite($textDB2, ("$dbString" . "\n"));
                fclose($textDB2);
                if($found){
                    echo("You have successfully edited $editKey from the database. ");
                } 
                else echo("Unable to find a successful book title match for \"$editKey\".  Please try again. ");
                //echo("Successfully ended.");
            }
        ?>

    </body>
</html>