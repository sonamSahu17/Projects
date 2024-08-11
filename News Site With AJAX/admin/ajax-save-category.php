<?php
        
                    include 'config.php';
                    $category = mysqli_real_escape_string($conn, $_POST['addCatName']);
                    /* query for check input value exists in category table or not*/
                    $sql = "SELECT category_name FROM category where category_name='{$category}'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {

                      // if input value exists
                      echo 0;  
                    } else {
                        // if input value not exists
                        /* query for insert record in category name */
                        $sql = "INSERT INTO category (category_name)
                                    VALUES ('{$category}')";

                        if (mysqli_query($conn, $sql)) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    }
                
                mysqli_close($conn);
                ?>