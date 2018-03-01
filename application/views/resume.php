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


            <div class="row">

              <div class="col-lg-12 mb-4">
              <div class="card">
                <h6 class="card-header cardheader">CampusPuppy Resume Reference Number</h6>
                <div class="card-body">
                  <h1>CPRasnd08283nasdk</h1>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="sendMessageButton" style="float: right;"><i class="fa fa-download"></i> Download Resume</button>
                </div>
              </div>
              </div>

            </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
