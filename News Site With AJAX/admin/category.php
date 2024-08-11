<?php include "header.php";?>
<link rel="stylesheet" href="../css/style.css"> 
<div id="success-message"></div>

<div id="admin-content">
  <div class="container" id="load-category-data">

  </div>
</div>

<div id="modal">
  <div id="modal-form">
  <div id="error-message"></div>

    <table cellpadding="10px" width="100%">
    </table>
    <div id="close-btn">X</div>
  </div>
</div>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    // Load Table Records
    function loadCategoryTable(page) {
      $.ajax({
        url: "ajax-load-category-data.php",
        type: "POST",
        data: { page_no: page },
        success: function (data) {
          $("#load-category-data").html(data);
        }
      });
    }
    loadCategoryTable();

    //pagination code
    $(document).on("click", "ul.paginationOfCategory a", function (e) {
      e.preventDefault();
      var page_id = $(this).attr("id");
      loadCategoryTable(page_id);
    });

     //Show Modal Box for add category
     $(document).on("click", ".add-category-btn", function (e) {
      e.preventDefault();

      $("#modal").show();
      $.ajax({
        url: "add-category.php",
        type: "POST",
        success: function (data) {
          
          $("#modal-form table").html(data);
        
      }
      })
    });

     //Save category add Form
    $(document).on("click", "#save-catName", function () {
      var addCatName = $("#cat-name").val();
      $.ajax({
        url: "ajax-save-category.php",
        type: "POST",
        data: {addCatName: addCatName },
        success: function (data) {
          if(addCatName == ""){
        $("#error-message").html("Please Fill Category Name !").show();
      }else{
          if (data == 0) {
            $("#error-message").hide();
            $("#success-message").hide();
            loadCategoryTable();
            $("#error-message").html("Category Already Exists !").show();
          }else if(data == 1) {
            $("#error-message").hide();
            $("#success-message").hide();
            $("#modal").hide();
            loadCategoryTable();
            $("#success-message").html("Category Add Successfully !").show();
          }else{
            $("#error-message").hide();
            $("#success-message").hide();
            $("#modal").hide();
            loadCategoryTable();
            $("#success-message").html("Category Can't Save ").show();
          }
        }
      }
      })
    });


    //Show Modal Box for update data
    $(document).on("click", ".edit-btn", function (e) {
      e.preventDefault();
      $("#modal").show();
      var studentId = $(this).attr("id");

      $.ajax({
        url: "ajax-load-update-category.php",
        type: "POST",
        data: { id: studentId },
        success: function (data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box
    $("#close-btn").on("click", function () {
      $("#modal").hide();
    });

    //Save Update Form
    $(document).on("click", "#edit-submit", function () {
      var catId = $("#edit-id").val();
      var catName = $("#edit-category-name").val();
      $.ajax({
        url: "ajax-update-category.php",
        type: "POST",
        data: { cat_id: catId, cat_name: catName },
        success: function (data) {
          if (data == 0) {
            $("#error-message").hide();
            $("#success-message").hide();
            $("#modal").hide();
            loadCategoryTable();
            $("#success-message").html(" Category already exists.").show();
          }else if(data == 1) {
            $("#error-message").hide();
            $("#success-message").hide();
            $("#modal").hide();
            loadCategoryTable();
            $("#success-message").html(" Category Updated Successfully").show();
          }else{
            $("#error-message").hide();
            $("#success-message").hide();
            $("#modal").hide();
            loadCategoryTable();
            $("#success-message").html(" Category Can't Update ").show();
          }
        }
      })
    });

    //Delete Records
    $(document).on("click", ".delete-btn", function () {
      if (confirm("Do you really want to delete this record ?")) {
        var catId = $(this).attr("id");

        $.ajax({
          url: "ajax-delete-category.php",
          type: "POST",
          data: { id: catId },
          success: function (data) {
          
          }
        });
      }
    });


  });
</script>
<?php include "footer.php"; ?>