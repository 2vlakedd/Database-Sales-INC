<?php
include "connection.php";
$no=$_GET["id"||"id1"]

mysqli_query($link,"delete from Purchases where No Like $no");
?>
<script type="text/javascript">
window.location="Purchases.php";
</script>
<?php
include "connection.php";
$no=$_GET["id1"];
mysqli_query($link,"delete from Inventories where No Like $no");
?>
<script type="text/javascript">
window.location="Purchases.php";
</script>

