<?php  

//connect to the database 
$connect = mysql_connect("localhost","root","1234"); 
mysql_select_db("csv",$connect); //select the table 
// 

if($_FILES['csv']['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    $password   = $data[0];
    $salt       = sha1(md5($password));
    $password2  = md5($password.$salt);
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            $password   = $data[0];
            $salt       = sha1(md5($password));
            $password2  = md5($password.$salt);
            mysql_query("INSERT INTO contacts (contact_first, contact_last, contact_email) VALUES 
                ( 
                    '".addslashes($password2)."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."' 
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: import.php?success=1'); die; 

} 

?> 