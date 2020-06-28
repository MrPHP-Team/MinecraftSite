<?php include('src/header.php');
    if($_SESSION['loggedin'] == true && $_SESSION['admin'] == 1){?>
        <header class="admin-header">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-12 text-center">
                        <h1 class="admin-title"><?php echo ADMIN_PAGE_TITLE ?></h1>
                    </div>
                    <div class="col-md-8">
                        <?php if(count($alert_success) > 0){;?>
                        	<div class="alert alert-success" role="alert">
                        		<?php foreach($alert_success as $text){
                                    echo $text."<br>";
                                }; ?>
                        	</div>
                        <?php }; ?>
                        <?php if(count($alert_fail) > 0){;?>
                        	<div class="alert alert-danger" role="alert">
                        		<?php foreach($alert_fail as $text){
                                    echo $text."<br>";
                                }; ?>
                        	</div>
                        <?php }; ?>
                    </div>
                </div>
            </div>
        </header>
        <div class="home-session mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">

                        <?php
                        $_GET['edit_new'] = (isset($_GET['edit_new']) ? $_GET['edit_new'] : '');
                        if($_GET['edit_new']){
                            include('src/admin/news_edit.php');
                        }else{
                            $_GET['del_new'] = (isset($_GET['del_new']) ? $_GET['del_new'] : '');
                            if($_GET['del_new']){
                                
                                try {
                                    $pdo = new PDO($dsn, $user, $password);
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $news_delete = $pdo->prepare("DELETE FROM main_posts WHERE id = ?");
                                    $news_delete->execute(array(
                                        $_GET['del_new']
                                    ));
                    
                                    $pdo = null;
                                } catch (PDOException $e) {
                                    die('Connection failed: ' . $e->getMessage());
                                }
                            }
                            include('src/admin/news_create.php');
                            include('src/admin/news_list.php');
                        }
                        ?>

                    </div>
                    <div class="col-md-4 sidebar">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><i class="fas fa-user"></i> Admin panel</h4>
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
                                        <div class="col-md-6 mt-1">
                                            <a href="index.php" class="btn btn-primary btn-block">Home</a>
                                        </div>
                                        <div class="col-md-6 mt-1">
                                            <form method="post">
                                                <button type="submit" name="lognout" class="btn btn-danger btn-block">Lognout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                Auth.SurviveMC.eu
                            </div>
                        </div>
                        
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><i class="fas fa-lock"></i> Change password</h4>
                                </div>
                                <div class="card-text">
                                    <form class="text-center" method="post">
                                        <input name="changepass_actualy" type="password" class="form-control mb-4" placeholder="Current password">
                                        <input name="changepass_new1" type="password" class="form-control mb-1" placeholder="New password">
                                        <input name="changepass_new2" type="password" class="form-control mb-2" placeholder="New password again">
                                    
                                        <button class="btn btn-primary btn-block my-4" type="submit" name="changepass">Change</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                The change will be immediate
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><i class="fas fa-server"></i> Server status</h4>
                                </div>
                                <div class="card-text">
                                    <h5>
                                        <b>Server status:</b> <span class="server-online"></span><br>
                                        <b>Players:</b> <span class="server-players"></span>
                                    </h5>
                                </div>
                            </div>
                            <div class="card-footer">
                                The change will be immediate
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <script src="core/custom-js/tinymce/tinymce.min.js" type="text/javascript"></script> 
        <script>
            tinymce.init({
                selector: '.editor',
                height: 60,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ],
                content_css: [
                    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        </script>
<?php
    }else{
        header('location: index.php');
    }
    include('src/footer.php'); ?>