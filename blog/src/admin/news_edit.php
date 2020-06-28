<?php
    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dotaz = $pdo->prepare("SELECT * FROM `main_posts` WHERE id = ?");
        $dotaz->execute(array(
            $_GET['edit_new']
        ));
        if($dotaz->rowCount() == 1){
            while($data = $dotaz->fetch(PDO::FETCH_ASSOC)){?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"  style="margin:0">
                            <h4 style="margin:0">Post editings</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="text-left" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="post_title" class="">Post title</label>
                                    <input name="edit_post_title" type="text" class="form-control mb-4" placeholder="Title" value="<?php echo $data['title']?>">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="post_template" class="">Post template</label>
                                        <select class="form-control form-control" name="edit_post_template" id="post_template">
                                            <option value="default" <?php if($data['template'] == "default"){ echo 'selected';}?>> Default (Title-IMG)</option>
                                            <option value="next"  <?php if($data['template'] == "next"){ echo 'selected';}?>> Next (IMG-Title)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea style="height:300px" type="text" name="edit_post_text" placeholder='Enter the content of the news' class="editor form-control"><?php echo $data['text']?></textarea>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-warning" type="submit" name="edit_post">Save post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
                if(isset($_POST['edit_post'])){
                    $post_title     = htmlentities($_POST['edit_post_title']);
                    $post_text      = htmlentities($_POST['edit_post_text']);
                    $post_template  = htmlentities($_POST['edit_post_template']);

                    $edit_call = $pdo->prepare("UPDATE main_posts SET title = ?, text = ?, template = ? WHERE id = ?");
                    $edit_call->execute(array(
                        $post_title, 
                        $post_text,
                        $post_template,
                        $_GET['edit_new']
                    ));
                    echo ' <meta http-equiv="refresh" content="0;url=admin.php">';
                }


            }
        }else{
            echo "
                <div class='alert alert-danger' role='alert'>
                    <h4 class='alert-heading'>Error!</h4>
                    <p>The post ID that is entered does not exist!</p>
                    <hr>
                    <p class='mb-0'>Please go back and select an existing post!</p>
                </div>";
        }

    $pdo = null;
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
?>