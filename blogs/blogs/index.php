<?php
    //disabling error reporting 
    error_reporting(0);
    //connnecting to the database
    require_once 'connection/db.php';

    // querying for the latest category
    $query = "SELECT * FROM posts WHERE post_category = ? LIMIT 8";
    $lat_cat = 'latest';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$lat_cat);
    $stmt->execute();
    $latest = $stmt->get_result();
    $stmt->close();

    // querying for the latest category for sliding posts
    $query = "SELECT * FROM posts WHERE post_category = ? LIMIT 6";
    $sli_cat = 'latest';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$sli_cat);
    $stmt->execute();
    $sliding = $stmt->get_result();
    $stmt->close();

    //querying for the most popular category
    $query = "SELECT * FROM posts WHERE post_category = ? LIMIT 8";
    $pop_cat = 'Popular';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$pop_cat);
    $stmt->execute();
    $popular = $stmt->get_result();
    $stmt->close();

     //querying for the most other news category
     $query = "SELECT * FROM posts WHERE post_category = ? ORDER BY post_date DESC LIMIT 4";
     $other_cat = 'other news';
     $stmt = $conn->prepare($query);
     $stmt->bind_param('s',$other_cat);
     $stmt->execute();
     $otherNews = $stmt->get_result();
     $stmt->close();

     //querying for the most sport news category
     $query = "SELECT * FROM posts WHERE post_category = ? ORDER BY post_date DESC LIMIT 4";
     $otherSpt_cat = 'sports';
     $stmt = $conn->prepare($query);
     $stmt->bind_param('s',$otherSpt_cat);
     $stmt->execute();
     $sports = $stmt->get_result();
     $stmt->close();

      //querying for the most flashback news category
      $query = "SELECT * FROM posts WHERE post_category = ? ORDER BY post_date DESC LIMIT 4";
      $flash_cat = 'flashback';
      $stmt = $conn->prepare($query);
      $stmt->bind_param('s',$flash_cat);
      $stmt->execute();
      $flashBack = $stmt->get_result();
      $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content=" latest news,latest news today,top news, current news, news today, news now">
    <meta property="og:title" content="The number one naija blog for the latest sports and current news">
    <meta property="og:description" content="Home of all latest , current and world current news">
    <meta property="og:image" content="https://unitechdev.com/image/ogimage.jpg">
    <meta property="og:url" content="https://unitechdev.com">
    <meta property="og:type" content="blog">
    <meta property="twitter:title" content="The number one for the latest sports and current news">
    <meta property="twitter:description" content="Home of all latest , current and world current news">
    <meta property="twitter:image" content="https://unitechdev.com/image/ogimage.jpg">
    <meta property="twitter:url" content="https://unitechdev.com">
    <meta property="twitter:card" content="summary_large_image">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="apple-touch-icon" style="border-radius: 10px;" sizes="180x180" href="images/Desert.jpg">
    <link rel="icon" type="image/jpg" sizes="16x16" href="images/Desert.jpg">
    <link rel="canonical" href="https://unitechdev.com">
    <link rel="stylesheet" type="text/css" href="css/swiper.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"><!--version 4.1-->
    <title>Niger latest</title>
