<?php 
    //disabling error reporting
    error_reporting(0);
    //including database file
    require_once 'connection/db.php';

    // querying for the politics category
    $query = "SELECT * FROM posts WHERE post_category = ? ORDER BY post_date LIMIT 8";
    $lat_cat = 'politics';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$lat_cat);
    $stmt->execute();
    $latest = $stmt->get_result();
    $stmt->close();

    // second querying for the politics category
    $query = "SELECT * FROM posts WHERE post_category = ? ORDER BY post_date LIMIT 8,8";
    $sec_cat = 'politics';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$sec_cat);
    $stmt->execute();
    $second_cat = $stmt->get_result();
    $stmt->close();

     // querying for the politics category for sliding posts
     $query = "SELECT * FROM posts WHERE post_category = ? ORDER BY post_date LIMIT 5";
     $sli_cat = 'politics';
     $stmt = $conn->prepare($query);
     $stmt->bind_param('s',$sli_cat);
     $stmt->execute();
     $sliding = $stmt->get_result();
     $stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <meta name="viewport"  content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/swiper.min.css">
    <title>Naija Latest</title>
</head>
<body>
                            <!--including topbar-->
                          <?php include 'includes/topbar.php';?>

                             <!-- swiper sliding posts page-->
                        <div class="swiper-container swipe1">
                            <div class="swiper-wrapper">
                                <?php while ($result = $sliding->fetch_assoc()) {
                                    $explode = explode("../",$result['image_dir']);
                                    ?>
                            <div class="swiper-slide">
                              <a href="viewpost.php?vid=<?php echo $result['id'];?>"><img src="<?= $explode[1]?>" alt="sliding image" class="img-fluid card-img-top">
                              <div class="card-title bg-secondary ml-4 text-center" id="caption">
                                <p class="text-white"><?php echo $result['post_desc'];?></p>
                            </div></a>
                            </div>

                            <?php }?>
                          </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>

                        <section id="section">
            <div class="container">
                <div class="row">
                    <!--first column-->
                    <div class="col-md-6">
                    <?php while ($result = $latest->fetch_assoc()) {
                            $explode = explode("../",$result['image_dir']);
                        ?>
                        <h1><?php echo $result['post_title'];?></h1>
                        <div class="card shadow">
                            <div>
                                <img src="<?= $explode[1];?>" class="img-fluid card-img-top" alt="post image">
                            </div>
                            <div class="card body p-2">
                                <h3 class="card-title"><?php echo strip_tags($result['post_desc']); ?></h3>
                                    
                                    <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small>
                                    <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                            <?php }?>
                    </div><br>

                    <!--second column-->
                    <div class="col-md-6">
                     <div class="list-group" style="margin:40px 0 10px 0;">
                            <a href="#" class="list-group-item active">Categories</a>
                            <a href="latest.php" class="list-group-item">Latest Posts</a>
                            <a href="popular.php" class="list-group-item primary">Popular Posts</a>
                            <a href="othersports.php" class="list-group-item">Other Sports </a>
                            <a href="othernews.php" class="list-group-item">Other News </a>
                    </div>

                    <?php while ($result = $second_cat->fetch_assoc()) {?>
                        <h1><?php echo $result['post_title'];
                            $explode = explode('../',$result['image_dir']);
                        ?></h1>
                        <div class="card shadow">
                            <div>
                                <img src="<?= $explode[1];?>" class="img-fluid card-img-top" alt="post image">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?php echo strip_tags($result['post_desc']);?></h3>
                                <small class="text-left"><span class="fas fa-clock text-primary "></span> <?php echo $result['post_date'];?></small><br>
                                 <small class="text-right"><i>Posted by </i><?php echo $result['post_author'];?></small>
                                <a href="viewpost.php?vid=<?php echo $result['id'];?>" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                            <?php }?>
                    
                 </div>

                </div>
            </div>
        </section>
        <!-- bootstrap modal -->
        <?php include 'includes/blog_modal.php'; ?>
            <!-- bootstrap modal ends -->
            <!-- footer section--->
            <footer class="footer footer-default" style="height: auto; width: 100%; background-color:black;padding-top:15px;color:gray; ">
                <p class="text-center">Copyright &copy; 2020 All rights reserved | Developed by <span><a style="text-decoration:none;color:red;" href="www.unitechdev.com">Unitech</a><span></p>
            </footer>
       




                          <script src="js/jquery.min.js"></script>
                        <script src="js/swiper.min.js"></script>
					    <script src="js/bootstrap.min.js"></script>
                                <script>
                                                        /* posts slide*/
                        var swiper = new Swiper('.swipe1', {
                        spaceBetween: 30,
                        effect: 'fade',
                        autoplay: {
                                display:1500,
                                diableOnInteraction: false,
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