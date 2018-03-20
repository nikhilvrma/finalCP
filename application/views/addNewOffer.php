<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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

          <form method="post" action="<?php echo base_url('functions/addOffer'); ?>">

            <div class="row">

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Offer Type:</b></label>
                  <select class="form-control" name="offerType">
                    <option value="1">Job Offer</option>
                    <option value="2">Internship Offer</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Number of Openings:</b></label>
                  <input type="text" class="form-control" name="openings">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Offer Title:</b></label>
                  <input type="text" maxlength="255" class="form-control" name="offerTitle" placeholder="Offer Title">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Offer Description:</b></label>
                  <textarea class="form-control" id="offerDescription" name="offerDescription" required>

                  </textarea>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Joining Date:</b></label>
                  <input type="date" class="form-control" name="joiningDate">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Application Deadline:</b></label>
                  <input type="date" class="form-control" name="applicationDeadline">
                  <p class="help-block"></p>
                </div>
              </div>





            </div>

            <button type="submit" class="btn btn-lg btn-primary" style="float: right;">Add Offer</button>
          </form>




        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script>
      $(document).ready(function(){
        editor = CKEDITOR.replace('offerDescription');
      });
      </script>

  </body>

</html>
