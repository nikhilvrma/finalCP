<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle."|CampusPuppy"; ?></title>

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


        <div class="col-lg-12 mb-4">

            <ol class="breadcrumb" style="margin-top: 30px;">
            <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
          </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>
          <p style="font-size: 15px; margin-top: 15px;">
            CampusPuppy is here to Help You. Forgot your Password. Don't Worry. Just Reset your Password Now.
          </p>
          


        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
