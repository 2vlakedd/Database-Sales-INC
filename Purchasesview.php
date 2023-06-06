<html>
<title>PURCHASES</title>
<head>

<style>
td{
 text-align: center;
	border:1px;
 border-style: solid ;

}
table{
	
	padding-top:20px;
	
}

th{
 
  margin-left: auto;
  margin-right: auto;
  width: 1%;
	padding:10px;
	border:1px;
 border-style: solid ;
background:#3E8DA8;

  
}
input{
 margin-left: auto;
  margin-right: auto;
  width: 100%;
	padding:10px;
	border:1px;
 border-style: solid ;
background:#3E8DA8;
}

</style>

<?php
include "connection.php";

?>
</head>



<body>
 <?php  include_once ('Welcome.php'); ?>

<form action="Purchasesview.php" name="form1" method="post">

 
<div class="title">
	

 <p><b>PURCHASES</b></p>
 
 <input type="text" class="NAME" id="lastname" placeholder=" Product" name="product">
<table>
 </form>
<tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date - Time</th>
              
                
                  
                    </tr>
					<?php
   $res=mysqli_query($link,"SELECT
  *
FROM purchases
ORDER BY No DESC LIMIT 5");
  while($row=mysqli_fetch_array ($res))
  { 
?>
							<tr>
			<center>
					<td>  <br><?php echo $row["Product"];?></td>
						<td> <br><?php echo $row["Description"];?></td>
							<td>  <br><?php echo $row["Amount"];?> </td>
								<td> <br><?php echo $row["Date"];?></td>
							
								       </td> 
									   		</center>
                          </tr>
						  <?php
  }
						  ?>