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



              <div class="col-lg-12 mb-4">
              <div class="card">
                <h6 class="card-header"><b>Campus Puppy Private Limited</b> <i class="fa fa-check-circle"></i></h6>
                <div class="card-body">
                  <p class="card-text"><b>Duration: </b>April 2018- Present</p>
                  <p class="card-text"><b>Position: </b>Co-Founder</p>
                  <p class="card-text"><b>Role: </b>blah blah blah</p>
                </div>
                <div class="card-footer">
                  <a href="#" class="btn btn-danger" style="float: right; margin: 5px;"><i class="fa fa-trash"></i></a>
                  <a href="#" class="btn btn-success" style="float: right; margin: 5px;"><i class="fa fa-pencil"></i></a>
                </div>
              </div>
              </div>

              <div class="col-lg-12 mb-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" style="float: right;" data-target="#education">
                Add Work Experience
              </button>
              </div>

              <div class="modal fade" id="education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Work Experience</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form>
                    <div class="modal-body">

                        <div class="row">
                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Company Name:</label>
                            <input type="text" class="form-control" name="" required>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Position:</label>
                            <input type="text" class="form-control" name="" required>
                          </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-12">
                        <label><b>Start Date</b></label>
                      </div>

                        <div class="col-md-8 control-group form-group">
                          <div class="controls">
                            <label>Start Month:</label>
                            <select class="form-control" name="" required>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4 control-group form-group">
                          <div class="controls">
                            <label>Start Year:</label>
                            <input type="text" class="form-control" name="" required>
                          </div>
                        </div>

                        </div>

                        <div class="row">
                          <div class="col-md-12">
                          <label><b>End Date</b></label>
                        </div>
                        <div class="col-md-8 control-group form-group">
                          <div class="controls">
                            <label>End Month:</label>
                            <select class="form-control" name="" required>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4 control-group form-group">
                          <div class="controls">
                            <label>End Year:</label>
                            <input type="text" class="form-control" name="" required>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <input type="checkbox" name="" required>
                            <label> Currently Work Here</label>
                          </div>
                        </div>

                        </div>


                        <div class="row">
                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Role:</label>
                            <textarea class="form-control" id="role" name="" required>
                            </textarea>
                          </div>
                        </div>
                        </div>


                        <div class="row">
                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Supporting Document:</label>
                            <input type="file" class="form-control" placeholder="Score">
                            <p class="help-block"></p>
                          </div>
                        </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Add Work Experience</button>
                    </div>
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
        editor = CKEDITOR.replace('role');
      });
      </script>

  </body>

</html>
