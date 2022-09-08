<?php


    //A program to read values from streetnames 
    $street = fopen("street_names.txt", 'r');
    while($line2 = fgets($street))
    {
        $streetnames = str_replace(array("\r","\n"),"", $line2);
        $streetArr[] = $line2;
        for($i = 0; $i < sizeof($streetArr); $i++)
        {
            $line2 = explode(":",$streetnames);
        }
        //$line2 = explode(":",$streetnames);
        //$streetArr[] = $line2;
        //$streetArr[] = explode(":",$line2);
    }
  
    fclose($street);
    //A program to read vaiues from firstname
    $first = fopen("first_names.csv",'r');
    $line1 = fgets($first);
    $firstname = str_getcsv($line1);

    fclose($first);
    //A program to read in values from lastname 
		$last =fopen("last_names.txt","r");
        while ($line = fgets($last))
        {
            $line = str_replace(array("\r","\n"),"", $line);
            $lastname[] = $line;
        }
        

		fclose($last);     
        //printing data
        print("<pre>");
        print_r($lastname);
        print("</pre>");

        print("<pre>");
        print_r($firstname);
        print("</pre>");

        print("<pre>");
        print_r($streetArr);
        print("</pre>");

        //function to return a random element in an array
        function randArray($a)
        {
            $value = array_rand($a);
            return $a[$value];
        }
        print("<p>Random name value: ".randArray($firstname)." ".randArray($lastname)." and the street names is: ".randArray($streetArr));

        print (" <p><a href = \"create_data.php\">Refresh</a></p> ");

        
	?>