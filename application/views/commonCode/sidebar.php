<div class="col-lg-3 mb-4">
  <center><img class="img-responsive" src="<?php echo base_url('assets/images/admin/nikhilverma.jpg'); ?>" style="width: 70%; margin: 10px; border-radius: 50%;"></center>
  <center><b>Nikhil Verma</b></center>
  <center><a style="font-size: 14px;">Sign Out</a></center>
  <div class="list-group" style="margin-top: 15px;">

    <a href="<?php echo base_url('educational-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="") { echo "sidebar-active"; } ?>"><b style="float: right;">User-Profile</b></a>
    <a href="<?php echo base_url('general-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="2") { echo "sidebar-active"; } ?>">General Details</a>
    <a href="<?php echo base_url('skills'); ?>" class="list-group-item sidebar-item <?php if($activePage=="3") { echo "sidebar-active"; } ?>">Skills</a>
    <a href="<?php echo base_url('educational-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="4") { echo "sidebar-active"; } ?>">Educational Details</a>
    <a href="<?php echo base_url('work-experience'); ?>" class="list-group-item sidebar-item <?php if($activePage=="5") { echo "sidebar-active"; } ?>">Work Experience</a>
    <a href="<?php echo base_url('resume'); ?>" class="list-group-item sidebar-item <?php if($activePage=="6") { echo "sidebar-active"; } ?>">Resume</a>

    <a href="<?php echo base_url('educational-details'); ?>" class="list-group-item sidebar-item <?php if($activePage=="") { echo "sidebar-active"; } ?>"><b style="float: right;">Profile Settings</b></a>
    <a href="<?php echo base_url('change-password'); ?>" class="list-group-item sidebar-item <?php if($activePage=="7") { echo "sidebar-active"; } ?>">Change Password</a>

  </div>
</div>
