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

<form action="Costumerconcern.php" name="form1" method="post">

 
<div class="title">
	

 <p><b>COSTUMER CONCERN</b></p>
    <form action="" method="post">
  <input type="text" class="NAME" id="lastname" placeholder=" Costumer Name" name="costumer">

     <label>Concern </label> <textarea name="concern"></textarea>

      <input type="date" class="NAME" id="middlename" placeholder=" Date" name="date">
	  <button type="submit" name="insert" class="btn-default">SUBMIT</button>

<table>
 </form>
<tr>
                    <th>Costumer Concern</th>
                    <th>Concern</th>
                    <th>Date</th>  
                    <th>Action</th>
                
                  
                    </tr>
					<?php
   $res=mysqli_query($link,"SELECT
  *
FROM costumerconcern
ORDER BY No DESC LIMIT 5");
  while($row=mysqli_fetch_array ($res))
  { 
?>
					<tr>
			
					<td><br><?php echo $row["Costumer"];?></td>
						<td> <br><?php echo $row["Concern"];?></td>
								<td><br><?php echo $row["Date"];?></td>
							
									 <td> <br><a href="?edited=1&idx=<?php echo $row['No']; ?>"class="delete" >Delete</a>
                          </td> 
                          </tr>
                          <?php
                       
               
                      }
                                          
                       if (isset($_GET['idx']) && is_numeric($_GET['idx']))
                      {
                          $id = $_GET['idx'];
                          if ($stmt = $link->prepare("DELETE FROM Costumerconcern WHERE No = ? LIMIT 1"))
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
	mysqli_query($link,"insert into costumerconcern values(NULL,'$_POST[costumer]',
	'$_POST[concern]','$_POST[date]')");
	?>
	<script type ="text/javascript"> 
	
	window.location.href=window.location.href;
	
	</script>
	<?php
}


?>



</html>