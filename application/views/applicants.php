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
          <li class="breadcrumb-item active">Applicants</li>
        </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <p>Listing Applicants for the Offer: <b>This is a Test Offer Title</b></p>
          <hr>

          <div class="row">
            <div class="col-md-12 mb-4">
              <div class="row">
              <div class="col-sm-3 offset-sm-2 mb-4">
                <button class="btn btn-primary">Filter Candidates</button>
              </div>
              <div class="col-sm-7 mb-4">
                <form class="form-inline">
                  <label style="margin: 5px;"><b>Display Applicants</b></label>
                  <select class="form-control mb-2 mr-sm-2">
                    <option>All Applicants</option>
                    <option>Selected Applicants</option>
                    <option>Short-Listed Applicants</option>
                    <option>Rejected Applicants</option>
                    <option>Applicants to Compare</option>
                  </select>

                  <button type="submit" class="btn btn-primary mb-2">Display</button>
                </form>
              </div>
            </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-12 mb-4">

              <div class="card">
                <h6 class="card-header cardheader">NIKHIL VERMA</h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Offer Type: </b>Job Offer</p>
                      <p class="card-text"><b>Offer Location(s): </b>New Delhi, Gurgaon</p>
                    </div>
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Application Deadline: </b>1st April 2018</p>
                      <p class="card-text"><b>Joining Date: </b>25th March 2018</p>
                    </div>
                    <div class="col-md-12 mb-4">
                      <p class="card-text"><b>Skills Required: </b>General Aptitude, PHP, HTML, CSS</p>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <small class="text-muted" style="float: right;">
                    <a class="btn btn-primary" style="color: white; margin: 10px;">Access Applicants</a>
                    <a class="btn btn-primary" style="color: white; margin: 10px;">View Offer</a>
                  </small>
                </div>
              </div>

            </div>

            <div class="col-md-12 mb-4">
              <center><a class="btn btn-primary btn-lg" style="color: white;">Load More</a></center>
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
