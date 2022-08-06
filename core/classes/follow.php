<?php
class Follow extends User {

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

    public function followBin($profile_id, $user_id){
        $data = $this->checkFollow($profile_id, $user_id);
        if($this->loggedIn()){
            if($profile_id !== $user_id){
                if(!empty($data['receiver']) && $data['receiver'] === $profile_id){
                    // Following button
                    echo "<button class='f-btn following-btn follow-btn' data-follow='".$profile_id."'>Following</button>";
                }else{
                    // Follow button
                    echo "<button class='f-btn follow-btn' data-follow='".$profile_id."'><i class='fa fa-user-plus'></i>Follow</button>";
                }
            }else{
                // Edit button
            echo "<button class='f-btn' onclick=location.href='profileEdit.php'>Edit Profile</button>";
            }
        }else{
            echo "<button class='f-btn' onclick=location.href='index.php'><i class='fa fa-user-plus'></i>Follow</button>";
        }
    }
}
?>