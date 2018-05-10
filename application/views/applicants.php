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
                <form class="form-inline" style="float: right;" method = "get" action = "<?= base_url('functions/filterApplicantsByStatus')?>">
                  <label style="margin: 5px;"><b>Display Applicants</b></label>
                  <br>
                  <select class="form-control mb-2 mr-sm-2" name = "type">
                    <option>All Applicants</option>
                    <option>Selected Applicants</option>
                    <option>Short-Listed Applicants</option>
                    <option>Rejected Applicants</option>
                    <option value = "5">Applicants to Compare</option>
                  </select>

                  <button type="submit" class="btn btn-primary mb-2">Display</button>
                </form>
              </div>
            </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-12 mb-4" id = "candidateList">
              <?php foreach($applicants as $applicant){ ?>
              <div class="card" id = "candidate<?= $applicant['userID']?>">
                <h6 class="card-header cardheader"><?= $applicant['name']?><br><br><a href = "<?= base_url('report/'.$applicant['userID'])?>"><label style="font-size: 14px;">View Profile</label></a></h6>
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

  <script type="text/javascript">
  var page = 1;
  var slug = '<?= $offer?>';
    $(document).ready(function(){
      $('#loadMore'). click(function(){
        page++;
        url = '<?= base_url('functions/loadMoreApplicants')?>';
        data = {
                  slug : slug,
                  page : page
                };
        $.get(url,data).done(function(res){
          console.log(res);
          res = JSON.parse(res);
          data = res.data
          more = res.more
          res = data
          if(res != false){
            for(var i = 0; i < res.length; i++){
              var container = $('.containerWrap').clone()
              container.attr('id', 'candidate'+res[i].userID)
              container.removeClass('candidateWrap');
              container.find('.title').html(res[i].name);
              container.find('.location').html(res[i].city+' '+res[i].state)
              if(res[i].status == 2){
                container.find('.email').html(res[i].email).attr('id', 'email'+res[i].userID)
                container.find('.mobile').html(res[i].mobile).attr('id', 'mobile'+res[i].userID)
              }else{
                container.find('.email').html('<i>Select Candidate to view E-Mail Address</i>').attr('id', 'email'+res[i].userID)
                container.find('.mobile').html('<i>Select Candidate to view Mobile Number</i>').attr('id', 'mobile'+res[i].userID)
              }
              if(res[i].gender == 'M'){
                container.find('.gender').html('Male');
              }else{
                container.find('.gender').html('Female');
              }
              if(res[i].status == 1){
                container.find('.status').html('<b>Applied</b>');
              }else if(res[i].status == 2){
                container.find('.status').html('<b>Selected</b>').css('color', 'green');
              }else if(res[i].status == 3){
                container.find('.status').html('<b>Shortlisted</b>').css('color', 'yellow');
              }else{
                container.find('.status').html('<b>Rejected</b>').css('color', 'red');
              }
              if(res[i].skillName == null){
                 container.find('.skillList').html('No Skills Found')
              }else{
                var skillName = (res[i].skillName).split(',')
                var skilltype = (res[i].type).split(',')
                var skillScore = (res[i].score).split(',')
                var k = 0;
                if(skilltype[0] == 2 && skillScore[0] >=10){
                  var skill = '<li>'+ skillName[0] +'</li><sup style="color: red;">Premium</sup>';
                  k++;
                }
                if(skilltype[0] == 1){
                  var skill = '<li>'+ skillName[0] +'</li>';
                  k++;
                }

                for(var j = 1; j < skillName.length; j++){
                   if(skilltype[j] == 2 && skillScore[j] >=10){
                  var skill = '<li>'+ skillName[j] +'</li><sup style="color: red;">Premium</sup>';
                  k++;
                }
                if(skilltype[j] == 1){
                  var skill = '<li>'+ skillName[j] +'</li>';
                  k++;
                }
                }
                if(k = 0){
                  skill = "No Skill Found";
                }
                container.find('.skillList').html(skill)
              }
              container.find('.buttonContainer').addClass('buttonContainer'+res[i].userID).removeClass('buttonContainer')
              container.find('.shortlistCandidate').attr({id:'shortlistCandidate'+res[i].userID, data:res[i].userID})
              container.find('.selectCandidate').attr({id:'selectCandidate'+res[i].userID, data:res[i].userID})
              container.find('.rejectCandidate').attr({id:'rejectCandidate'+res[i].userID, data:res[i].userID})
              container.find('.addToCompare').attr({id:'addToCompare'+res[i].userID, data:res[i].userID})
              if(res[i].status == 1){
                container.find('.unrejectCandidate').remove();
              }

              if(res[i].status == 2){
                container.find('.shortlistCandidate').remove();
                container.find('.selectCandidate').html('Selected').removeClass('selectCandidate').attr('id','');
                container.find('.unrejectCandidate').remove();
                container.find('.rejectCandidate').remove();
                container.find('.addToCompare').remove();
              }
              if(res[i].status == 4){
                container.find('.shortlistCandidate').remove();
                container.find('.selectCandidate').remove();
                container.find('.unrejectCandidate').attr({id:'unrejectCandidate'+res[i].userID, data:res[i].userID});
                container.find('.rejectCandidate').html('Rejected').removeClass('rejectCandidate');
                container.find('.addToCompare').remove();
              }
              if(res[i].status == 3){
                 container.find('.unrejectCandidate').remove();
                  container.find('.shortlistCandidate').html('Shortlisted').removeClass('shortlistCandidate');
              }
              $('#candidateList').append(container[0]);
              container.show()
            }
          }
          if(more == false){
            $('#loadMore').hide();
          }
        })
      })
    })

</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('click', '.shortlistCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/shortlist')?>';
      postData = {
        data: data
      }

      $.get(url,postData).done(function(res){
        console.log(res)
         res = JSON.parse(res);
        candidateDetail = res.data[0];
        if(res.res == 'true'){
          $('#email'+data).html(candidateDetail.email)
          $('#mobile'+data).html(candidateDetail.mobile)
          $('#shortlistCandidate'+data).html('Shortlisted').removeClass('shortlistCandidate')
          alert('The candidate has been shortlisted');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.selectCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = "<?= base_url('functions/select')?>"
      postData = {
        data: data
      }
      $.get(url,postData).done(function(res){
        res = JSON.parse(res);
        candidateDetail = res.data[0];
        if(res.res == 'true'){
          $('#email'+data).html(candidateDetail.email)
          $('#mobile'+data).html(candidateDetail.mobile)
          $('#shortlistCandidate'+data).remove();
          $('#selectCandidate'+data).html('Selected').removeClass('selectCandidate').attr('id','');
          $('#unrejectCandidate'+data).remove();
          $('#rejectCandidate'+data).remove();
          $('#addToCompare'+data).remove();
          alert('The candidate has been selected');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.rejectCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/reject')?>'
      postData = {
        data: data
      }
      $.get(url,postData).done(function(res){
        if(res == 'true'){
          $('#shortlistCandidate'+data).remove();
          $('#selectCandidate'+data).remove();
          var clone = $('.unrejectClone').clone();
          clone.addClass('unrejectCandidate');
          clone.attr({id:'unrejectCandidate'+data, data:data});
          $('.buttonContainer'+data).append(clone[0]);
          clone.show();
          $('#rejectCandidate'+data).html('Rejected').removeClass('rejectCandidate');
          $('#addToCompare'+data).remove();
          alert('The candidate has been rejected');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.addToCompare', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/addToCompare')?>'
      postData = {
        data: data
      }
      $.get(url,postData).done(function(res){
        console.log(res);
        if(res == 'true'){
          console.log('yo');
          alert('Added to Compare');
        }
        if(res == 'false'){
          console.log('hoe');
          alert('2 candidate limit has been reached.');
        }
        if(res == 'false1'){
          alert('This candidate has already been added');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.unrejectCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/removeFromReject')?>'
      postData = {
        data: data
      }
      $.get(url,postData).done(function(res){
        if(res == 'true'){
          $("#unrejectCandidate"+data).remove();
          $('#rejectCandidate'+data).remove();
          var selectClone = $('.selectClone').clone();
          selectClone.addClass('selectCandidate');
          selectClone.attr({id:'selectCandidate'+data, data:data});
          $('.buttonContainer'+data).append(selectClone[0]);
          selectClone.show();
          var shortlistClone = $('.shortlistClone').clone();
          shortlistClone.addClass('shortlistCandidate');
          shortlistClone.attr({id:'shortlistCandidate'+data, data:data});
          $('.buttonContainer'+data).append(shortlistClone[0]);
          shortlistClone.show();
          var rejectClone = $('.rejectClone').clone();
          rejectClone.addClass('rejectCandidate');
          rejectClone.attr({id:'rejectCandidate'+data, data:data});
          $('.buttonContainer'+data).append(rejectClone[0]);
          rejectClone.show();
          var addToClone = $('.addToClone').clone();
          addToClone.addClass('addToCompare');
          addToClone.attr({id:'addToCompare'+data, data:data});
          $('.buttonContainer'+data).append(addToClone[0]);
          addToClone.show();
        }
      })
    })
  })

</script>

</html>
