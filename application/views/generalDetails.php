<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url('/assets/css/croppie.css'); ?>" rel="stylesheet">
    <title><?php echo $pageTitle."|Backoffice-CampusPuppy"; ?></title>

    <?php echo $headerFiles; ?>

  </head>

  <body>

    <?php echo $nav; ?>

    <div class="container" style="margin-top: 10px;">


      <?php if($message['content']!=''){?>

      <ol class="breadcrumb" style="background-color: white !important; margin-top: 20px; border: 1px solid <?=$message['color']?>;">
        <li style="color: <?=$message['color']?>;"><?=$message['content']?></li>
      </ol>
    	<?php }?>

      <div class="row">

        <?php echo $sidebar; ?>

        <div class="col-lg-9 mb-4">

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>

          <form method="post" action="<?php echo base_url('functions/updateGeneralDetails'); ?>">

            <div class="row">



              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Full Name:</b></label>
                  <input type="text" class="form-control" value="<?php echo $generalData['name']; ?>" disabled>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>E-Mail Address:</b></label>
                  <input type="email" class="form-control" value="<?php echo $generalData['email']; ?>" disabled>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Mobile Number:</b></label>
                  <input type="text" maxlength="10" class="form-control" value="<?php echo $generalData['mobile']; ?>" disabled>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Career Objective:</b></label>
                  <textarea class="form-control" id="careerObjective" name="careerObjective" required>
                     <?php echo $generalData['careerObjective']; ?>
                  </textarea>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Company Name:</b></label>
                  <input type="text" class="form-control" placeholder="Company Name">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Company Description:</b></label>
                  <textarea class="form-control" id="companyDescription"></textarea>
                  <p class="help-block"></p>
                </div>
              </div>


            </div>

            <button type="submit" class="btn btn-lg btn-primary" id="sendMessageButton" style="float: right;">Update General Details</button>
          </form>

          <div class="clearfix"></div>

          <h3 class="mt-4 mb-3" style="float: right;">Profile Image</h3>
          <div class="clearfix"></div>
          <hr>
          <div class="row">

          <div class="col-md-4 mb-4">
            <b>Current Profile Image</b>
            <center><img src="<?php echo $_SESSION['user_data']['profileImage']; ?>" style="width: 100%;"></center>
          </div>

          <div class="col-md-8 mb-4">
            <b>Upload New Profile Image</b>

           
                <br>

                <div class="col-md-12 control-group form-group">
                  <div class="controls">
                   <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile Image</button>
                  </div>
                </div>





          </div>
        </div>

        <div class="clearfix"></div>

        <h3 class="mt-4 mb-3" style="float: right;">Company Logo</h3>
        <div class="clearfix"></div>
        <hr>
        <div class="row">

        <div class="col-md-5 mb-4">
          <b>Current Uploaded Company Logo</b>
          <p style="margin-top: 20px; font-size: 14px;">No Logo Uploaded Yet</p>
        </div>

        <div class="col-md-7 mb-4">
          <b>Upload New Company Logo</b>

          


              <br>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <button type="submit" class="btn btn-primary"  data-toggle="modal" data-target="#myModal2" >Update Company Logo</button>
                </div>
              </div>





            

        </div>
      </div>

        </div>
      </div>

    </div>

    <div class="modal fade" role="dialog" id="myModal">
    <div class="modal-dialog">
   <div class="modal-content">
    
       
     <div class="modal-body">
      <h3>Edit Profile Pic</h3>
      <form action="<?php echo base_url('functions/updateProfileImage'); ?>" method="POST" class="form" enctype="multipart/form-data">
        <div class="horizontal-group">
          <div class="form-group">
            <div class = "inputPic">
              <label>New Profile Image:</label>
              <input type="file" class="form__input updatedUserPic" id="updatedUserPic" required accept="image/*" name = img[]>
              <input type="hidden" name="profilePic">
              <p class="help-block" style="font-size: 14px;">Formats allowed include .jpg, .jpeg, and .png<br>Maximum file size allowed in 4 MB</p>
            </div>
          </div>
        </div>
        <div class = "form-group">
          <div class = "crop" style = "display:none">
            <img src="" alt="" id="cropped-pic" hidden style ="padding-left: 25%">
          </div>
        </div>
        <div class="form-group action-bar">
           <button type="button" class="btn btn-default close-save_pic" data-dismiss="modal" style="display: none">Close</button>
          <input type = 'submit'  class="btn btn--primary save_pic" value="Save Changes" style="display: none">
        </div>
      </form>
        <div class="form-group action-bar" style="float: right">
         <button type="button" class="btn btn-default close-upload-pic" data-dismiss="modal">Close</button>
          <button class="btn btn--primary upload-pic">Upload Image</button>
        </div>
    </div>
  </div>
