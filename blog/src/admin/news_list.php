<div class="card mt-3">
    <div class="card-header">
        <div class="card-title"  style="margin:0">
            <h4 style="margin:0">List of posts</h4>
        </div>
    </div>
    <div class="card-body">

        <table class="table table-sm table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Template</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try {
                        $pdo = new PDO($dsn, $user, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        $dotaz = $pdo->prepare("SELECT * FROM `main_posts` ORDER BY `id` DESC");
                        $dotaz->execute();
                        while($data = $dotaz->fetch(PDO::FETCH_ASSOC)){
                ?>
                            <tr>
                                <td><?php echo $data['id']?></td>
                                <td><?php echo $data['title']?></td>
                                <td>
                                    <?php 
                                        if($data['template'] == 'default'){
                                            echo '<span class="badge bg-success">default</span>';
                                        }else{
                                            echo '<span class="badge bg-danger">'.$data['template'].'</span>';
                                        }
                                    ?>
                                </td>
                                <td><?php echo $data['date'] . " " . $data['time']?></td>
                                <td><?php echo $data['author'] ?></td>
                                <td class="text-center">
                                    <a href="?del_new=<?php echo $data['id']?>" style="color:red">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="?edit_new=<?php echo $data['id']?>" style="color:#4285f4 ">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                <?php
                        }
                    
                        $pdo = null;
                    } catch (PDOException $e) {
                        die('Connection failed: ' . $e->getMessage());
                    }
                ?>
            </tbody>
        </table>
        
    </div>
</div>