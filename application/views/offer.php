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

        <?php echo $sidebar; ?>

        <div class="col-lg-9 mb-4">
          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>
          <div class="row">

            <div class="col-md-12 mb-4">

              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Company Name: </b></p>
                      <p class="card-text"><?= $employerDetails['companyName']?></p>
                      <!-- <p class="card-text"><b>Website: </b>http://www.campuspuppy.com/</p> -->
                    </div>
                    <div class="col-md-3 mb-4">
                      <p class="card-text"><b>Share: </b></p>
                      <p class="card-text">
                        <a class="btn" style="color: white; background: #3b5998;"><i class="fa fa-facebook"></i></a>
                        <a class="btn" style="color: white; background: #1DA1F2;"><i class="fa fa-twitter"></i></a>
                        <a class="btn" style="color: white; background: #0077B5;"><i class="fa fa-linkedin"></i></a>
                      </p>
                    </div>
                    <div class="col-md-3 mb-4">
                      <p class="card-text"><b>Application Deadline: </b><br><?php echo date_format(date_create($offerDetails[0]['applicationDeadline']), 'd-F-Y');?></p>
                      <?php if($_SESSION['user_data']['accountType'] == 1 ){?>
                      <p class="card-text"><a class="btn btn-primary" style="color: white;">Apply Now</a></p>
                      <?php }?>
                    </div>
                  </div>

                </div>

              </div>
              <br>
              <div class="col-md-12 mb-4" style="font-size: 14px;">

                <p>
                <h6><b>Offer Title</b></h6>
                  <?= $offerDetails[0]['offerTitle' ]?>
                </p>

                <p>
                <h6><b>Offer Description</b></h6>
                  <?= $offerDetails[0]['offerDescription']?>
                </p>

                <p>
                <h6><b>Skill(s) Required</b></h6>
                  <ul>
                    <?php if(!empty($offerSkills))foreach($offerSkills as $skills){ ?>
                    <li><?= $skills['skill_name']?></li>
                    <?php }else echo "No Skills Required"; ?>
                  </ul>
                </p>

                <p>
                <h6><b>Location(s)</b></h6>
                  <ul>
                    <?php if(!empty($offerLocations))foreach($offerLocations as $locations){ ?>
                    <li><?= $locations['city'].', '.$locations['state'] ?></li>
                    <?php }else echo "Work From Home"; ?>
                  </ul>
                </p>

                <p>
                <h6><b>Compensation Offered</b></h6>
                <?php if(isset($offerDetails[0]['compensation'])){?>
                  INR <?= $offerDetails[0]['compensation'] ?>/- per month
                <?php }else if(isset($offerDetails[0]['minCompensation']) && isset($offerDetails[0]['maxCompensation'])){?>
                  INR <?= $offerDetails[0]['minCompensation'].' - '. $offerDetails[0]['maxCompensation'] ?>/- per month
                <?php }else{?>
                  <?php echo("No Compensation Will be awarded.")?>
                <?php } ?>
                </p>

                <p>
                <?php if($offerDetails[0]['offerType'] == 2){?>
                  <h6><b>Internship Duration</b></h6>
                    <?= $offerDetails[0]['duration'] ?> Months
                  </p>
                <?php } ?>
              </div>

            </div>


              <div class="col-md-4 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Joining Date</b></h6>
                  <?= date_format(date_create($offerDetails[0]['joiningDate']), 'd-F-Y')?>
                </p>
              </div>
              <div class="col-md-4 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Number of Opening(s)</b></h6>
                  <?= $offerDetails[0]['openings']?>
                </p>
              </div>
              <div class="col-md-4 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Part Time Allowed</b></h6>
                  <?php if($offerDetails[0]['partTime'] == 1){echo "Yes";}else{echo "No";}?>
                </p>
              </div>




          </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>


  </body>

</html>
