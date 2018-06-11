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
          <p>Comparing Applicants for the Offer: <b><?= $offerTitle?></b></p>
          <hr>
          <?php if(!empty($candidates['skills'][0])){foreach($candidates['skills'][0] as $key => $value){
            $skills[0][$value['skillID']]['skillID'] = $value['skillID'];
            $skills[0][$value['skillID']]['skillName'] = $value['skill_name'];
            $skills[0][$value['skillID']]['type'] = $value['type'];
            $skills[0][$value['skillID']]['score'] = $value['score'];
          }}else{$skills[0] = array();}?>
          <?php if(!empty($candidates['skills'][1])){foreach($candidates['skills'][1] as $key => $value){
            $skills[1][$value['skillID']]['skillID'] = $value['skillID'];
            $skills[1][$value['skillID']]['skillName'] = $value['skill_name'];
            $skills[1][$value['skillID']]['type'] = $value['type'];
            $skills[1][$value['skillID']]['score'] = $value['score'];
          }}else{$skills[1] = array();}?>
          <div class="row">

            <div class="col-md-12 mb-4">

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="width: 28%;">Name</th>
                    <?php if(isset($candidates['userDetails'][0])){?>
                    <th scope="col" style="background: #2c3e50; color: white; width: 36%;"><?= $candidates['userDetails'][0][0]['name']?><br><p style="font-size: 14px; float: right; color: red;">Remove from Compare</p></th>
                    <?php }else{}if(isset($candidates['userDetails'][1])){?>
                    <th scope="col" style="background: #2c3e50; color: white; width: 36%;"><?= $candidates['userDetails'][1][0]['name']?><br><p style="font-size: 14px; float: right; color: red;">Remove from Compare</p></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Gender</th>
                    <?php if(isset($candidates['userDetails'][0])){if($candidates['userDetails'][0][0]['gender'] == 'M'){echo "<td>Male</td>";}else{echo "<td>Female</td>";}}?>
                    <?php if(isset($candidates['userDetails'][0])){if($candidates['userDetails'][1][0]['gender'] == 'M'){echo "<td>Male</td>";}else{echo "<td>Female</td>";}}?>
                  </tr>
                  <tr>  
                    <th scope="row">Education:<br><label style="float: right;">High-School</label></th>

                    <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){?>
                    
                    <td><p style="font-size: 14px;">Central Board of Secondory Education, New Delhi<br><b>Score: </b>90%<br><b>Batch: </b>2009</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ ?>
                    
                    <td><p style="font-size: 14px;">Central Board of Secondory Education, New Delhi<br><b>Score: </b>95%<br><b>Batch: </b>2010</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} ?>
                  </tr>
                   <tr>  
                    <th scope="row">Education:<br><label style="float: right;">Secondary School</label></th>

                    <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){?>
                    
                    <td><p style="font-size: 14px;">Central Board of Secondory Education, New Delhi<br><b>Score: </b>90%<br><b>Batch: </b>2009</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ ?>
                    
                    <td><p style="font-size: 14px;">Central Board of Secondory Education, New Delhi<br><b>Score: </b>95%<br><b>Batch: </b>2010</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} ?>
                  </tr>
                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">Graduation</label></th>

                    <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){?>
                    
                    <td><p style="font-size: 14px;">JSS Academy of Technical Education, Noida<br><b>Course: </b>Bachelor of Technology- Computer Science and Engineering<br><b>Score: </b>90%<br><b>Batch: </b>2016</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ ?>
                    
                    <td><p style="font-size: 14px;">JSS Academy of Technical Education, Noida<br><b>Course: </b>Bachelor of Technology- Information Technology<br><b>Score: </b>90%<br><b>Batch: </b>2016</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} ?>
                  </tr>
                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">Post-Graduation</label></th>

                    <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){?>
                    
                    <td><p style="font-size: 14px;">JSS Academy of Technical Education, Noida<br><b>Course: </b>Bachelor of Technology- Computer Science and Engineering<br><b>Score: </b>90%<br><b>Batch: </b>2016</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ ?>
                    
                    <td><p style="font-size: 14px;">JSS Academy of Technical Education, Noida<br><b>Course: </b>Bachelor of Technology- Information Technology<br><b>Score: </b>90%<br><b>Batch: </b>2016</p></td>
                    
                    <?php }else{echo "<td>Not Found.</td>";} ?>
                  </tr>

                  <?php if(!empty($allSkills)){
                   // var_dump($skills);
                    foreach($allSkills as $allSkill){ if(isset($allSkill['skillName']) && $allSkill['skillName'] != NULL){ ?>
                    <th scope="row">Skill:<br><label style="float: right;"><?php echo $allSkill['skillName'];?></label></th>

                    <td><?php if(!empty($skills[0]) && isset($skills[0][$allSkill['skillID']])){echo $skills[0][$allSkill['skillID']]['score'];}else{echo "Skill Not Found";} if($skills[0][$allSkill['skillID']]['type'] == 2){?><sup style="color: red;"><b>Premium</b></sup><?php }?></td>
                    <td><?php if(!empty($skills[1])){ if(isset($skills[1][$allSkill['skillID']])){echo $skills[1][$allSkill['skillID']]['score'];}}else{echo "Skill Not Found";}if(!empty($skills[1])){if($skills[1][$allSkill['skillID']]['type'] == 2){?><sup style="color: red;"><b>Premium</b></sup><?php }}?></td>
                  </tr>
                <?php }}}else{?>
                  <tr>
                    <th scope="row">Skill:<br><label style="float: right;">NA</label></th>
                    <td>NA</td>
                    <td>NA</td>
                  </tr>
                <?php } ?>
                 
                  <tr>
                    <th scope="row"></th>
                    <td>
                    <small class="text-muted buttonContainer<?= $candidates['userDetails'][0][0]['userID']?>" style="float: right;">
                      <?php if($candidates['status'][0] != '2' && $candidates['status'][0] != '4'){?>
                      <a class="btn btn-success selectCandidate" id = "selectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Select Applicant</a>
                    <?php }else if($candidates['status'][0] == '2') {?>
                      <a class="btn btn-success" style="color: white; margin: 10px;">Selected</a>
                    <?php }
                    ?>

                    <?php if($candidates['status'][0] != '3' && $candidates['status'][0] != '2'&& $candidates['status'][0] != '4'){?>
                      <a class="btn btn-warning shortlistCandidate" id = "shortlistCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Short-list Applicant</a>
                    <?php }else if($candidates['status'][0] == '3'){ ?> 
                      <a class="btn btn-warning" id = 'shortlistCandidate<?= $candidates['userDetails'][0][0]['userID']?>' style="color: white; margin: 10px;">Shortlisted</a>
                    <?php } ?>

                    <?php if($candidates['status'][0] != '4' && $candidates['status'][0] != '2'){?>
                      <a class="btn btn-danger rejectCandidate" id = "rejectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Reject Applicant</a>
                    <?php }else if($candidates['status'][0] == '4') { ?> 
                      <a class="btn btn-danger" id = "rejectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Rejected</a>
                      <a class="btn btn-primary unrejectCandidate" id = "unrejectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Remove From Reject</a>
                    <?php }?>

                   </small>
                    <a class="btn btn-primary removeFromCompare" id = "removeFromCompare<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Remove From Compare</a>
                  
                    </td>


                    <td>
                    <small class="text-muted buttonContainer<?= $candidates['userDetails'][1][0]['userID']?>" style="float: right;">
                     <?php if($candidates['status'][1] != '2' && $candidates['status'][1] != '4'){?>
                      <a class="btn btn-success selectCandidate" id = "selectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Select Applicant</a>
                    <?php }else if($candidates['status'][1] == '2') {?>
                      <a class="btn btn-success" style="color: white; margin: 10px;">Selected</a>
                    <?php }
                    ?>

                    <?php if($candidates['status'][1] != '3' && $candidates['status'][1] != '2'&& $candidates['status'][1] != '4'){?>
                      <a class="btn btn-warning shortlistCandidate" id = "shortlistCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Short-list Applicant</a>
                    <?php }else if($candidates['status'][1] == '3'){ ?> 
                      <a class="btn btn-warning" id = 'shortlistCandidate<?= $candidates['userDetails'][1][0]['userID']?>' style="color: white; margin: 10px;">Shortlisted</a>
                    <?php } ?>

                    <?php if($candidates['status'][1] != '4' && $candidates['status'][1] != '2'){?>
                      <a class="btn btn-danger rejectCandidate" id = "rejectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Reject Applicant</a>
                    <?php }else if($candidates['status'][1] == '4') { ?> 
                      <a class="btn btn-danger" id = "rejectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Rejected</a>
                      <a class="btn btn-info unrejectCandidate" id = "unrejectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Remove From Reject</a>
                    <?php }?>

                    </small>
                    <a class="btn btn-primary removeFromCompare" id = "removeFromCompare<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Remove From Compare</a>
                    
               
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

    <a class="btn btn-success selectClone" style="color: white; margin: 10px;display: none">Select Applicant</a>
              <a class="btn btn-warning shortlistClone" style="color: white; margin: 10px;display: none">Short-list Applicant</a>
              <a class="btn btn-danger rejectClone" style="color: white; margin: 10px;display: none">Reject Applicant</a>
              <a class="btn btn-info unrejectClone" style="color: white; margin: 10px;display: none">Remove From Reject</a>
              <a class="btn btn-info removeFromClone" style="color: white; margin: 10px;display: none">Remove From Compare</a>
  </body>

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
          alert('The candidate has been rejected');  
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.removeFromCompare', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/RemoveFromCompare')?>'
      postData = {
        data: data
      }
      $.get(url,postData).done(function(res){
        console.log(res);
        if(res == 'true'){
          alert('The Applicant has been Removed From Compare. You Will be redirected to the Applicants Page.');
          window.location.href = '<?= base_url('hiring-nucleus/applicants/'.$offer)?>';
        }
        if(res == 'false'){
          alert('No candidate Added To compare.');
        }
        if(res == 'false1'){
          alert('This candidate has not been added to Compare.');
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
        }
      })
    })
  })

</script>

</html>
