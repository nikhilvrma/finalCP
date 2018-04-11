<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle."|CampusPuppy"; ?></title>

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

              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Company Name: </b></p>
                      <p class="card-text">Campus Puppy Private Limited</p>
                      <p class="card-text"><b>Website: </b>http://www.campuspuppy.com/</p>
                    </div>
                    <div class="col-md-3 mb-4">
                      <p class="card-text"><b>Share: </b></p>
                      <p class="card-text">
                        <a class="btn" style="color: white; background: #3b5998;"><i class="fa fa-facebook"></i></a>
                        <a class="btn" style="color: white; background: #1DA1F2;"><i class="fa fa-twitter"></i></a>
                        <a class="btn" style="color: white; background: #0077B5;"><i class="fa fa-linkedin"></i></a>
                      </p>
                    </div>
                    <div class="col-md-3 mb-4">
                      <p class="card-text"><b>Application Deadline: </b>25th September 2018</p>
                      <p class="card-text"><a class="btn btn-primary" style="color: white;">Apply Now</a></p>
                    </div>
                  </div>

                </div>

              </div>
              <br>
              <div class="col-md-12 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Offer Description</b></h6>
                  <ul>
                  	<li>Candidate should have very strong technical background in Core Java, Spring (MVC, IOC), struts Hibernate/JPA, Agile (scrum), Web services and Design Patterns</li>
                  	<li>Expertise in J2EE technologies: Spring, Java, JSP, JSF, JDBC, Struts.</li>
                  	<li>Experience in designing database schemas and writing fine-tuned queries.</li>
                  	<li>Sound knowledge of Messaging tools like MQ/JMS/TIBCO/Mule ESB.&nbsp;</li>
                  	<li>Exception handling, Collections API, Multithreading with latest concurrency package, Best practices&nbsp;(such as avoiding code duplication, avoiding hard coded values etc.), Design patterns</li>
                  	<li>Good knowledge of OOPS concepts, Hibernate and Spring version 3.x 1, Spring Dependency Injection (IOC, MVC, JDBC, JMS, etc)</li>
                  	<li>Good knowledge of Application Servers like Tomcat and Weblogic.&nbsp;</li>
                  	<li>Good knowledge of Restful services and JDBC</li>
                  	<li>Good knowledge of XML Parsers, XML Schema, JAXB</li>
                  	<li>Experience in implementing JMS messaging services</li>
                  </ul>
                </p>
                <p>
                <h6><b>Skill(s) Required</b></h6>
                  <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                  	<li>General Aptitude</li>
                  </ul>
                </p>
                <p>
                <h6><b>Location(s)</b></h6>
                  <ul>
                    <li>Lucknow, Uttar Pradesh</li>
                    <li>New Delhi</li>
                  </ul>
                </p>
                <p>
                <h6><b>Compensation Offered</b></h6>
                  INR 3,00,000/- per annum
                </p>
                <p>
                <h6><b>Internship Duration</b></h6>
                  6 Months
                </p>
              </div>

            </div>


              <div class="col-md-4 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Joining Date</b></h6>
                  1st November 2018
                </p>
              </div>
              <div class="col-md-4 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Number of Opening(s)</b></h6>
                  10
                </p>
              </div>
              <div class="col-md-4 mb-4" style="font-size: 14px;">
                <p>
                <h6><b>Part Time Allowed</b></h6>
                  No
                </p>
              </div>




          </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>


  </body>

</html>
