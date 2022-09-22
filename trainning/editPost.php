<?php
    include 'config/database.php';
    require_once('controller/postController.php');

    session_start();

    if (isset($_SESSION['email']) == 0) {
        header('Location: /');
    }

    $postId = $_GET['post_id'];
    $post = $_POST;

    $query = "SELECT * FROM Posts WHERE post_id = $postId";
    $resultId = $conn->query($query)->fetch_assoc();
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
    <h1 class="font-bold">EDIT POST</h1>
    <form class="w-1/2" action="
        <?php
                $var = new PostController($post['title'], $post['description'], $post['category']);
                $result = $var->update($postId);
        ?>" 
        method="POST">
        <div class="form-group row">
            <label for="title" class="col-4 col-form-label">Title</label> 
            <div class="col-8">
                <input id="title" name="title" value="<? echo $resultId['title'] ?>" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-4 col-form-label">Description</label> 
            <div class="col-8">
                <textarea id="description" name="description" cols="40" rows="5" class="form-control"><? echo $resultId['description'] ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-4 col-form-label">Category</label> 
            <div class="col-8">
                <input id="category" name="category" value="<? echo $resultId['category'] ?>" type="text" class="form-control">
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>