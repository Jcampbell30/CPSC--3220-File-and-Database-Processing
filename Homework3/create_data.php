<?php
 
    //A program to read in domain names
    $domainfile = fopen("domains.txt", "r");
    $line4 = fgets($domainfile);
    $line4 = str_replace(array("\r","\n"),"",$line4);
    $tmp = explode(".", $line4);

    while ($tmp) 
    {
    $domain[] = implode('.', array_splice($tmp, 0, 2));
    };
    fclose($domainfile);


    //A program to read in values from street types
    $typeFile = fopen("street_types.txt", "r");
    $typedata = [];
    while($line3 = fgets($typeFile))
    {
        $typeNames = str_replace(str_split(';'), " ",$line3);
        $line3 = explode(".",$typeNames);
        $line3 = str_replace(array("\r","\n"),"",$line3);
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
 
        
        //function to return a random element in an array
        function randArray($a)
        {
            $value = array_rand($a);//using built in function to return random value an array: storing in temporary variable called $value
            return $a[$value];//return the array that was passed in as the parameter at index $value
        }
     
        //A link to refresh the page
        print (" <p><a href = \"create_data.php\">Refresh</a></p> ");

        //creating a table of 25 random people generated from our arrays
        print("<table class= 'center' border = '3'>");
        print("<th>First Name</th><th>Last Name</th><th>Address</th><th>Email</th>");
        $myfile = fopen("customers.txt", "w");
    
        
        for($i = 0; $i < 25; $i++)//creating 25 random first_name,last_name,address#,street address,address type, and domain names.
        {
            print("<tr>");//begin row
            for($j = 0; $j < 4; $j++)// 4 columns = 4 arrays
            {
                if($j == 0)//column zero = First name column
                {   
                    $tempOne = randArray($firstname);
                    print("<td align= 'center' >".$tempOne."</td>");
                
                }
                if($j == 1)//column one: Last Name column
                {
                    $temp2 = randArray($lastname);
                    print("<td align= 'center'>".$temp2."</td>");
                
                }
                if($j == 2)//column two: Address column 
                {
                   $num = rand(100,999);
                    $strt = randArray($streetdata);
                    $t = randArray($typedata);
                    print("<td align= 'center' >".$num." ".$strt." ".$t."</td>");
                
                }
                if($j == 3)//column three: Email column
                {
                    $myStr = "@".randArray($domain);
                    print("<td align= 'center'>".$tempOne.".".$temp2."".$myStr."</td>");
                
                }    
            }
            $txt = $tempOne.":".$temp2.":".$num." ".$strt.$t.":".$tempOne.".".$temp2."".$myStr;//storing string variables as $txt 
            fwrite($myfile,$txt);//writing to customers.txt
            fwrite($myfile,"\n");//writing a new line
            print("</tr>");//ending row
        }
        
        fclose($myfile);//closing output file
        print("</table>");//closing table 
        print (" <p><a href = \"start.html\">Home Page</a></p> ");
  
	?>