<div class="col-lg-3 mb-4">
  <center><img class="img-responsive" src="<?php echo base_url().$_SESSION['user_data']['profileImage']; ?>" style="width: 70%; margin: 10px; border-radius: 50%;"></center>
  <center><b><?php echo $_SESSION['user_data']['name']; ?></b></center>
  <center><a href="<?php echo base_url('functions/signout'); ?>" style="font-size: 14px;">Sign Out</a></center>
  <div class="list-group" style="margin-top: 15px;">

    <a class="list-group-item sidebar-item"><b style="float: right;">User-Profile</b></a>
    <a href="<?php echo base_url('general-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="2") { echo "sidebar-active"; } ?>">General Details</a>
    <a href="<?php echo base_url('skills'); ?>" class="list-group-item sidebar-item <?php if($activePage=="3") { echo "sidebar-active"; } ?>">Skills</a>
    <a href="<?php echo base_url('educational-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="4") { echo "sidebar-active"; } ?>">Educational Details</a>
    <a href="<?php echo base_url('work-experience'); ?>" class="list-group-item sidebar-item <?php if($activePage=="5") { echo "sidebar-active"; } ?>">Work Experience</a>
    <a href="<?php echo base_url('resume'); ?>" class="list-group-item sidebar-item <?php if($activePage=="6") { echo "sidebar-active"; } ?>">Resume</a>

    <a class="list-group-item sidebar-item"><b style="float: right;">Job/Internship Offers</b></a>
    <a href="<?php echo base_url('general-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="8") { echo "sidebar-active"; } ?>">My Added Offer(s)</a>
    <a href="<?php echo base_url('add-new-offer'); ?>" class="list-group-item sidebar-item <?php if($activePage=="9") { echo "sidebar-active"; } ?>">Add New Offer</a>

    <a class="list-group-item sidebar-item"><b style="float: right;">Profile Settings</b></a>
    <a href="<?php echo base_url('change-password'); ?>" class="list-group-item sidebar-item <?php if($activePage=="7") { echo "sidebar-active"; } ?>">Change Password</a>

  </div>
</div>
