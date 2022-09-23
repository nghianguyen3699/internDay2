<?php
    require_once('config/database.php');
    require_once('controller/postController.php');
    session_start();

    if (!isset($_SESSION['email'])) {
        header('Location: /');
    }

    $post = $_POST;

    // if (isset($post['submit'])) {
    //     $editor_data = $post[ 'editor' ];
    //     $query = "INSERT INTO contents(content) VALUE('$editor_data');";
    //     $conn->query($query);

    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Create Post</title>
</head>
<body>
<div class="container mx-10 min-h-screen flex flex-col items-center justify-center">
    <div class="flex items-center justify-start w-full">
        <div class="offset-4 col-8">
            <a href="/management.php" name="submit" type="submit" class="btn btn-danger">Back</a>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="font-bold">CREATE POST</h1>
        <form class="w-4/5" action="
            <?php
                if (isset($post['submit']) == 1) {
                    $var = new PostController($conn, $post['title'], $post['description'], $post['category']);
                    $result = $var->create($post);
                }
            ?>" 
            method="POST">
            <div class="form-group row">
                <label for="title" class="col-4 col-form-label">Title</label> 
                <div class="col-8">
                    <input id="title" name="title" placeholder="Work from home....." type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-4 col-form-label">Category</label> 
                <div class="col-8">
                    <input id="category" name="category" placeholder="travel, animal,...." type="text" class="form-control">
                </div>
            </div> 
            <div class="form-group row">
                <label for="description" class="col-4 col-form-label">Description</label> 
                <div class="col-8">
                    <textarea id="description" name="description" cols="40" rows="5" placeholder="Task 1......" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    var description = CKEDITOR.replace( 'description' );
    CKFinder.setupCKEditor(description);
</script>
</body>
</html>