</div>
  </div>

      <div class="modal fade" role="dialog" id="myModal2">
    <div class="modal-dialog">
   <div class="modal-content">
    
       
     <div class="modal-body">
      <h3>Edit Company Logo</h3>
      <form action="<?php echo base_url('functions/updateCompanyImage'); ?>" method="POST" class="form" enctype="multipart/form-data">
        <div class="horizontal-group">
          <div class="form-group">
            <div class = "inputLogo">
              <label>New Company Logo:</label>
             <input type="file" class="form__input logo" id="logo" required accept="image/*" name = img[]>
              <input type="hidden" name="companyLogo">
              <p class="help-block" style="font-size: 14px;">Formats allowed include .jpg, .jpeg, and .png<br>Maximum file size allowed in 4 MB</p>
            </div>
          </div>
        </div>
       <div class = "form-group">
          <div class = "demo" style = "display:none">
            <img src="" alt="" id="cropped-img" hidden style ="padding-left: 25%">
          </div>
        </div>
        <div class="form-group action-bar">
           <button type="button" class="btn btn-default close-submit-changes" data-dismiss="modal" style="display: none">Close</button>
          <input type = 'submit'  class="btn btn--primary submit-changes" value="Save Changes" style="display: none">
        </div>
      </form>
        <div class="form-group action-bar" style="float: right">
         <button type="button" class="btn btn-default close-upload-result" data-dismiss="modal">Close</button>
          <button class="btn btn--primary upload-result">Upload Image</button>
        </div>
    </div>
  </div>
</div>
  </div>


    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script src="<?= base_url('assets/js/croppie.js')?>"></script>
    <script>
      $(document).ready(function(){
        editor = CKEDITOR.replace('careerObjective');
        editor = CKEDITOR.replace('companyDescription');
      });
      </script>

      <script type="text/javascript">
  var $uploadImage;

  function readFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $uploadImage.croppie('bind', {
          url: e.target.result
        });
        $('.crop').show();
      }
      reader.readAsDataURL(input.files[0]);
    }
    else {
      alert("Sorry - you're browser doesn't support the FileReader API");
    }
  }
  $uploadImage = $('#cropped-pic').croppie({
    viewport: {
      width: 400,
      height: 400,
      type: 'square'
    },
    boundary: {
      width: 450,
      height: 450,
    },
    exif: false
  });


  $('#updatedUserPic').on('change', function () { readFile(this)});
  $('.upload-pic').on('click', function () {
      $uploadImage.croppie('result',{
        type: 'canvas',
        size: 'viewport',
        format:'jpeg'
      }).then(function (resp) {
        console.log(resp)
        $('.upload-pic').hide();
        $('.save_pic').show();
         $('.close-upload-pic').hide();
        $('.close-save_pic').show();
        $('.cr-boundary').hide();
        $('.cr-slider-wrap').hide();
        $('.inputPic').hide();
        $('#cropped-pic').attr('src', resp)
        $('#cropped-pic').show()
        $('input[name="profilePic"]').val(resp)
        $('#userProfilePic').hide()
      });
    });
  </script>

  <script type="text/javascript">
  var $uploadCrop;

  function readImgFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        console.log(e.target.result)
        $uploadCrop.croppie('bind', {
          url: e.target.result
        });
        $('.demo').show();
      }
      reader.readAsDataURL(input.files[0]);
    }
    else {
      alert("Sorry - you're browser doesn't support the FileReader API");
    }
  }
  $uploadCrop = $('#cropped-img').croppie({
    viewport: {
      width: 400,
      height: 400,
      type: 'square'
    },
    boundary: {
      width: 450,
      height: 450,
    },
    exif: false
  });

  $('#logo').on('change', function () { readImgFile(this)});
  $('.upload-result').on('click', function () {
      $uploadCrop.croppie('result',{
        type: 'canvas',
        size: 'viewport',
        format:'jpeg'
      }).then(function (resp) {
        console.log(resp)
        $('.upload-result').hide();
        $('.submit-changes').show();
         $('.close-upload-result').hide();
        $('.close-submit-changes').show();
        $('.cr-boundary').hide();
        $('.cr-slider-wrap').hide();
        $('.inputLogo').hide();
        $('#cropped-img').attr('src', resp)
        $('#cropped-img').show()
        $('input[name="companyLogo"]').val(resp)
      });
    });
  </script>




  </body>

</html>
