<?php
 $servername="localhost";
 $username="root";
 $password="";
 $dbname="notes";
$conn= mysqli_connect($servername,$username,$password,$dbname);
if($conn){
    echo "yes";
}else{
    echo "no";
}
?>