</head>
<body>
                            <div id="home"></div>
                            <!--including topbar-->
                          <?php include 'includes/topbar.php';?>
                        <!-- swiper sliding posts page-->
                        <div class="swiper-container swipe1">
                            <div class="swiper-wrapper">
                                <?php while ($result = $sliding->fetch_assoc()) {
                                    $explode = explode("../",$result['image_dir']);
                                    ?>
                            <div class="swiper-slide">
                              <a href="viewpost.php?vid=<?php echo $result['id'];?>"><img src="<?= $explode[1];?>" alt="sliding image" class="img-fluid card-img-top">
                              <div class="card-title bg-secondary ml-4 text-center" id="caption">
                                <p class="text-white"><?php echo $result['post_desc'];?></p>
                            </div></a>
                            </div>
                           
                                <?php }?>
                            
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                           
                        </div>

            <!-- content--->
            <section id="content">
                <div class="container">
                  <h2> LATEST</h2>
                    <div class="row">
                        <!--latest section-->
                        
                        <div class="col-md-6">
                                    <?php 
                                  
                                        while($result = $latest->fetch_assoc()){
                                            $explode = explode("../",$result['image_dir']);
                                            
                                            ?>
                                            
                                        <div class="card shadow my-3">
                                    <div>
                                        <img src="<?=$explode[1];?>" alt="blog post image" class="card-img-top">
                                             </div>
                                                <div class="card body p-2">
                                                    <h3 class="card-title"><?php echo strip_tags($result['post_desc']); ?></h3>
                                                     
                                                     <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small>
                                                     <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                                    <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                                                </div>
                                                </div>
                                        <?php } ?>
                                        <!--view all button-->
                                        <div class="text-center py-4" id="view">
                                             <a href="latest.php"><button>View all</button></a>
                                         </div>
                                         </div>
                                            
                                         
                                            <!--category section-->
                             <div class="col-md-4">
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">Categories</a>
                                    <a href="latest.php" class="list-group-item">Latest Posts</a>
                                    <a href="popular.php" class="list-group-item primary">Popular Posts</a>
                                    <a href="politics.php" class="list-group-item primary">Politics</a>
                                    <a href="education.php" class="list-group-item primary">Education</a>
                                    <a href="sports.php" class="list-group-item">Sports </a>
                                    <a href="othernews.php" class="list-group-item">Other News </a>
                                </div>             
                             
                            
                                            <!--popular section-->
                                <h2>Popular</h2>
                            <?php 
                                        while($result = $popular->fetch_assoc()){
                                            $explode = explode("../",$result['image_dir']);
                                            ?>

                                        <div class="card shadow my-3">
                                    <div>
                                        <img src="<?=$explode[1];?>" class="img-fluid card-img-top" alt="blog post image">
                                             </div>
                                             <div class="card body p-2">
                                                    <h3 class="card-title"><?php echo strip_tags($result['post_desc']); ?></h3>
                                                     
                                                     <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small>
                                                     <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                                    <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                                                </div>
                                                </div>
                                        <?php } ?>
                                         </div>
                                    
                            </div>
                         </div>
                    </div>
                </div>

                <!-- second category of the blog--->
                <div class="container">
                    <!--flashback category-->
                    <h2>Flashback</h2>
                    <div class="row">
                   
                               
                                <?php 

                                        while($result = $flashBack->fetch_assoc()){
                                            $explode = explode("../",$result['image_dir']);
                                            ?>
                                             <div class="col-md-3">
                                    <div class="card shadow my-2">
                                        <div>
                                            <img src="<?=$explode[1];?>" class="img-fluid card-img-top" alt="post picture">
                                                </div>
                                                <div class="card body p-2">
                                                    <h3 class="card-title"><?php echo strip_tags($result['post_desc']); ?></h3>
                                                     
                                                     <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small>
                                                     <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                                    <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                                                </div>
                                    
                                </div>
                              </div>
                                <?php }?>
                  
                         </div>
                    </div>
                </div>
                <!-- second row of the post-->
                        <div class="container">
                          <h2>Sports</h2>
                            <div class="row">
                                <!--other sports category-->
                                
                                <!-- first column-->
                                <?php
                                 while($result = $sports->fetch_assoc()){
                                    $explode = explode("../",$result['image_dir']);
                                     ?>
                                <div class="col-md-3">
                                    <div class="card shadow my-2">
                                        <div>
                                            <img src="<?=$explode[1]; ?>" class="img-fluid card-img-top" alt="post picture">
                                        </div>
                                        <div class="card body p-2">
                                            <h3 class="card-title"><?php echo strip_tags($result['post_desc']); ?></h3>
                                                
                                                <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small>
                                                <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                            <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                    <?php }; ?>
                                
                            </div>
                        </div>
                                <!-- Another row of the post--->
                        <div class="container">
                            <h2>Other News</h2>
                            <div class="row">
                            
                                
                                    <?php 
                                    while($result = $otherNews->fetch_assoc()){
                                        $explode = explode("../",$result['image_dir']);
                                        ?>
                                    <div class="col-md-3">
                                    <div class="card shadow my-2">
                                        <div>
                                            <img src="<?=$explode[1];?>" alt="post picture" class="card-img-top">
                                        </div>
                                        <div class="card body p-2">
                                            <h3 class="card-title"><?php echo strip_tags($result['post_desc']); ?></h3>
                                                
                                                <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small>
                                                <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                            <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                                        </div>
                                    </div>
                                    </div>
                                    <?php }; ?>
                                

                           </div>
                        </div>
            </section>
            <br>
            <!-- bootstrap modal -->
                <?php include 'includes/blog_modal.php'; ?>
            <!-- bootstrap modal ends -->
            <!--back to top-->
            <a href="#home" rel="nofollow" class="back-to-top"><i class="fas fa-arrow-up"></i></a>
<!-- footer section--->
<footer class="footer footer-default" style="height: device-height; width: 100%; background-color:black;padding-top:15px;color:gray; ">
    <p class="text-center">Copyright &copy; 2020 All rights reserved | Developed by <span><a style="text-decoration:none;color:red;" href="www.unitechdev.com">Unitech</a><span></p>
</footer>

                        <script src="js/jquery.min.js"></script>
                        <script src="js/popper.min.js"></script>
                        <script src="js/bootstrap.min.js"></script>
                        <script src="js/script.js"></script>
                        <script src="js/swiper.min.js"></script>
					    
                                <script>
                                       /* service slide*/
    var swiper = new Swiper('.swipe1', {
      spaceBetween: 30,
      effect: 'fade',
      autoplay: {
            display:1500,
            disableOnInteraction: false,
          },
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
       
                                </script>
                      
						
</body>
</html>
