<!DOCTYPE html>
<html lang="en">

<?php
    include "shared/head.html";
  ?>

<body>
  <!-- container section start -->
  <section id="container" class="">
    
  <?php
    include "shared/header.html";
  ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Номын жагсаалт</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i>Нүүр</li>
              <li><i class="fa fa-table"></i>Ном</li>
              <li><i class="fa fa-th-list"></i>Жагсаалт</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Responsive tables
              </header>
              <table class="table table-striped table-advance table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Нэр</th>
                      <th>Үнэ</th>
                      <th>Тоо</th>
                      <th>Зохиолч</th>
                      <th>Үйлдэл</th>
                    </tr>
                  </thead>
                <tbody id="booklist">
                </tbody>
              </table>

            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
 
    <?php
      include "shared/footer.html";
    ?>

    <script>
        $(document).ready(function () {
          $.ajax({
                type: "GET",
				        url: "../services/book.php?",
				        data: "type=adminbooklist",
				        success: function (data) {
                  data = $.parseJSON(data);	

				        	$.each(data, function(i, item) {
                    $("#booklist").append('<tr>'+
                      '<td>'+item.id+'</td>'+
                      '<td>'+item.name+'</td>'+
                      '<td>'+item.price+'</td>'+
                      '<td>'+item.quantity+'</td>'+
                      '<td>'+item.author+'</td>'+
                      '<td>'+
                      '<div class="btn-group">'+
                        '<a class="btn btn-success"><i class="icon_check_alt2"></i></a>'+
                        '<a class="btn btn-danger deleteButton" value="'+item.id+'"><i class="icon_close_alt2"></i></a>'+
                      '</div>'+
                    '</td>'+
                    '</tr>');
							})

				        }
			        })
			        .done(function(data){
			             
			        })
			        .fail(function() {
			         
			            // just in case posting your form failed
			            alert( "Posting failed." );
			             
			        });
        })

        $( ".deleteButton" ).click(function() {
                alert( "Handler for .click() called." );
              });
       
    </script>

</body>

</html>
 