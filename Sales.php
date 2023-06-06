<html>
<title>COSTUMER CONCERN</title>
<head>

<style>

.title{

padding:20px;
}

.NAME {
	
	max-width:200px;
	height:50px;
}
.des {

	height:100px;
}
.btn-default{
	height:50px;
	Width:100px;
	
}
table{
	padding-top:20px;
	
}

th{
	padding:10px;
	border:1px;
 border-style: solid ;


  
}
td{

}
textarea{
	height:50px;
position:relative;
top:20px;
}
label{
	height:50px;
position:absolute;


}
p{
	
	color:#3E8DA8;
}
.delete{
background: gray;
	border:4px;
 border-style: solid ;
padding:20px;
 color:black;
 	position:relative;

 
}

</style>

<?php
include "connection.php";

?>
</head>



<body>
 <?php  include_once ('Welcome.php'); ?>

<form action="Sales.php" name="form1" method="post">

 
<div class="title">
	

 <p><b>SALES</b></p>
    <form action="" method="post">
	<input type="date" class="NAME" id="middlename" placeholder=" Date" name="date">
<input type="number" class="NAME" min="0.00" max="25000.000.00" placeholder=" Amount: 100.01"  name="amount"/>
 <input type="text" class="NAME" id="lastname" placeholder=" Product" name="product">


      
	  <button type="submit" name="insert" class="btn-default">SUBMIT</button>

<table>
 </form>
<tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Product</th>  
                    <th>Action</th>
                
                  
                    </tr>
					<?php
   $res=mysqli_query($link,"SELECT
  *
FROM Sales
ORDER BY No DESC LIMIT 5");
  while($row=mysqli_fetch_array ($res))
  { 
?>
					<tr>
			
					<td><br><?php echo $row["Date"];?></td>
						<td> <br>&nbsp₱<?php echo $row["Amount"];?></td>
								<td><br><?php echo $row["Product"];?></td>
							
									 <td> <br><a href="?edited=1&idx=<?php echo $row['No']; ?>"class="delete" >Delete</a>
                          </td> 
                          </tr>
                          <?php
                       
               
                      }
                                          
                       if (isset($_GET['idx']) && is_numeric($_GET['idx']))
                      {
                          $id = $_GET['idx'];
                          if ($stmt = $link->prepare("DELETE FROM Sales WHERE No = ? LIMIT 1"))
                          {
                              $stmt->bind_param("i",$id);
                              $stmt->execute();
                              $stmt->close();
                               ?>
                    <div class="alert alert-warning " >
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong> Successfully! </strong><?php echo'Record Successfully Deleted';?></div>
                   <script>
                       setTimeout(function () {
                        window.location.href = "costumerconcern.php";
                        }, 5000); 
                      
                    </script>
            
                    <?php
                          }
                          
					  }
                      
                
                      ?>

					
					</table>

 </div>
</body>

<?php
if (isset($_POST["insert"]))
{
	mysqli_query($link,"insert into sales values(NULL,'$_POST[date]',
	'$_POST[amount]','$_POST[product]')");
	?>
	<script type ="text/javascript"> 
	
	window.location.href=window.location.href;
	
	</script>
	<?php
}


?>



</html>