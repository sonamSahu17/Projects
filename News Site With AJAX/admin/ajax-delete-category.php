<?php
include 'config.php';

$cat_id = $_POST["id"];

/*sql to delete a record*/
$sql = "DELETE FROM category WHERE category_id ='{$cat_id}'";

if (mysqli_query($conn, $sql)) {
  echo 1;
} else {
  echo 0;
}
?>