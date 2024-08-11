<?php 
$output = "";
               
$output .="
<h3>Add Form..<h3>
<hr style=' border: 1px solid grey;'>
<h4>category Name</h4>
     <tr>    
        <td><input type='text' name='cat' class='form-control' id='cat-name' required></td>
     </tr>
     <tr> 
        <td> <input type='submit' id='save-catName' name='save' class='btn btn-primary' value='Save' style='margin-top:10px;' required/></td>
     </tr>";

echo $output;


?>
