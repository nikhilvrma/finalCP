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



              <div class="col-lg-4 mb-4">
                  <div class="card h-100">
                    <h6 class="card-header cardheader">Skill Name</h6>

                    <div class="card-body">
                      <p class="card-text">PHP</p>
                    </div>


                  </div>
                </div>


                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                      <h6 class="card-header cardheader">Remaining Test Time</h6>

                      <div class="card-body">
                        <p class="card-text">10:00</p>
                      </div>


                    </div>
                  </div>

                  <div class="col-lg-4 mb-4">
                      <div class="card h-100">
                        <h6 class="card-header cardheader">Remaining Question Time</h6>

                        <div class="card-body">
                          <p class="card-text">10:00</p>
                        </div>


                      </div>
                    </div>


                  <div class="col-lg-12 md-4">
                    <p class="mcq" style="float: right;"><a style="font-size: 16px;">Skip Question (<b>Skips Left: </b>4)</a></p>
                    <p class="mcq"><strong>Question</strong></p>
                    <div class="mcq" id = "question">This is the Test Question</div>
                                <div class="options">
                      <div class = 'option'>
                        <span class="opt">A</span>
                        <input type="radio" name="answer" id="optionA" value="1" />
                        <label for="optionA" id = 'option1'>Option 1</label>
                      </div>
                      <div class = 'option'>
                        <span class="opt">B</span>
                        <input type="radio" name="answer" id="optionB" value="2" />
                        <label for="optionB" id = 'option2'>Option 2</label>
                      </div>
                      <div class = 'option'>
                        <span class="opt">C</span>
                        <input type="radio" name="answer" id="optionC" value="3" />
                        <label for="optionC" id = 'option3'>Option 3</label>
                      </div>
                      <div class = 'option'>
                        <span class="opt">D</span>
                        <input type="radio" name="answer" id="optionD" value="4" />
                        <label for="optionD" id = 'option4'>Option 4</label>
                      </div>
                    </div>

                    <center>
                                  <button id="reset" class="btn btn-primary" style="margin-top: 10px;">RESET</button>
                                  <button class="btn btn-primary submitAns" style="margin-top: 10px;">SUBMIT</button>
                              </center>


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
