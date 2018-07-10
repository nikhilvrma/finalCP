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
        <?php echo $sidebar;?>

        <div class="col-lg-9 mb-4">

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>


            <div class="row">

        <div class="col-md-12 control-group form-group">
          <div class="controls">
            <h5>Psychometric Evaluation Results</h5>
          </div>
        </div>
         <?php if($empty == 0){
          foreach($categories as $value){?>

        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <h5 class="card-header cardheader"><?= $value['psychometricEvaluationCategory']?></h5>
            <div class="card-body">
              <p class="card-text"><b>Score</b><h3 style="float: right;"><?= $value['responses']?></h3></p>
            </div>
          </div>
        </div>
        <?php }}else{?>
          <div class="col-lg-12">
            <p><center>Your Psychometric Evaluation has not been done please have your Psychometric Evaluation done Below.</center></p>
          </div>
        <?php } ?>

        <div class="col-md-12 control-group form-group">
          <div class="controls">
            <h5>Take Psychometric Evaluation Test</h5>
          </div>
        </div>
        <?php if($empty == 1){?>
        <div class="col-md-12 control-group form-group">
          <a href = "<?= base_url('psychometric-evaluation-guidelines')?>" class="btn btn-primary mb-2 btn-lg">Start Evaluation</a>
        </div>
      <?php }else{
        echo 'Your Psychometric Evaluation has already been done. Your results have been posted above';
      }?>






            </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>


  </body>

</html>
