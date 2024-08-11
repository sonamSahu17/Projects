<?php  

$output=""; 
  
  $output .=" <div class='row'>
            
            <div class='col-md-10'>
                <h1 class='admin-heading'>All Categories</h1>
            </div>

            <div class='col-md-2'>
                <a class='add-new add-category-btn save-cat-addForm' href='add-category.php'>add category</a>
            </div>

            <div class='col-md-12'>";
              //database configration
                include 'config.php';
                
                /* Calculate Offset Code */
                  $limit = 5;
                  if(isset($_POST["page_no"])){
                      $page = $_POST["page_no"];
                  }
                  else{
                      $page = 1;
                  };

                  //$page1 = htmlspecialchars($_GET["page"]);
                  $offset = ($page-1)* $limit;

              /* select query with offset and limit */
              $sql = "SELECT * FROM  category ORDER BY category_id DESC Limit {$offset},{$limit}";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  $output .=" <table class='content-table'>
                              <thead>
                                  <th>S.No.</th>
                                  <th>Category Name</th>
                                  <th>No. of Posts</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </thead>
                              <tbody>";
                    $serial = $offset + 1;
                  while($row = mysqli_fetch_assoc($result)) {
                    $output .=" <tr>
                            <td class='id'>{$serial}</td>
                            <td>{$row['category_name']}</td>
                            <td>{$row['post']}</td>
                            <td class='edit'><a href='' id='{$row["category_id"]}' class='edit-btn' ><i class='fa fa-edit '></i></a></td>
                            <td class='delete'><a href='' id='{$row["category_id"]}' class='delete-btn'> <i class='fa fa-trash-o'></i></a></td>
                        </tr>";
                        $serial++;
                  }
                  $output .= '</tbody> 
                              </table>';
                  
              // select count() query for pagination
              $sql1 = "SELECT COUNT(category_id) FROM category";
              $result_1 = mysqli_query($conn,$sql1);
              $row_db = mysqli_fetch_row($result_1);
              $total_record = $row_db[0];
             
              $total_page = ceil( $total_record / $limit);

              // show pagination
              $output .= '<ul class="pagination admin-pagination paginationOfCategory">';
                            if($page > 1){
                              $output .= "<li ><a href='' id= '" . ($page - 1) . "'> Prev </a></li>";
                            }
                            for($i = 1; $i <= $total_page; $i++){
                              if($i == $page){
                                $active = "active";
                              }else{
                                $active = "";
                              }
                              $output .= "<li class='{$active}'><a href='' id ='{$i}'>{$i}</a></li>";
                            }
                            if($total_page > $page){
                              $output .= "<li><a href='' id= '" . ($page + 1) . "'> Next </a></li>";
                            }
  
                            $output .= '</ul>';

              // show table
              echo $output;
            } else {
                echo "<h3>No Results Found.</h3>";
            }
              ?>
            </div>
        </div>
        <script type="text/javascript" src="../js/jquery.js"></script>
