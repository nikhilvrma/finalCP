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
                <h6 class="card-header"><b>High-School</b> <i class="fa fa-check-circle"></i></h6>
                <div class="card-body">
                  <p class="card-text"><b>Year: </b>2018</p>
                  <p class="card-text"><b>Score: </b>9.8 CGPA</p>
                  <p class="card-text"><b>School/Board/College/University: </b>Central Board of Secondary Education, New Delhi</p>
                </div>
                <div class="card-footer">
                  <a href="#" class="btn btn-danger" style="float: right; margin: 5px;"><i class="fa fa-trash"></i></a>
                  <a href="#" class="btn btn-success" style="float: right; margin: 5px;"><i class="fa fa-pencil"></i></a>
                </div>
              </div>
              </div>

              <div class="col-lg-12 mb-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" style="float: right;" data-target="#education">
                Add Education
              </button>
              </div>

              <div class="modal fade" id="education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form>
                    <div class="modal-body">

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Education Type:</label>
                            <select class="form-control" name="" required>
                              <option value="1">High School</option>
                              <option value="1">Senior Seconday (or equivalent) School</option>
                              <option value="1">Graduation</option>
                                <option value="1">Post-Graduation</option>
                              </select>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Year:</label>
                            <select class="form-control" name="" required>
                              <?php for($i=2025; $i>1960; $i--){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Score Type:</label>
                            <select class="form-control" name="" required>
                              <option>CGPA</option>
                              <option>Percentage</option>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Score:</label>
                            <input class="form-control" placeholder="Score">
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Supporting Document:</label>
                            <input type="file" class="form-control" placeholder="Score">
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>School/Education Board:</label>
                            <input type="text" class="form-control" placeholder="School/Education Board">
                            <p class="help-block"></p>
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Add Education</button>
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

  </body>

</html>
