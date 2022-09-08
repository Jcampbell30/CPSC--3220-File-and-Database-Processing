<?php
    //A program to read in values from street types
    $typeFile = fopen("street_types.txt", "r");
    $typedata = [];
    while($line3 = fgets($typeFile))
    {
        $typeNames = str_replace(str_split(';'), " ",$line3);
        $line3 = explode(".",$typeNames);
        $typeArr[] = $line3;
    }
    for($i = 0; $i < sizeof($typeArr); $i++)
    {
        for($j = 0; $j < count($typeArr[$i]); $j++)
        {
            array_push($typedata,$typeArr[$i][$j]);
        }
    }
    $typedata = array_filter($typedata);
    fclose($typeFile);


    //A program to read values from streetnames 
    $street = fopen("street_names.txt", 'r');
    $streetdata = [];
    while($line2 = fgets($street))
    {
        $streetnames = str_replace(array("\r","\n"),"",$line2);
        $line2 = explode(":",$streetnames);
        $streetArr[] = $line2;
    }
    for($i = 0; $i < sizeof($streetArr); $i++)
    {
        for($j = 0; $j < count($streetArr[$i]); $j++)
        {
            array_push($streetdata,$streetArr[$i][$j]);
        }
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
        print_r($streetdata);
        print("</pre>");


         print("<pre>");
         print_r($typedata);
         print("</pre>");
 
        //function to return a random element in an array
        function randArray($a)
        {
            $value = array_rand($a);
            return $a[$value];
        }
        print("<p>Random name value: ".randArray($firstname)." ".randArray($lastname).
        " and the street names is: ".randArray($streetdata)." ".randArray($typedata));
        print (" <p><a href = \"create_data.php\">Refresh</a></p> ");
        
	?>