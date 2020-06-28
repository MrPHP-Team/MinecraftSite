<?php include('src/header.php'); ?>
        <header class="home-header">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-md-8">
                        <h1 class="home-server-name"><?php echo MAIN_SERVER_NAME_WHITE ?><span><?php echo MAIN_SERVER_NAME_BLUE ?></span></h1>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-home-server btn-block">
                                    Status: <span class="server-online"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="btn btn-home-server btn-block mt-3">
                                    play.SurviveMC.eu
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="home-session mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="col-title"><?php echo HOME_TITLE_LATEST_POSTS ?></h1>

                        <?php

                            
                            $dotaz_news = $pdo->prepare("SELECT * FROM main_posts ORDER BY id DESC");
                            $dotaz_news->execute();
                            
                            while($data = $dotaz_news->fetch(PDO::FETCH_ASSOC)){

                                if($data['template'] == "default"){?>

                                    <div class="card posts mt-3">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <?php echo $data['title']; ?>
                                            </div>
                                            <div class="view overlay">
                                                <img class="card-img-top" src="<?php echo $data['img']; ?>" alt="Post #<?php echo $data['id']; ?>">
                                                <a href="#!">
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>
                                            <div class="card-text">
                                                <?php echo html_entity_decode($data['text']); ?>
                                            </div>
                                            <a href="#" class="btn btn-primary">Read more</a>
                                        </div>
                                        <div class="card-footer">
                                            <i class="fas fa-user"></i> Author: <a href="#"><?php echo $data['author']; ?></a> | <i class="fas fa-calendar"></i> <?php echo $data['date']; ?> <?php echo $data['time']; ?>
                                        </div>
                                    </div>

                                <?php
                                }elseif($data['template'] == "next"){?>

                                    <div class="card posts mt-3">
                                        <div class="view overlay">
                                            <img class="card-img-top" src="<?php echo $data['img']; ?>" alt="Post #<?php echo $data['id']; ?>">
                                            <a href="#!">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <?php echo $data['title']; ?>
                                            </div>
                                            <div class="card-text">
                                                <?php echo html_entity_decode($data['text']); ?>
                                            </div>
                                            <a href="#" class="btn btn-primary">Read more</a>
                                        </div>
                                        <div class="card-footer">
                                            <i class="fas fa-user"></i> Author: <a href="#"><?php echo $data['author']; ?></a> | <i class="fas fa-calendar"></i> <?php echo $data['date']; ?> <?php echo $data['time']; ?>
                                        </div>
                                    </div>

                                <?php
                                }

                            }

                        ?>

                    </div>
                    <div class="col-md-4 sidebar">
                        <h1 class="col-title"><?php echo HOME_TITLE_SIDEBAR ?></h1>
                        
                        <?php if(count($alert_success) > 0){;?>
                        	<div class="alert alert-success" role="alert">
                        		<?php foreach($alert_success as $text){
                                    echo $text;
                                }; ?>
                        	</div>
                        <?php }; ?>
                        <?php if(count($alert_fail) > 0){;?>
                        	<div class="alert alert-danger" role="alert">
                        		<?php foreach($alert_fail as $text){
                                    echo $text;
                                }; ?>
                        	</div>
                        <?php }; ?>
                        <?php if($_SESSION['loggedin'] == true){?>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><i class="fas fa-user"></i> User panel</h4>
                                </div>
                                <div class="card-text">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="core/images/user_login_avatar.png" class="rounded-circle border img-fluid" width="100%">
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="user-profile">
                                                <?php echo $_SESSION['username'] ?><br>
                                                <small>
                                                    <span>Rank:</span> <?php echo $_SESSION['rank'] ?><br>
                                                    <span>WebAdmin:</span> <?php if($_SESSION['admin'] == 1){echo "Yes";}else{ echo 'No';}; ?>
                                                </small>
                                            </h5>
                                        </div>
                                        <?php if($_SESSION['admin'] == 1){
                                                echo '
                                                <div class="col-md-6 mt-1">
                                                    <a href="admin.php" class="btn btn-primary btn-block">Admin</a>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <form method="post">
                                                        <button type="submit" name="lognout" class="btn btn-danger btn-block">Lognout</button>
                                                    </form>
                                                </div>';
                                            }else{
                                                echo '
                                                <div class="col-md-12 mt-1">
                                                    <form method="post">
                                                        <button type="submit" name="lognout" class="btn btn-danger btn-block">Lognout</button>
                                                    </form>
                                                </div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                Auth.SurviveMC.eu
                            </div>
                        </div>
                        <?php }else{?>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><i class="fas fa-sign-in-alt"></i> Sign in</h4>
                                </div>
                                <div class="card-text">
                                    <form class="text-center" method="post"> 
                                        <input name="sign_in_username" type="text" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Username">
                                        <input name="sign_in_password" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">
                                    
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <div class="custom-control custom-checkbox">
                                                    <input name="remember" type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                                                    <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="">Forgot password?</a>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block my-4" type="submit" name="main_sign_in">Sign in</button>
                                    
                                        <p>Not a member?
                                            <a href="">Register</a>
                                        </p>
                                        <p>or sign in with:</p>
                                    
                                        <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="mx-2" role="button"><i class="fab fa-twitter"></i></a>
                                        <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#" class="mx-2" role="button"><i class="fab fa-github"></i></a>
                                    
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                Auth.SurviveMC.eu
                            </div>
                        </div>
                        <?php }?>
                        
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><i class="fas fa-vote-yea"></i> Vote for server</h4>
                                </div>
                                <div class="card-text">
                                    <form class="text-center" action="#!">
                                        <input type="text" id="nickname" class="form-control mb-4" placeholder="Nickname">
                                        <button class="btn btn-primary btn-block my-4" type="submit">Send vote</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                The /vote command on the server
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include('src/footer.php'); ?>