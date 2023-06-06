<html>
<title>JOB ORDER</title>
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

<form action="Joborder.php" name="form1" method="post">

 
<div class="title">
	

 <p><b>Job Order</b></p>
    <form action="" method="post">
  <input type="text" class="NAME" id="lastname" placeholder=" Job Order Number" name="joborderno">
<input type="text" class="NAME" id="lastname" placeholder=" Name" name="name">
<input type="number" class="NAME" id="lastname" placeholder="Contact Number" name="contactno">
  <label>Job Order Date </label><input type="date" class="NAME" id="lastname"  name="joborderdate">
<input type="text" class="NAME" id="lastname" placeholder="Particular" name="particular">


     <label>Details </label> <textarea name="details"></textarea>
<input type="text" class="NAME" id="lastname" placeholder="Diagnose" name="diagnose">

	  	 
      <input type="text" class="NAME" id="middlename" placeholder="PICKUP" name="pickup">
	  <button type="submit" name="insert" class="btn-default">SUBMIT</button>

<table>
<tr>
                    <th>Job Order Number</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Job Order Date</th>
                    <th>Particular</th>
					 <th>Details</th>
					  <th>Diagnose</th>
					   <th>Pickup</th>
                	   <th>Action</th>
                
                  
                    </tr>
					<?php
   $res=mysqli_query($link,"SELECT
  *
FROM Joborder
ORDER BY No DESC LIMIT 5");
  while($row=mysqli_fetch_array ($res))
  { 
?>
					<tr>
					<td><?php echo $row["Joborderno"];?></td>
						<td> <?php echo $row["Name"];?></td>
							<td><?php echo $row["Contactno"];?> </td>
								<td><?php echo $row["Joborderdate"];?></td>
								<td><?php echo $row["Particular"];?></td>
								<td><?php echo $row["Details"];?></td>
								<td><?php echo $row["Diagnose"];?></td>
								<td><?php echo $row["Pickup"];?></td>
									 <td> <br><a href="?edited=1&idx=<?php echo $row['No']; ?>"class="delete" >Delete</a>
                          </td> 
                          </tr>
                          <?php
                       
               
                      }
                                          
                       if (isset($_GET['idx']) && is_numeric($_GET['idx']))
                      {
                          $id = $_GET['idx'];
                          if ($stmt = $link->prepare("DELETE FROM Joborder WHERE No = ? LIMIT 1"))
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
                        window.location.href = "joborder.php";
                        }, 5000); 
                      
                    </script>
            
                    <?php
                          }
                          
					  }
                      
                
                      ?>

					
					</table>
 </form>
 </div>
</body>

<?php
if (isset($_POST["insert"]))
{
	
	mysqli_query($link,"insert into Joborder values(NULL,'$_POST[joborderno]',
	'$_POST[name]','$_POST[contactno]','$_POST[joborderdate]','$_POST[particular]','$_POST[details]',
	'$_POST[diagnose]','$_POST[pickup]')");
	?>
	<script type ="text/javascript">
	
	window.location.href=window.location.href;
	
	</script>
	<?php
}

?>



</html>