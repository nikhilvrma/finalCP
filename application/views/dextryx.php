<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle; ?></title>

    <?php echo $headerFiles; ?>
    <link href='https://fonts.googleapis.com/css?family=Kaushan Script' rel='stylesheet'>

  </head>

  <body style="background-image: url(<?php echo base_url('assets/images/home_page_bg.png') ?>);">

    <nav class="navbar fixed-top nav-bg navbar-expand-lg navbar-dark bg-dark fixed-top" style="height: 110px;">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img class="img-responsive" src="<?php echo base_url('assets/images/cp_logo_white.png'); ?>" style="width: 30%; margin: 10px;">
        </a>

        <div class="collapse navbar-collapse" id="navbarResponsive">
        <form method="post" action="<?php echo base_url('functions/login'); ?>">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" style="margin-right: 10px;">
            <label style="color: white;"><b>E-Mail Address</b></label>
            <input type="text" name="email" placeholder="E-Mail Address" style="padding: 5px;">
          </li>
          <li class="nav-item" style="margin-right: 10px;">
            <label style="color: white;"><b>Password</b></label>
            <input type="password" name="password" placeholder="Password" style="padding: 5px;">
            <a style="color: white; font-size: 12px;">Forgot Password?</a>
          </li>
          <li class="nav-item">
            <button type="submit" class="btn btn-primary" style="margin: auto; border-color: white !important; margin-top: 30px;">Sign In</button>
          </li>
        </ul>
        </form>
    </div>


      </div>
    </nav>



    <div class="container" style="margin-top: 70px;">


      <?php if($message['content']!=''){?>
      <ol class="breadcrumb" style="background-color: white !important; margin-top: 20px; border: 1px solid <?=$message['color']?>;">
        <li style="color: <?=$message['color']?>;"><?=$message['content']?></li>
      </ol>
    	<?php }?>

      <div class="row">


        <div class="col-lg-12 mb-4">




            <div class="row">

              <div class="col-lg-7 mb-4">
              <div class="card h-100" style="opacity: 0.9">

                <div class="card-body">


                  <img src="<?php echo base_url('assets/images/dextryx/campuspuppy.jpg'); ?>" style="width: 30%;">
                  <label style="color: black;"><b>and</b></label>
                  <img src="<?php echo base_url('assets/images/dextryx/hcl.jpg'); ?>" style="width: 30%;">
                  <br><br>
                  <center><label style="color: black;"><b>presents</b></label></center>
                  <br>
                  <center><img src="<?php echo base_url('assets/images/dextryx/dextryx.jpg'); ?>" style="width: 70%;"></center>
                  <br>
                  <center><label style="color: black; font-size: 13px;"><b>Co-Powered by</b></label></center>
                  <center><label style="color: #E91E63; font-family: 'Kaushan Script'; font-size: 26px;">The Pink Feeds</label></center>
                  <br>
                  <center><p style="font-size: 13px;"><b>26th April 2018 - 28th April 2018</b></p></center>
                  <p style="font-size: 13px;"><b>Registrations Open: </b>16th April 2018</p>
                  <p style="font-size: 13px;">Tired of hunting for your dream internship? Organized by ​CampusPuppy ​in association with HCL​, Dextryx​, is a Virtual Internship Fest, for all the budding professionals to come on board and try their hands on securing internships in their definitive fields of interests. Dextryx is aiming to be an extravagant Virtual Internship Fest to be ever held in the country.</p>




                </div>


              </div>
            </div>

          <div class="col-lg-5 mb-4">
          <div class="card h-100" style="opacity: 0.9">
            <h5 class="card-header cardheader"><center>REGISTER</center></h5>

            <div class="card-body">


              <form method="post" action="<?php echo base_url('functions/register'); ?>">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="name"><b>Name</b></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="email"><b>E-Mail Address</b></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-Mail Address">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="mobile"><b>Mobile Number</b></label>
                    <input type="text" class="form-control" maxlength="10" name="mobile" id="mobile" placeholder="Mobile Number">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="password"><b>Password</b></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="cpassword"><b>Confirm Password</b></label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="type"><b>You are a _____?</b></label>
                    <select class="form-control" name="accountType" id="type">
                      <option value="1">Internship Opportunity Seeker</option>
                      <option value="2">Employer</option>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-10 offset-md-1">
                    <p class="help-text" style="font-size: 14px;">By clicking register button you agree to our <b>Terms and Condition</b> and <b>Privacy Policy</b>.</p>
                  </div>
                </div>
                <center><button type="submit" class="btn btn-lg btn-primary">Register</button></center>

              </form>


            </div>


          </div>
        </div>









            </div>


        </div>



      </div>

    </div>


    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script>
      $(document).ready(function(){
        editor = CKEDITOR.replace('careerObjective');
      });
      </script>

  </body>

</html>
