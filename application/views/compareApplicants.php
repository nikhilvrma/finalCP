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

          <ol class="breadcrumb" style="margin-top: 30px;">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('general-details'); ?>">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('my-added-offers'); ?>">My Added Offers</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('my-added-offers'); ?>">Applicants</a>
          </li>
          <li class="breadcrumb-item active">Compare Applicants</li>
        </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <p>Comparing Applicants for the Offer: <b>This is a Test Offer Title</b></p>
          <hr>
          <?php var_dump($candidates);?>
          <div class="row">

            <div class="col-md-12 mb-4">

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="width: 28%;">Name</th>
                    <?php if(isset($candidates['userDetails'][0])){?>
                    <th scope="col" style="background: #2c3e50; color: white; width: 36%;"><?= $candidates['userDetails'][0][0]['name']?><br><p style="font-size: 14px; float: right; color: red;">Remove from Compare</p></th>
                    <?php }if(isset($candidates['userDetails'][1])){?>
                    <th scope="col" style="background: #2c3e50; color: white; width: 36%;"><?= $candidates['userDetails'][1][0]['name']?><br><p style="font-size: 14px; float: right; color: red;">Remove from Compare</p></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Gender</th>
                    <td>Male</td>
                    <td>Female</td>
                  </tr>
                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">High-School</label></th>
                    <td><p style="font-size: 14px;">Central Board of Secondory Education, New Delhi<br><b>Score: </b>90%<br><b>Batch: </b>2009</p></td>
                    <td><p style="font-size: 14px;">Central Board of Secondory Education, New Delhi<br><b>Score: </b>95%<br><b>Batch: </b>2010</p></td>
                  </tr>
                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">Graduation</label></th>
                    <td><p style="font-size: 14px;">JSS Academy of Technical Education, Noida<br><b>Course: </b>Bachelor of Technology- Computer Science and Engineering<br><b>Score: </b>90%<br><b>Batch: </b>2016</p></td>
                    <td><p style="font-size: 14px;">JSS Academy of Technical Education, Noida<br><b>Course: </b>Bachelor of Technology- Information Technology<br><b>Score: </b>90%<br><b>Batch: </b>2016</p></td>
                  </tr>
                  <tr>
                    <th scope="row">Skill:<br><label style="float: right;">PHP</label></th>
                    <td>68% <sup style="color: red;"><b>Premium</b></sup></td>
                    <td>54%</td>
                  </tr>
                  <tr>
                    <th scope="row">Skill:<br><label style="float: right;">General Aptitude</label></th>
                    <td>Skill Not Found</td>
                    <td>54%</td>
                  </tr>
                  <tr>
                    <th scope="row"></th>
                    <td>
                      <a class="btn btn-success" style="color: white; margin: 10px;">Select Applicant</a>
                      <hr>
                      <a class="btn btn-warning" style="color: black; margin: 10px;">Short-List Applicant</a>
                      <hr>
                      <a class="btn btn-danger" style="color: white; margin: 10px;">Reject Applicant</a>
                    </td>
                    <td>
                      <a class="btn btn-success" style="color: white; margin: 10px;">Select Applicant</a>
                      <hr>
                      <a class="btn btn-warning" style="color: black; margin: 10px;">Short-List Applicant</a>
                      <hr>
                      <a class="btn btn-danger" style="color: white; margin: 10px;">Reject Applicant</a>
                    </td>
                  </tr>
                </tbody>
              </table>

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
