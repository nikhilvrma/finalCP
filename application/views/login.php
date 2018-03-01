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

        <div class="col-lg-12 mb-4">

            <div class="row">

              <div class="col-md-6 offset-md-3" style="margin-top: 20px;">

                <form name="<?php echo base_url('functions/login'); ?>" method="post">

                <div class="col-md-12 mb-4 control-group form-group">
                  <center><img src="<?php echo base_url('assets/images/cp_logo.png'); ?>" class="img-responsive" style="width: 80%"></center>
                </div>

                <div class="col-md-12 mb-4 control-group form-group">
                  <div class="controls">
                    <label><b>Username:</b></label>
                    <input type="text" class="form-control" name="username" required placeholder="Username">
                    <p class="help-block"></p>
                  </div>
                </div>

                <div class="col-md-12 mb-4 control-group form-group">
                  <div class="controls">
                    <label><b>Password:</b></label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                    <p class="help-block"></p>
                  </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary" id="sendMessageButton" style="float: right;">Login</button>
              </form>

              </div>
            </div>



        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
