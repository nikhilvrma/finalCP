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

              <?php if($empty == 0){?>
        <div class="col-md-12 control-group form-group">
          <div class="controls">
            <h4><b>Psychometric Traits</b></h4>
          </div>
        </div>
        <ul>
          <?php foreach($categories as $value){?>


              <li><p class="card-text"><h5><?= $value['psychometricEvaluationCategory']?><sup><b><?php if($value['responses']< 4){echo "<span style = 'color:red'>Low</span>";}elseif($value['responses'] >= 4 && $value['responses']< 7){echo "<span style = 'color:yellow'>Medium</span>";}elseif($value['responses']> 7){echo "<span style = 'color:green'>Green</span>";}?></b></sup></h5></p></li>

        <?php }?> </ul> <?php}else{?>
          <!-- <div class="col-lg-12">
            <p><center>Your Psychometric Evaluation has not been done please have your Psychometric Evaluation done Below.</center></p>
          </div> -->
        <?php } ?>
        <div class="col-md-12 control-group form-group">
          <hr>
          <div class="controls">
            <h4><b>Take Psychometric Evaluation Test</b></h5>
          </div>
        </div>
        <?php if($empty == 1){?>
        <div class="col-md-12 control-group form-group">
          <a href = "<?= base_url('psychometric-evaluation-guidelines')?>" class="btn btn-primary mb-2 btn-lg">Start Evaluation Now</a>
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
