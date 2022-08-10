<?php
include 'core/init.php';

if (isset($_GET['hashtag']) && !empty($_GET['hashtag'])) {
    $hashtag = $getFromU->checkInput($_GET['hashtag']);
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);
} else {
    header('Location: index.php');
}
?>
<!doctype html>
<html>

<head>
    <title>twitter</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

</head>
<!--Helvetica Neue-->

<body>
    <div class="wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">
            <div class="nav-container">
                <div class="nav">
                    <div class="nav-left">
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                            <?php if ($getFromU->loggedIn()) : ?>
                                <li><a href="<?php echo BASE_URL; ?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
                            <?php endif; ?>
                        </ul>
                    </div><!-- nav left ends-->
                    <div class="nav-right">
                        <ul>
                            <li><input type="text" placeholder="Search" class="search" /><i class="fa fa-search" aria-hidden="true"></i>
                                <div class="search-result">
                                </div>
                            </li>
                            <?php if ($getFromU->loggedIn()) : ?>
                                <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL . $user->profileImage; ?>" /></label>
                                    <input type="checkbox" id="drop-wrap1">
                                    <div class="drop-wrap">
                                        <div class="drop-inner">
                                            <ul>
                                                <li><a href="<?php echo BASE_URL; ?>profileEdit.php"><?php echo $user->username; ?></a></li>
                                                <li><a href="<?php echo BASE_URL; ?>settings/account">Settings</a></li>
                                                <li><a href="<?php echo BASE_URL; ?>includes/logout.php">Log out</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><label for="pop-up-tweet" class="addTweetBtn">Tweet</label></li>
                            <?php else : echo '<li><a href="' . BASE_URL . 'index.php">Have an account? Log in!</a></li>'; ?>
                            <?php endif; ?>
                        </ul>
                    </div><!-- nav right ends-->

                </div><!-- nav ends -->
            </div><!-- nav container ends -->
        </div><!-- header wrapper end -->


        <!--#hash-header-->
        <div class="hash-header">
            <div class="hash-inner">
                <h1>#<?php echo $hashtag; ?></h1>
            </div>
        </div>
        <!--#hash-header end-->

        <!--hash-menu-->
        <div class="hash-menu">
            <div class="hash-menu-inner">
                <ul>
                    <li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag; ?>">Latest</a></li>
                    <li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=users'; ?>">Accounts</a></li>
                    <li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=photos'; ?>">Photos</a></li>
                </ul>
            </div>
        </div>
        <!--hash-menu-->
        <!---Inner wrapper-->

        <div class="in-wrapper">
            <div class="in-full-wrap">

                <div class="in-left">
                    <div class="in-left-wrap">

                        <!-- Who TO Follow -->
                        <?php $getFromF->whoToFollow($user_id, $user_id); ?>
                        <!--TRENDS-->
                        <?php $getFromT->trends(); ?>

                    </div>
                    <!-- in left wrap-->
                </div>
                <!-- in left end-->

                <!-- TWEETS IMAGES  -->
                <!--  <div class="hash-img-wrapper"> 
 	<div class="hash-img-inner"> 
		 <div class="hash-img-flex">
		 	<img src="TWEET-IMAGE"/>
		 	<div class="hash-img-flex-footer">
		 		<ul>
		 			<li><i class="fa fa-share" aria-hidden="true"></i></li>
		 			<li><i class="fa fa-retweet" aria-hidden="true"></i></li>
		 			<li><i class="fa fa-heart" aria-hidden="true"></i></li>
		 		</ul>
		 	</div>
		</div>
	</div>
</div>  -->
                <!-- TWEETS IMAGES -->

                <!--TWEETS ACCOUTS-->
                <!-- <div class="wrapper-following">
<div class="wrap-follow-inner">

 <div class="follow-unfollow-box">
	<div class="follow-unfollow-inner">
		<div class="follow-background">
			<img src="PROFILE-COVER"/>
		</div>
		<div class="follow-person-button-img">
			<div class="follow-person-img">
			 	<img src="PROFILE-IMAGE"/>
			</div>
			<div class="follow-person-button">
			   PROFILE-BUTTON
			</div>
		</div>
		<div class="follow-person-bio">
			<div class="follow-person-name">
				<a href="#">SCREEN-NAME</a>
			</div>
			<div class="follow-person-tname">
				<a href="#">@USERNAME</a>
			</div>
			<div class="follow-person-dis">
			    PROFILE-BIO
			</div>
		</div>
	</div>
</div>

</div>
</div> -->
                <!-- TWEETS ACCOUNTS -->

                <div class="in-center">
                    <div class="in-center-wrap">
                        <!-- TWEETS -->
                    </div>
                </div>


            </div>
            <!--in full wrap end-->
        </div><!-- in wrappper ends-->

    </div><!-- ends wrapper -->


</body>

</html>