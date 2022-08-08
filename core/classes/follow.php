<?php
class Follow extends Tweet {

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function checkFollow($follower_id, $user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `follow` WHERE `sender` = :user_id AND `receiver` = :follower_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":follower_id", $follower_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function followBtn($profile_id, $user_id, $follow_id){
        $data = $this->checkFollow($profile_id, $user_id);
        if($this->loggedIn()){
            if($profile_id !== $user_id){
                if(!empty($data['receiver']) && $data['receiver'] === $profile_id){
                    // Following button
                    return "<button class='f-btn following-btn follow-btn' data-follow='".$profile_id."' data-profile='".$follow_id."'>Following</button>";
                }else{
                    // Follow button
                    return "<button class='f-btn follow-btn' data-follow='".$profile_id." 'data-profile='".$follow_id."'><i class='fa fa-user-plus'></i>Follow</button>";
                }
            }else{
                // Edit button
            return "<button class='f-btn' onclick=location.href='profileEdit.php'>Edit Profile</button>";
            }
        }else{
            return "<button class='f-btn' onclick=location.href='index.php'><i class='fa fa-user-plus'></i>Follow</button>";
        }
    }

    public function follow($follow_id, $user_id, $profile_id){
        $this->create('follow', array('sender' => $user_id, 'receiver' => $follow_id, 'followOn' => date("Y-m-d H:i:s")));
        $this->addFollowCount($follow_id, $user_id);
        $stmt = $this->pdo->prepare("SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = `user_id` AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profile_id;");
        $stmt->execute(array("user_id" => $user_id, "profile_id" => $profile_id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function unfollow($follow_id, $user_id, $profile_id){
        $this->delete('follow', array('sender' => $user_id, 'receiver' => $follow_id));
        $this->removeFollowCount($follow_id, $user_id);
        $stmt = $this->pdo->prepare("SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = `user_id` AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profile_id;");
        $stmt->execute(array("user_id" => $user_id, "profile_id" => $profile_id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function addFollowCount($follow_id, $user_id){
        $stmt = $this->pdo->prepare("UPDATE `users` SET `following` = `following` + 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` + 1 WHERE `user_id` = :follow_id;");
        $stmt->execute(array("user_id" => $user_id, "follow_id" => $follow_id));
    }

    public function removeFollowCount($follow_id, $user_id){
        $stmt = $this->pdo->prepare("UPDATE `users` SET `following` = `following` - 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` - 1 WHERE `user_id` = :follow_id;");
        $stmt->execute(array("user_id" => $user_id, "follow_id" => $follow_id));
    }

    public function followingList($profile_id, $user_id, $follow_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `follow` ON `receiver` = `user_id` AND CASE WHEN `sender` = :user_id THEN `receiver` = `user_id` END WHERE `sender` IS NOT NULL");
        $stmt->bindParam(":user_id", $profile_id, PDO::PARAM_INT);
        $stmt->execute();
        $followings = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($followings as $following){
            echo '<div class="follow-unfollow-box">
            <div class="follow-unfollow-inner">
                <div class="follow-background">
                    <img src="'.BASE_URL.$following->profileCover.'"/>
                </div>
                <div class="follow-person-button-img">
                    <div class="follow-person-img"> 
                         <img src="'.BASE_URL.$following->profileImage.'"/>
                    </div>
                    <div class="follow-person-button">
                         <!-- FOLLOW BUTTON -->
                         '.$this->followBtn($following->user_id, $user_id, $follow_id).'
                    </div>
                </div>
                <div class="follow-person-bio">
                    <div class="follow-person-name">
                        <a href="'.BASE_URL.$following->username.'">'.$following->screenName.'</a>
                    </div>
                    <div class="follow-person-tname">
                        <a href="'.BASE_URL.$following->username.'">'.$following->username.'</a>
                    </div>
                    <div class="follow-person-dis">
                        <!-- BIO -->
                        '.$this->getTweetLinks($following->bio).'
                    </div>
                </div>
            </div>
        </div>';
        }
    }

    public function followersList($profile_id, $user_id, $follow_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `follow` ON `sender` = `user_id` AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `receiver` IS NOT NULL");
        $stmt->bindParam(":user_id", $profile_id, PDO::PARAM_INT);
        $stmt->execute();
        $followings = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($followings as $following){
            echo '<div class="follow-unfollow-box">
            <div class="follow-unfollow-inner">
                <div class="follow-background">
                    <img src="'.BASE_URL.$following->profileCover.'"/>
                </div>
                <div class="follow-person-button-img">
                    <div class="follow-person-img"> 
                         <img src="'.BASE_URL.$following->profileImage.'"/>
                    </div>
                    <div class="follow-person-button">
                         <!-- FOLLOW BUTTON -->
                         '.$this->followBtn($following->user_id, $user_id, $follow_id).'
                    </div>
                </div>
                <div class="follow-person-bio">
                    <div class="follow-person-name">
                        <a href="'.BASE_URL.$following->username.'">'.$following->screenName.'</a>
                    </div>
                    <div class="follow-person-tname">
                        <a href="'.BASE_URL.$following->username.'">'.$following->username.'</a>
                    </div>
                    <div class="follow-person-dis">
                        <!-- BIO -->
                        '.$this->getTweetLinks($following->bio).'
                    </div>
                </div>
            </div>
        </div>';
        }
    }

    public function whoToFollow($user_id, $profile_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` <> :user_id AND `user_id` NOT IN (SELECT `receiver` FROM `follow` WHERE `sender` = :user_id) ORDER BY rand() LIMIT 3;");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo '<div class="follow-wrap"><div class="follow-inner"><div class="follow-title"><h3>Who to follow</h3></div>';
        foreach ($data as $user){
            echo '<div class="follow-body">
            <div class="follow-img">
              <img src="'.BASE_URL.$user->profileImage.'"/>
            </div>
            <div class="follow-content">
                <div class="fo-co-head">
                    <a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a><span>@'.$user->username.'</span>
                </div>
                <!-- FOLLOW BUTTON -->
                '.$this->followBtn($user->user_id, $user_id, $profile_id).'
            </div>
        </div>';
        }
        echo '</div></div>';
    }
}
