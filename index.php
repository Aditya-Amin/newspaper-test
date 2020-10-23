<?php
session_start();
require_once( 'lib/Curl.php' );
require_once( 'auth/Auth.php' );


$auth = new Auth();
$getAllNews = Curl::get("https://content.guardianapis.com/search?api-key=test");
$news = $getAllNews["response"]["results"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- header start -->
    <header>
        <div id="header-warpper">
            <div class="container">
                <div class="wrapper">

                    <div id="logo">
                        <h2>Newspaper</h2>
                    </div>
                    
                    <nav>
                        <ul id="menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="newspaper.php">Newspaper</a></li>
                            <li>
                                <a href="<?php echo $auth->googleLogin(); ?>">Signup</a>
                                <?php if(isset($_SESSION['access_token'])):?>
                                <a href="signup.php?logout=true" style="color: #ff5722;"><?php echo $_SESSION['name']; ?></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->


    <!-- banner start -->
    <div id="banner-section">
        <img src="assets/images/banner/newspaper.jpg" alt="" id="banner-image">
    </div>
    <!-- banner end -->


    <!-- news start -->
    <div class="section">
        <div class="container">
            <div class="wrapper flex-wrap flex-start">
                <?php if(!empty($news)): ?>
                <?php foreach($news as $item): ?>
                <div class="news-item">
                    <img src="assets/images/news/news.jpg" alt="">
                    <h3><a target="_blank" href="<?php echo $item["webUrl"]; ?>"><?php echo $item["webTitle"]; ?></a></h3>
                    <span class="news-category"><?php echo $item["sectionName"]; ?></span>

                    <div class="news-date">
                        <h1><?php echo date("d", strtotime($item["webPublicationDate"])); ?></h1>
                        <div class="year-month">
                            <span><?php echo date("Y", strtotime($item["webPublicationDate"])); ?></span>
                            <span><?php echo date("M", strtotime($item["webPublicationDate"])); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>              
            </div>
        </div>
    </div>
    <!-- news end -->
</body>
</html>