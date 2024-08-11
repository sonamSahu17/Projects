<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container" id="data-load">
                      
                    </div><!-- /post-container -->
               
                      
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>

 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript">
   $(document).ready(function(){
      // Load Table Records
   function loadTable(page){
    
      $.ajax({
        url : "ajax-load.php",
        type : "POST",
        data : {page_no : page },
        success : function(data){
          $("#data-load").html(data);
        }
     });
   }
  loadTable();

  //pagination code
    $(document).on("click","ul.paginationOfIndex a",function(e){
       e.preventDefault();
        var page_id = $(this).attr("id");
        loadTable(page_id);
     })

});

</script>
<?php include 'footer.php'; ?>
