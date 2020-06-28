<?php
    require_once('config.php');

    $dsn = 'mysql:dbname=' . SQL_DBNAME . ';host=' . SQL_HOST . '';
    $user = SQL_USERNAME;
    $password = SQL_PASSWORD;

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();
    
        $alert_success = array();
        $alert_fail = array();

        if(isset($_POST['main_sign_in'])){
            $log_mail = htmlentities($_POST['sign_in_username']);
            $log_pass = htmlentities($_POST['sign_in_password']);
    
            $dotaz_login = $pdo->prepare("SELECT * FROM main_users WHERE username = ?");
            $dotaz_login->execute(array($log_mail));
            if($dotaz_login->rowCount() == 1){
    
    
                while($data = $dotaz_login->fetch(PDO::FETCH_ASSOC)){
                    
                    if(password_verify($log_pass, $data['password'])){
    
                        $_SESSION['id']         = $data['id'];
                        $_SESSION['username']   = $data['username'];
                        $_SESSION['password']   = $data['password'];
                        $_SESSION['rank']       = $data['rank'];
                        $_SESSION['admin']      = $data['web_admin'];
                        $_SESSION['loggedin']   = true;
    
                        if(!empty($_POST["remember"])) {
                            setcookie ("SystemUserRemember",$data["username"] . '-' . $data["id"],time()+ (10 * 365 * 24 * 60 * 60));
                        } else {
                            if(isset($_COOKIE["member_login"])) {
                                setcookie ("SystemUserRemember","");
                            }
                        }
    
                        array_push($alert_success, "Successfully logged in.");
    
                    }else{
                        array_push($alert_fail, "The password is incorrect.");
                    }
    
                }
    
            }else{
                array_push($alert_fail, "Account does not exist.");
            }
        }
    
        if(isset($_POST['changepass'])){

            $changepass_pass = htmlentities($_POST['changepass_actualy']);
            $changepass_pass_new1 = htmlentities($_POST['changepass_new1']);
            $changepass_pass_new2 = htmlentities($_POST['changepass_new2']);

            $dotaz_check = $pdo->prepare("SELECT * FROM main_users WHERE username = ?");
            $dotaz_check->execute(array($_SESSION['username']));
            while($data = $dotaz_check->fetch(PDO::FETCH_ASSOC)){

                if(password_verify($changepass_pass, $data['password'])){

                    if($changepass_pass_new1 == $changepass_pass_new2){
                        
                        $new_pass = password_hash('admin', PASSWORD_BCRYPT);

                        $change = $pdo->prepare("UPDATE main_users SET password = ? WHERE username = ?");
                        $change->execute(array(
                            $new_pass,
                            $_SESSION['username']
                        ));

                        $_SESSION['password'] = $new_pass;
                        array_push($alert_success, "The password has been changed.");

                    }else{
                        array_push($alert_fail, "Passwords do not match.");
                    }

                }else{
                    array_push($alert_fail, "The password is incorrect.");
                }

            }
        }
    
        if(isset($_POST['lognout'])){
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            unset($_SESSION['rank']);
            unset($_SESSION['admin']);
            $_SESSION['loggedin'] = false;
    
            session_destroy();
        }
    
        $post_add_title = null;
        $post_add_text = null;


        if(isset($_POST['post_add'])){

            $post_add_title     = htmlentities($_POST['post_title']);
            $post_add_text      = htmlentities($_POST['post_text']);

            $target_dir = "core/images/posts/";
            $target_file = $target_dir . basename($_FILES["post_img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["post_img"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                array_push($alert_fail, "File is not an image.");
                $uploadOk = 0;
            }
            
            
            if (file_exists($target_file)) {
                array_push($alert_fail, "Sorry, file already exists.");
                $uploadOk = 0;
            }
  

            if ($uploadOk == 0) {
                array_push($alert_fail, "Sorry, your file was not uploaded.");
            } else {
                if (move_uploaded_file($_FILES["post_img"]["tmp_name"], $target_file)) {
                    array_push($alert_success, "The file ". basename($_FILES["post_img"]["name"]). " has been uploaded.");


                    $post_title     = htmlentities($_POST['post_title']);
                    $post_text      = htmlentities($_POST['post_text']);
                    $post_template  = htmlentities($_POST['post_template']);
                    $post_img       = $target_file;
                    
                    $dotaz = $pdo->prepare("INSERT into main_posts
                        (title, text, img, author, date, time, template) VALUES
                        (?,?,?,?,?,?,?)"
                    );
                    $dotaz->execute(array(
                        $post_title,
                        $post_text,
                        $post_img,
                        $_SESSION['username'],
                        date("d.m.Y"),
                        date("H:i:s"),
                        $post_template
                    ));
                    array_push($alert_success, "The new posts has been added with ID <b>".$pdo->lastInsertId()."</b>.");


                } else {
                    array_push($alert_fail, "Sorry, there was an error uploading your file.");
                }
            }

        }

        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;
        
        $pdo = null;
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
?>