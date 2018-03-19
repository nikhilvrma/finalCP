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
              <div class="col-sm-3 mb-4">
                <p style="font-size: 14px;">Hiring Credits Remaining<br><label style="font-size: 18px;"><b>25</b></label></p>
              </div>
              <div class="col-sm-2 mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" style="float: right;" data-target="#filters">Filter Applicants</button>
              </div>
              <div class="col-sm-7 mb-4">
                <form class="form-inline">
                  <label style="margin: 5px;"><b>Display Applicants</b></label>
                  <br>
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
                <h6 class="card-header cardheader">NIKHIL VERMA<br><br><label style="font-size: 14px;">View Profile</label></h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text" style="font-size: 14px;"><b>Skills: </b><br>
                        <ul style="font-size: 14px;">
                          <li>General Aptitude <sup style="color: red;">Premium</sup></li>
                          <li>PHP</li>
                          <li>HTML</li>
                        </ul>
                      </p>
                    </div>
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Status: </b><label style="color: green;">Selected</label></p>
                      <p class="card-text"><b>Gender: </b>Male</p>
                      <p class="card-text"><b>Location: </b>New Delhi, Delhi</p>
                    </div>
                    <div class="col-md-12 mb-4">
                      <p class="card-text"><b>E-Mail Address: </b><i>Short-List Applicant to unlock E-Mail Address</i></p>
                      <p class="card-text"><b>Mobile Number: </b><i>Short-List Applicant to unlock Mobile Number</i></p>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <small class="text-muted" style="float: right;">
                    <button  type="button"  data-toggle="modal" data-target="#message" class="btn btn-success" style="color: white; margin: 10px;">Select Applicant</button>
                    <a class="btn btn-warning" style="color: white; margin: 10px;">Short-List Applicant</a>
                    <a class="btn btn-danger" style="color: white; margin: 10px;">Reject Applicant</a>
                    <a class="btn btn-primary" style="color: white; margin: 10px;">Compare Applicant</a>
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
            <h5 class="modal-title" id="exampleModalLabel">Filter Applicants</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
          <div class="modal-body">

              <div class="row">

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Gender</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Male</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Female</label></div>
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

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>College(s)</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">JSS Academy of Technical Education, Noida</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Jaypee Institute of Information Technology, Noida</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Hindu College, New Delhi</label></div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Courses</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Bachelor of Technology- Computer Science and Engineering</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="" required><label style="margin-left: 5px;">Bachelor of Technology- Information Technology</label></div>
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

    <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Message for the Appicant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
          <div class="modal-body">

              <div class="row">

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Message</b>
                  <div style="margin-top: 10px;">
                    <textarea class="form-control"></textarea>
                    <p class="help-text" style="font-size: 14px;"><i>leave blank if you do not want to leave message for the Applicant</i></p>
                  </div>
                </div>
              </div>



              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success">Select Applicant</button>
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
