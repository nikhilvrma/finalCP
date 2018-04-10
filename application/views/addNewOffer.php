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

          <form method="post" action="<?php echo base_url('functions/addOffer'); ?>">

            <div class="row">

              <div class="col-md-6 control-group form-group offerType">
                <div class="controls">
                  <label><b>Offer Type:</b></label>
                  <select class="form-control" name="offerType" id ="offerType">
                    <option value="1">Job Offer</option>
                    <option value="2">Internship Offer</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group openings">
                <div class="controls">
                  <label><b>Number of Openings:</b></label>
                  <input type="text" class="form-control" name="openings">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Offer Title:</b></label>
                  <input type="text" maxlength="255" class="form-control" name="offerTitle" placeholder="Offer Title">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Offer Description:</b></label>
                  <textarea class="form-control" id="offerDescription" name="offerDescription" required>

                  </textarea>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Joining Date:</b></label>
                  <input type="date" class="form-control" name="joiningDate">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Application Deadline:</b></label>
                  <input type="date" class="form-control" name="applicationDeadline">
                  <p class="help-block"></p>
                </div>
              </div>

               <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b><span class ="reimburse">Compensation</span> Type:</b></label>
                  <select class="form-control" name="compensationType" id = "compensationType">
                    <option value="1">Fixed Compensation</option>
                    <option value="2">Compensation Offered In Range.</option>
                    <option value ="3">No Compensation/Expenses Covered</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>
            
               <div class="col-md-6 control-group form-group compensation">
                <div class="controls">
                  <label><b><span class ="reimburse">Compensation</span>:</b></label>
                  <input type="text" class="form-control" name="compensation">
                  <p class="help-block"></p>
                </div>
              </div>
            
            <div class="row col-md-12 rangeCompensation" style ="display: none">
              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Minimum <span class ="reimburse">Compensation:</span></b></label>
                  <input type="text" class="form-control" name="minCompensation">
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Maximum <span class ="reimburse">Compensation:</span></b></label>
                  <input type="text" class="form-control" name="maxCompensation">
                  <p class="help-block"></p>
                </div>
              </div>
            </div>
              <div class = "row col-md-12">
               <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Work From Home:</b></label>
                  <select class="form-control" name="workHome" id="workHome">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>


                <div class="col-md-6 control-group form-group location" style="display: none">
                <div class="controls">
                  <label><b>Location:</b></label>
                  <select class="form-control" id ="location" name="location">
                    <option value = "0"> </option>
                    <?php foreach($locations as $location){
                      ?>
                    <option value="<?= $location['cityID']?>"><?=$location['city']?>, <?=$location['state']?></option>
                  <?php  } ?>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>
               </div>

              <div class = "row col-md-12">
               <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Part Time:</b></label>
                  <select class="form-control" name="partTime" id="partTime">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>
              <div class="col-md-6 control-group form-group duration" style="display: none">
                <div class="controls">
                  <label><b>Duration:</b></label>
                  <input type="text" class="form-control" name="duration" placeholder="in months">
                  <p class="help-block"></p>
                </div>
              </div>
              </div>
            

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Type of Applicants:</b></label>
                  <select class="form-control" name="applicantType" id="applicantType">
                    <option value="1">Anyone can Apply</option>
                    <option value="2">Applicants with specific Skills</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>
             
              <div class="col-md-12 selectSkills" style = "display: none">
                <label><b>Skills:</b></label>
                <div class="row">
                  <div class="col-10 col-sm-10">
                    <select id="skills" class="form-control">
                      <?php foreach ($skills as $key => $value) { ?>
                        <option value="<?php echo $value['skill_name']; ?>" skill-id="<?php echo $value['skillID']; ?>"><?php echo $value['skill_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-2 col-sm-2">
                    <a href="javascript:" class="addSkill btn btn-primary" style="color: white; width: 100%;">Add Skill</a>
                  </div>
                </div>

              </div>

              <div class="col-md-12 selectedSkills" style = "display: none">
                <br>
                <label><b>Selected Skills:</b></label>
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <input type="hidden" name="selectedSkills">
                  </div>

                </div>

              </div>
            </div>


            </div>
            <div class="row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-lg btn-primary" style="float: right; margin-top: 15px;">Add Offer</button>
              </div>
            </div>
          </form>




        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script>
      $(document).ready(function(){
        editor = CKEDITOR.replace('offerDescription');
      });
    </script>


    <script>
  	var skills_arr =[]
  	var selectedSkills = [];

  	$(document).on('click','.addSkill',function(){
  	  var skill ={}
  	  skill.skill_name = $('#skills').find(":selected").val();
  	  skill.skillID = $('#skills').find(":selected").attr('skill-id');
  		console.log(skill);
  		// console.log(selectedSkills)
  	  if(!isAlreadyPresentSkill(skill.skillID)){
  	    var html='<p class="skill">'+skill.skill_name+
  			' <a href="javascript:" data-skill="'+skill.skill_name+'" index="'+selectedSkills.length+'" skill-id="'+skill.skillID+'"><i class="fa fa-times red" aria-hidden="true"></i></a></p>';
  	    selectedSkills.push(skill);
  	    $('.selectedSkills').append(html);
  	  }
  	  $("input[name=\"selectedSkills\"]").val(JSON.stringify(selectedSkills));
  	    // console.log(selectedSkills)
  	});

  	    function isAlreadyPresentSkill(id){
  	        if(selectedSkills.length == 0)
  	            return false
  	        var alreadyPresent = false
  					console.log(selectedSkills);
  	        selectedSkills.forEach(function(value){
  	            if(value.skillID == id)
  	                alreadyPresent =true
  	        })
  	        return alreadyPresent
  	    }
  	$(document).on('click','.skill a',function(){
  	  var skill = $(this).attr('data-skill');
  	 	var parent = $(this).parent();

  	  if(selectedSkills.length > 0)
  	  {
  	    delete selectedSkills[$(this).attr('index')]
  	    console.log();
  	    $(this).parent().remove();
  	  }
  	  $("input[name=\"selected_skills\"]").val(JSON.stringify(selectedSkills));
  	});

  	</script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#offerType').on('change', function(){
          value = $(this).val();
          if(value == 2){
            $('.reimburse').html('Stipend');
            $('.duration').show();
          }else{
            $('.reimburse').html('Compensation');
          }
        });

         $('#workHome').on('change', function(){
          value = $(this).val();
          console.log(value);
          if(value == 2){
            $('.location').show();
          }else if(value == 1){
            $('.location').hide();
          }
        });

        //  $('#partTime').on('change', function(){
        //   value = $(this).val();
        //   if(value == 2){
        //     if($('#offerType').val() == 2)
        //       $('.duration').show();
        //   }else if(value == 1){
        //     $('.duration').hide();
        //   }
        // });

        $('#applicantType').on('change', function(){
          value = $(this).val();
          if(value == 1){
            $('.selectSkills').hide();
            $('.selectedSkills').hide();
          }else if(value == 2){
            $('.selectSkills').show();
            $('.selectedSkills').show();
          }
        });

        $('#compensationType').on('change', function(){
          value = $(this).val();
          console.log(value);
          if(value == 1){
            $('.compensation').show();
            $('.rangeCompensation').hide();
          }else if(value == 2){
            $('.compensation').hide();
            $('.rangeCompensation').show();
          }else if(value == 3){
            $('.compensation').hide();
            $('.rangeCompensation').hide();
          }
        });
      });
    </script>

  </body>

</html>
