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

    <div class="container">



      <?php if($message['content']!=''){?>
      <ol class="breadcrumb" style="background-color: white !important; border: 1px solid <?=$message['color']?>;">
        <li style="color: <?=$message['color']?>;"><?=$message['content']?></li>
      </ol>
    	<?php }?>


      <div class="row">

        <?php echo $sidebar; ?>

        <div class="col-lg-9 mb-4">

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>

          <form name="sentMessage" id="contactForm" novalidate>

            <div class="row">

              <div class="col-md-12 mb-4 control-group form-group">
                <div class="controls">
                  <label>Current Password:</label>
                  <input type="password" class="form-control" name="currentPassword" required placeholder="Current Password">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 mb-4 control-group form-group">
                <div class="controls">
                  <label>New Password:</label>
                  <input type="password" class="form-control" name="newPassword" required placeholder="New Password">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 mb-4 control-group form-group">
                <div class="controls">
                  <label>Confirm New Password:</label>
                  <input type="password" class="form-control" name="confirmNewPassword" required placeholder="Confirm New Password">
                  <p class="help-block"></p>
                </div>
              </div>

            </div>

            <button type="submit" class="btn btn-lg btn-primary" id="sendMessageButton" style="float: right;">Change Password</button>
          </form>

        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
