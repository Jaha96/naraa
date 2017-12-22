<!DOCTYPE html>
<html lang="en">
<style>
  #dropBox {
    border: 3px dashed #0087F7;
    border-radius: 5px;
    background: #F3F4F5;
    cursor: pointer;
  }

  #dropBox {
    min-height: 150px;
    padding: 54px 54px;
    box-sizing: border-box;
  }

  #dropBox p {
    text-align: center;
    margin: 2em 0;
    font-size: 16px;
    font-weight: bold;
  }

  #fileInput {
    display: none;
  }

  .margin-top-20{
    margin-top: 20px;
  }
</style>
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
                <h3 class="page-header">
                  <i class="fa fa-file-text-o"></i> Ном бүртгэл</h3>
                <ol class="breadcrumb">
                  <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Нүүр</a>
                  </li>
                  <li>
                    <i class="icon_document_alt"></i>Ном</li>
                  <li>
                    <i class="fa fa-file-text-o"></i>Бүртгэл</li>
                </ol>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <section class="panel">
                  <header class="panel-heading">
                    Basic Forms
                  </header>
                  <div class="panel-body">
                    <form id="bookCreateForm" role="form">
                        <input name="datatype" id="datatype" type="hidden">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Нэр</label>
                          <input name="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Зохиолч</label>
                          <input name="author" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Категори</label>
                          <select name="category" class="form-control m-bot15">
                            <option value="1">Адал явдал</option>
                            <option value="2">Инээдэм</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Тоо</label>
                          <input name="quantity" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Үнэ</label>
                          <input name="price" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea name="description" placeholder="Дэлгэрэнгүй тайлбар" rows="5" type="text" class="form-control"></textarea>
                      </div>
                    </form>
                    <form class="margin-top-20">
                      <div id="dropBox">
                        <p>Оруулах зурган файл сонгоно уу. </p>
                      </div>
                      <input type="file" name="fileInput" id="fileInput" />
                    </form>
                    <button onclick="$('#bookCreateForm').submit()" class="btn btn-primary margin-top-20">Хадгалах</button>
                  </div>
                </section>
              </div>
            </div>

            <!-- page end-->
          </section>
        </section>
    </section>
    <!-- container section end -->

    <?php
      include "shared/footer.html";
    ?>

      <script>
        $(document).ready(function () {
          $('#bookCreateForm').submit(function (e) {
            e.preventDefault();
            $("#datatype").val("data");
            $.ajax({
                type: 'POST',
                url: '../services/book.php',
                data: $(this).serialize()
              })
              .done(function (data) {
                alert(data);
              })
              .fail(function () {
                alert("Posting failed.");

              });
            return false;
          });
        });


        $(function () {
          //file input field trigger when the drop box is clicked
          $("#dropBox").click(function () {
            $("#fileInput").click();
          });

          //prevent browsers from opening the file when its dragged and dropped
          $(document).on('drop dragover', function (e) {
            e.preventDefault();
          });

          //call a function to handle file upload on select file
          $('input[type=file]').on('change', fileUpload);
        });

        function fileUpload(event) {
          //notify user about the file upload status
          $("#dropBox").html(event.target.value + " Ачаалж байна...");

          //get selected file
          files = event.target.files;

          //form data check the above bullet for what it is  
          var data = new FormData();

          //file data is presented as an array
          for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image.*')) {
              //check file type
              $("#dropBox").html("Оруулах зурган файл сонгоно уу.");
            } else if (file.size > 1048576) {
              //check file size (in bytes)
              $("#dropBox").html("Таны оруулсан зургын хэмжээ их байна (>1 MB)");
            } else {
              //append the uploadable file to FormData object
              debugger;
              data.append('file', file, file.name);

              //create a new XMLHttpRequest
              var xhr = new XMLHttpRequest();

              //post file data for upload
              xhr.open('POST', '../services/book.php', true);
              xhr.send(data);
              xhr.onload = function () {
                //get response and show the uploading status
                var response = JSON.parse(xhr.responseText);
                if (xhr.status === 200 && response.status == 'ok') {
                  $("#dropBox").html("Зураг амжилттай хуулагдлаа");
                } else if (response.status == 'type_err') {
                  $("#dropBox").html("Зөвхөн зураг оруулна уу.");
                } else {
                  $("#dropBox").html("Алдаа гарлаа, дахин оролдоно уу");
                }
              };
            }
          }
        }
      </script>

  </body>

</html>