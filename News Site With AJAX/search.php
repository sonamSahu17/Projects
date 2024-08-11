
 
                  <?php
                  include "config.php";
                  if(isset($_POST['search'])){
                    $search_term = mysqli_real_escape_string($conn, $_POST['search']);
                  }
                  ?>
                  <h2 class="page-heading">Search : <?php echo $search_term; ?></h2>
                  <?php

                  /* Calculate Offset Code */
    $limit = 5;
    if(isset($_POST['page_no'])){
      $page = $_POST['page_no'];
    }else{
      $page = 1;
    }
    $offset = ($page - 1) * $limit;
    

                    $sql = "SELECT post.post_id, post.title, post.description,post.post_date,post.author,
                    category.category_name,user.username,post.category,post.post_img FROM post
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    WHERE post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%'
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit} ";
                    $output ="";
                    $result = mysqli_query($conn, $sql) or die("Query Failed.");
                 if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)) {
                        $output  .=" <div class='post-content'>
                        <div class='row'>
                            <div class='col-md-4'>
                              <a class='post-img' href='single.php?id={$row['post_id'] }'><img src='admin/upload/{$row['post_img']}' alt=''/></a>
                            </div>
                            <div class='col-md-8'>
                              <div class='inner-content clearfix'>
                                  <h3><a href='single.php?id={$row['post_id']}'>{$row['title']} </a></h3>
                                  <div class='post-information'>
                                      <span>
                                          <i class='fa fa-tags' aria-hidden='true'></i>
                                          <a href='category.php?cid={$row['category']}'>{$row['category_name']}</a>
                                      </span>
                                      <span>
                                          <i class='fa fa-user' aria-hidden='true'></i>
                                          <a href='author.php?aid={$row['author']}'>{$row['username']}</a>
                                      </span>
                                      <span>
                                          <i class='fa fa-calendar' aria-hidden='true'></i>
                                          {$row['post_date']}
                                      </span>
                                  </div>
                             
                        <p class='description'>" . substr($row['description'], 0, 130) . "...</p>
                                  <a class='read-more pull-right' href='single.php?id={$row['post_id']}'>read more</a>
                              </div>
                            </div>
                        </div>
                    </div>";
                      }
                      $sql1 = "SELECT * FROM post
                      WHERE post.title LIKE '%{$search_term}%'  
                      OR post.description LIKE '%{$search_term}%' ";
                      
                      $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
                      $total_records = mysqli_num_rows($result1);
                      $total_page = ceil($total_records / $limit);
if($total_page>1){
                      $output .= "<ul class='pagination admin-pagination paginationOfSearch' >";
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

                        $output .= "</ul>";
                      }
                      echo $output;
                      
                    }else{
                      echo "<h2>No Record Found.</h2>";
                    }
                    ?>
           
