<!DOCTYPE html>
<!--	Author: Jared Campbell 
		Date:	August 29, 2022
		File:	Homework2
		Purpose: to complete assignment 2
-->
<html>
<head>
	<title>Table Calculator - RESULTS</title>
	<link rel ="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php

	$rows = $_POST['rows'];
	$cols = $_POST['cols'];
    $lower = $_POST['lower'];
    $upper = $_POST['upper'];
    
    print("<p> Your array size is: $rows x $cols</p>");
    
    //let's place data into a 2D array, then we will print it in a nice table.

    for($i = 0; $i < $rows; $i++) {
        for($j = 0; $j < $cols; $j++) {
            //note the syntax below for a "push" operation
            //we are pushing data on to the array
            //first for row 0 we push all the columns,
            //then row 1, push a new value each time through this inner loop.
            $data[$i][] = rand($lower,$upper); 
            //the following will work as well:
            //$data[$i][$j] = rand(0,20);
        }
    }
    $myArr = [];
    for($i=0; $i<$rows; $i++)

    {
        for($j=0;$j<$cols;$j++)
        {
            array_push($myArr,$data[$i][$j]);
        }
    }
    //Getting the minimum value and maximum value of the data array
    $min = 0;
    $max = 0;
    for($w = 0; $w < count($myArr); $w++)
    {
        
        if($min > $myArr[$w])
        {
            $temp = $myArr[$w];
            $min = $temp;
        }
        if($max < $myArr[$w])
        {
            $temp2 = $myArr[$w];
            $max = $temp2;
        }
        
    }

    print("<p> The Minimum value of your array is: $lower </p>" ); //printing minimum value in your array
    print("<p> The Maximum value of your array is:  $upper </p>"); //printing the maximum value in your array
    //print("<p> The lower bound is: $lower </p>"); //printing the lower bounds based on input
    //print("<p> The upper bound is: $upper </p>"); //printing the upper bounds based on input

    //now we need to print a table with our values:
    //either of the next two lines will work for the table tag in html
    //print("<table border = \"3\"><tr>");
    print("<table border = '3'><tr>");
    for($i = 0; $i < $cols; $i++) {
        print("<th>$i</th>");
    }
    print("</tr>");
    
    for($i = 0; $i < $rows; $i++) { //for rows
        print("<tr>");
        for($j = 0; $j < $cols; $j++) { //for columns
            print("<td align='right'>".$data[$i][$j]."</td>");//the'.' is like the '+' to concatenate the strings
        }
        print("</tr>");//ends the current row
    }
   print("</table>"); //ends the table
   
   print("<p></p>");// add space inbetween tables
   //Table 2
   print("<table border = '3'><tr>");
    for($i = 0; $i < 4; $i++) {
        $str = "Row";
        $str1 = "Sum";
        $str2 = "Average";
        $str3 = "Standard Deviation";
        if($i == 0)
        {
            echo ("<th>$str</th>");
          
        }
        if($i==1)
        {
            echo "<th>$str1</th>";
          
        }
        if($i==2)
        {
            echo "<th>$str2</th>";
          
        }
        if($i==3)
        {
            echo "<th>$str3</th>";
      
        }
     
    }
    print("</tr>");
    //Function to find Standard deviation - Googled
    //I used this function in my own implementation
    function find_sd($a) 
    {
        $count = count($a);
        $v = 0;
        $avg = array_sum($a) / $count;
        foreach ($a as $i) {
            $v += pow(($i - $avg), 2);
        }
        return sqrt($v / $count);
    }

    for($i = 0; $i < $rows; $i++) { //for rows
        print("<tr>");
        print("<td align='right'>".$i."</td>");
        $rsum = 0;
        $count = 0;
        $a = [];
        for($j = 0; $j < $cols; $j++) { //for columns
            $temp = ($data[$i][$j]);
            $sum = $rsum += $temp;
            array_push($a,$data[$i][$j]);
            $count+=1;
            
        }
        $ave = $sum/$count;
        $sd = find_sd($a);
        print("<td align='right'>".$rsum."</td>");//the'.' is like the '+' to concatenate the strings
        print("<td align='right'>".round($ave,3)."</td>");
        print("<td align='right'>".round($sd,3)."</td>");
        print("</tr>");//ends the current row

    }
   print("</table>"); //ends the table
   print("<p></p>");

   //Table 3
   print("<table border = '3'>");
   $strArr = [];
    for($i = 0; $i < $rows; $i++) { //for rows
      
        for($j = 0; $j < $cols; $j++) //for cols
        { 

        print("<td align='right'>".$data[$i][$j]."</td>");//the'.' is like the '+' to concatenate the strings
        if($data[$i][$j]<0)
        {
            $neg = "Negative";
            array_push($strArr,
                $neg);
        }
        if($data[$i][$j]>0)
        {
            $pos = "Positive";
            array_push($strArr,$pos);
        }
        if($data[$i][$j]==0)
        {
            $zer = "Zero";
            array_push($strArr,$zer);
          
        }
     
        }
        print("<tr>");
        $counter = 0;
        if($counter < $cols)
        {
        foreach($strArr as $value)
        { 
            print("<td>".$value."</td>");
            $counter+=1;
        }
        if($counter == $cols)
        {
            unset($strArr);
            $strArr = [];
            print("</tr>");
        }
       
        }
        
        print("</tr>");//ends row
    

    }
print("</table>"); //ends the table
print("<p></p>"); //adds space

?>
<a href="arrayDemo.html">Return Home</a>

</body>
</html>