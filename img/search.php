<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PMEGP || Search Result Page</title>
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Main Stylesheet File -->
    <link href="css/mystyle.css" rel="stylesheet">
    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php');?>
        <section id="search_content" class="clearfix">
            <div class="container">
                <div class="row">
                    <?php 
                    $item = $_GET['q']; 
                    
                    $obj = new database();
                    $table = "services_data";
                    $col_val = "service_name";
                    $value = "$item";
                    $qw = $obj->search($table,'',$col_val,$value,false);
                    //print_r($qw[0]);
                    ?>
                    <div class="col-12">
                        <h3 style="text-align:center;"><?php print_r($qw[0]['service_name']);?></h3>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-4 ">
                                <h4>Related Services</h4>
                                <div class="pt-2">
                                    <?php
                                       /* $category = $qw[0]['category'];
                                        $sep_category = explode(' ', $category);
                                        foreach ($sep_category as $value) {
                                            $table = "services_data";
                                            $con[] = "category LIKE '$value%' ";
                                        }
                                        $er = implode(' OR ',$con);
                                        //print_r($er);
                                        $cond = "$er";
                                        $erqw = "AND service_name != ";
                                        $erqw .= '"';
                                        $erqw .= $qw[0]['service_name'];
                                        $erqw .= '"';
                                        
                                        $result_services = $obj->customsearch($table,'service_name',$cond,$erqw,false);
                                        print_r($result_services);*/
                                    ?>
                                    <div class="col-12" style="background-color:black;color:white;padding:10px;text-align:center;border-bottom-left-radius:5px;border-bottom-right-radius:5px;width:75%">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-12 col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php include_once('footer.php');?>
   
</div>  
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/mobile-nav/mobile-nav.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>