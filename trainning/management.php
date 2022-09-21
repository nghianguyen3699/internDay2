<?php
    include 'config/database.php';
    session_start();
    // var_dump($_SESSION);
    if (isset($_SESSION['email']) == 0) {
        // echo "welcome to management page 123". "<br>";
        echo 'you need login';
    }
    $query = "SELECT * FROM Posts ORDER BY post_id DESC";
    $result = $conn->query($query);

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .row.content {height: 1500px}
    
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

    <div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
        <h4><?php echo $_SESSION['email'] ?> Blog</h4>
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#section1">Posts</a></li>
        </ul>
        </div>

        <div class="col-sm-9">
            <div class="flex justify-between items-center">
                <h4><small>RECENT POSTS</small></h4>
                <a href="./createPost.php" id="create_btn" class="flex justify-center items-center text-white text-xl bg-green-600 hover:bg-green-700 rounded-lg mx-2 p-2 pt-3 w-48">CREATE POST</a>
            </div>
        <hr>

        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $post_id = $row['post_id'];
                    $title = $row["title"];
                    $description = $row["description"];
                    $user_id = $row["user_id"];
                    $date = $row["date"];
                    echo "
                    <div class='item_post flex items-center justify-between'> 
                        <div class='main_post'>
                            <h2>$title</h2>
                            <h5><span class='glyphicon glyphicon-time'></span> $date.</h5>
                            <p>$description.</p>
                            <br><br>
                        </div>
                        <div class='handle_option flex justify-center items-center'>
                            <a href='/editPost.php?post_id=$post_id' class='edit_btn flex justify-center items-center text-white text-lg bg-blue-600 hover:bg-blue-700 rounded-lg mx-2 p-2'>Edit</a>
                            <button class='delete_btn flex justify-center items-center text-white text-lg bg-red-600 hover:bg-red-700 rounded-lg mx-2 p-2'>Delete</button>
                        </div>
                    </div>
                        ";
                    
                }
            }
        ?>
        
        <hr>

        <h4>Leave a Comment:</h4>
        <form role="form">
            <div class="form-group">
            <textarea class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <br><br>
        
        <p><span class="badge">2</span> Comments:</p><br>
        
        <div class="row">
            <div class="col-sm-2 text-center">
            <img src="bandmember.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-sm-10">
            <h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>
            <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <br>
            </div>
            <div class="col-sm-2 text-center">
            <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-sm-10">
            <h4>John Row <small>Sep 25, 2015, 8:25 PM</small></h4>
            <p>I am so happy for you man! Finally. I am looking forward to read about your trendy life. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <br>
            <p><span class="badge">1</span> Comment:</p><br>
            <div class="row">
                <div class="col-sm-2 text-center">
                <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
                </div>
                <div class="col-xs-10">
                <h4>Nested Bro <small>Sep 25, 2015, 8:28 PM</small></h4>
                <p>Me too! WOW!</p>
                <br>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
