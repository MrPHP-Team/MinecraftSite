<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h4>New post</h4>
        </div>
        <div class="card-text">
            <form class="text-right" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <input name="post_title" type="text" class="form-control mb-4" placeholder="Title" value="<?php echo $post_add_title?>">
                    </div>
                    <div class="col-md-4">
                        <input name="post_author" type="text" class="form-control mb-4" value="<?php echo $_SESSION['username']?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <input name="post_author" type="text" class="form-control mb-4" value="<?php echo date("d.m.Y H:s")?>" readonly>
                    </div>
                    <div class="col-md-6 text-left">
                        <div class="form-group">
                            <label for="exampleFormControlFile1" class="text-left">Post img <small>(730px x 190px)</small></label>
                            <input type="file" name="post_img" id="post_img" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="post_template" class="text-left">Post template</label>
                            <select class="form-control form-control-sm" name="post_template" id="post_template">
                                <option value="default"> Default (Title-IMG)</option>
                                <option value="next"> Next (IMG-Title)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea style="height:300px" type="text" name="post_text" placeholder='Enter the content of the news' class="editor form-control"><?php echo $post_add_text?></textarea>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit" name="post_add">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>