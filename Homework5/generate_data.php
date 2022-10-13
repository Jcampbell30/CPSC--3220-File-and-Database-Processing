<!DOCTYPE html>
<!--	Author: Jared Campbell/Kristopher Fields - group work project.
		Date:	10/11/2022
-->
<html>
<head>
	<title>Data Generator</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>

<body>

	<?php 
        //function to insert strings into a string
       
        //To make a function in PHP use the "function" keyword, function name, paramter list
        function get_array_data($fileName) {
            $handle = fopen($fileName,"r");
            while (!feof($handle)) {
                $value = fgets($handle); //read a value (one line)
                $value = str_replace(array("\n", "\r"), '', $value);  //remove newlines
                if(!feof($handle)) {
                    $values[] = $value;		
                }
            }
            fclose($handle);
            return $values;
        }
        //$handle - file handle open for writing
		//$database - name of database to write to, as a string
		//$table - name of the table to write to, as a string
		//$columns - list of names of columns, 1D array, (Strings)
		//$values - 2D array, one record per row, of the values that actually go into the database. Note*** The values in this array must already have the single quotes around each value. Note2*** Int's do not require a quote around the value - so don't put a quote around it in your array.
        function write_table($handle, $database, $table, $columns, $values) {
            fwrite($handle, "use $database;\n\n");
            fwrite($handle, "SET AUTOCOMMIT=0;\n\n");
            //from DBeaver
            //INSERT INTO moviestore4.actor (first_name,last_name) VALUES ('Fred','Schwab');
            fwrite($handle, "INSERT INTO $database.$table (");
            for($i = 0; $i < sizeof($columns); $i++) {
                fwrite($handle, $columns[$i]);
                if($i!= sizeof($columns)-1) { // if not the last value, print comma
                    fwrite($handle, ",");
                }
            }
            fwrite($handle, ") VALUES\n");
            
            for($i = 0; $i < sizeof($values); $i++) {
                fwrite($handle, "(");
                for($j = 0; $j < sizeof($values[$i]); $j++) {
                    fwrite($handle, $values[$i][$j]);
                    if($j != sizeof($values[$i]) - 1) { //if not at last value, print comma
                       fwrite($handle, ","); 
                    }
                }
                if($i != sizeof($values)-1) { //not at last one
                    fwrite($handle, "),\n");
                } else {
                    fwrite($handle, ");\n\nCOMMIT;");
                }

            }
        }
            //function to insert strings into a string
            function stringInsert($str,$insertstr,$pos)
            {
                $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
                return $str;
            }  
            //function to return rand elemnt in array
             function randArray($a)
             {
                 $value = array_rand($a);//using built in function to return random value an array: storing in temporary variable called $value
                 return $a[$value];//return the array that was passed in as the parameter at index $value
             }
        
        //create an array of your table column names for inserting.
       
		
        $customer = array("first_name", "last_name", "email", "phone",  "address_id");
        $order = array("customer_id", "address_id");
        $productN = array("product_name", "description", "weight", "base_cost");
        $order_item = array("order_id", "product_id", "quantity", "price");
        $address = array( "street", "city", "state", "zip");
        $warehouse = array("name", "address_id");
        $product_warehouse = array("product_id", "warehouse_id");





        //create constant for the number of rows you will generate for each table
        const CUSTOMER = 100;
		const ORDER = 350;
		const PRODUCT = 750;
        const ORDER_ITEM = 550;
        const ADDRESS = 150;
        const WAREHOUSE = 25;
        const PRODUCT_WAREHOUSE = 1250;
    
    
        print("<h1>Generating SQL script</h1>");
        //must be generated in order by address, customer, order, product, warehouse, order_item, product_warehouse
        print("...");
       
		
        $firstNames = get_array_data("first_names.txt");
        $lastNames = get_array_data("last_names.txt"); 
        $domains = get_array_data("domains.txt");
        $cities = get_array_data("cities.txt");
        $product = get_array_data("products.txt");
        $streetNames = get_array_data("street_names.txt");
        $streetTypes = get_array_data("street_types.txt");
		$states = get_array_data("states.txt");
        $wName = get_array_data("Top25.txt");

        //ADDRESS Table

        $addresses = [];
        //"street", "city", "state", "zip");
        for($i = 0; $i < ADDRESS; $i++)
        {
            $street_num = rand(100,999);
            $street_t = randArray($streetTypes);
            $street_n = randArray($streetNames);
            $city = randArray($cities);
            $state = randArray($states);
            $zip = rand(10000,99999);

            $addresses[$i][0] = "'".$street_num." ".$street_n." ".$street_t."'";
            $addresses[$i][1] = "'".$city."'";
            $addresses[$i][2] = "'".$state."'";
            $addresses[$i][3] = "'".$zip."'";



        }
		

        //CUSTOMER Table

        $customers = [];
        //"first_name", "last_name", "email", "phone",  "address_id"
        for($i = 0; $i < CUSTOMER; $i++) {
            $first = randArray($firstNames);
            $last = randArray($lastNames);
            $email = $first.$last.randArray($domains);
            $TenDigitRandomNumber = mt_rand(1000000000,9999999999);
            $phone_num = (string)$TenDigitRandomNumber;
            $phone_num = stringInsert($phone_num,"-",3);
            $phone_num = stringInsert($phone_num,"-",7);
            $address_id = rand(1,ADDRESS);


            $customers[$i][0]  = "'".$first."'";;
            $customers[$i][1]  = "'".$last."'";
            $customers[$i][2]  = "'".$email."'";
            $customers[$i][3]  = "'".$phone_num."'";
            $customers[$i][4]  = "'".$address_id."'";
            

        }

        //ORDER Table

        $orders = [];
        //("customer_id", "address_id");
        for($i = 0; $i < ORDER; $i++)
        {
            $orders[$i][0] = rand(1,CUSTOMER);
            $orders[$i][1]= rand(1,ADDRESS); 
        }



        //PRODUCT Table
        $products = [];
        //"product_name", "description", "weight", "base_cost");
        for($i = 0; $i < PRODUCT; $i++)
        {
            
            $pName = randArray($product);
            $cost = rand(100,999);
            $weight = rand(100,999);
            $weight = (double)$weight;
            $weight= number_format($weight,2,".");
            $cost = (double)$cost;
            $cost = number_format($cost,2,".");
            $myStr = "is a wonderful item for you to enjoy";

            $products[$i][0] = "'".$pName."'";
            $products[$i][1] ="'".$pName."'"."'".$myStr."'";
            $products[$i][2] = $weight;
            $products[$i][3] = $cost;
          
        }

        //WAREHOUSE Table
        $warehouses = [];

        for($i = 0; $i < WAREHOUSE; $i++)
        {
            //"name", "address_id
            $name = randArray($wName);
            $warehouses[$i][0] = "'".$name."'";
            $warehouses[$i][1] = rand(1,ADDRESS);
        }

        //$order_item = array("order_id", "product_id", "quantity", "price");

        //ORDER_ITEM Table

        $order_items = [];
        for($i = 0; $i  < ORDER_ITEM; $i++)
        {
            $id = rand(1,ORDER);
            $pd = rand(1,PRODUCT);
            $pr = rand(1,99);
            $order_items[$i][0] = $id;
            $order_items[$i][1] =  $pd;
            $order_items[$i][2] =  rand(1,9);
            $order_items[$i][3] = number_format($pr,2, ".");

        }

        //PRODUCT_WAREHOUSE Table

        $product_warehouses = [];
        //"product_id", "warehouse_id"
        for($i = 0; $i < PRODUCT_WAREHOUSE; $i++)
        {
           
            $product_warehouses[$i][0] = rand(1,PRODUCT);
            $product_warehouses[$i][1] = rand(1,WAREHOUSE);
            
        }

		//$actors array is the $values array for my write_table function call.

        //Customers 
        print("<pre>");
        print_r($addresses);
        print_r($customers);
        print_r($orders);
        print_r($products);
        print_r($warehouses);
        print_r($order_items);
        print_r($product_warehouse);
        print("<\pre>");
       
      
        
        $handle = fopen("data.sql", "w");
        //write the data
        write_table($handle, "SuperStore", "address", $address, $addresses);
        write_table($handle, "SuperStore", "customer", $customer, $customers);
        write_table($handle, "SuperStore", "order", $order, $orders);
		write_table($handle, "SuperStore", "product", $productN, $products);
        write_table($handle, "SuperStore", "warehouse", $warehouse, $warehouses);
        write_table($handle, "SuperStore", "order_item", $order_item, $order_items);
        write_table($handle, "SuperStore", "product_warehouse", $product_warehouse, $product_warehouses);

        fclose($handle);
          
    print("<h1>SQL script complete!</h1>");
    
    
		
        
	?>
</body>
</html>