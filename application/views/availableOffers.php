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

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>
          <div class="row">
            <div class="col-md-12 mb-4">
              <div class="row">

              <div class="col-sm-5 mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" style="float: right;" data-target="#filters">Filter Offers</button>
              </div>
              <div class="col-sm-7 mb-4">
                <form class="form-inline" style="float: right;">
                  <label style="margin: 5px;"><b>Display Offers</b></label>
                  <br>
                  <select class="form-control mb-2 mr-sm-2">
                    <option>All Available Offers</option>
                    <option>My Relevant Offers</option>
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
                <h6 class="card-header cardheader">Good Morning, this is a Test Job Offer to count number of Characters, Good Morning, this is a Test Job Offer to count number of Characters</h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Offer Type: </b>Job Offer</p>
                      <p class="card-text"><b>Offer Location(s): </b>New Delhi, Gurgaon</p>
                    </div>
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Status: </b><label style="color: green;"><b>Selected</b></label></p>
                      <p class="card-text"><b>Joining Date: </b>25th March 2018</p>
                    </div>
                    <div class="col-md-12 mb-4">
                      <p class="card-text"><b>Skills Required: </b>General Aptitude, PHP, HTML, CSS</p>
                      <p class="card-text"><b>Message from the Employer: </b>None</p>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <small class="text-muted" style="float: right;">
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

    <div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Offers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
          <div class="modal-body">

              <div class="row">

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Offer Type</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Job Offers</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Internship Offers</label></div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Skills</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">HTML</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">CSS</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">PHP</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">General Aptitude</label></div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Location</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">New Delhi, Delhi</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Gurgaon, Haryana</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Noida, Uttar Pradesh</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Ghaziabad, Uttar Pradesh</label></div>
                  </div>
                </div>
              </div>

              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Apply</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>


  </body>

</html>
