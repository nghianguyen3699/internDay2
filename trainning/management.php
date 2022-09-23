<?php
    include 'config/database.php';
    session_start();

    if (isset($_SESSION['email']) == 0) {
        header('Location: /');
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
        <div class="row h-full">
            <div class="col-sm-3">
                <h4 class="flex justify-between items-center">
                    <?php echo $_SESSION['email'] ?> 
                    <a href="/logout.php" class="flex items-center justyfy-center text-white hover:text-white hover:no-underline hover:bg-red-700 rounded-lg p-2 bg-red-500">Log out</a>
            
                </h4>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#section1">Posts</a></li>
                </ul>
            </div>

            <div class="col-sm-9 border-l-2">
                <div class="flex justify-between items-center">
                    <h4><small>RECENT POSTS</small></h4>
                    <a href="/createPost.php" id="create_btn" class="flex justify-center items-center text-white text-xl bg-green-600 hover:bg-green-700 rounded-lg mx-2 p-2 pt-3 w-48">CREATE POST</a>
                </div>
                <hr>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $post_id = $row['post_id'];
                            $title = $row["title"];
                            $description = $row["description"];
                            $category = $row['category'];
                            $user_id = $row["user_id"];
                            $date = $row["date"];
                            echo "
                                <div class='item_post flex items-start justify-between'> 
                                    <div class='main_post w-full'>
                                        <h2>$title</h2>
                                        <h5><span class='glyphicon glyphicon-time'></span> $date.</h5>
                                        <h5 class='font-bold'> $category</h5>
                                        <div class='border w-full overflow-auto' style='height: 300px'>
                                            <div class='m-4'>$description</div>
                                        </div>
                                        <br><br>
                                    </div>
                                    <div class='handle_option flex justify-centert mt-10'>
                                        <a href='/viewPost.php?post_id=$post_id' class='view_btn flex justify-center items-center text-white text-lg bg-green-600 hover:bg-green-700 rounded-lg mx-2 p-2'>View</a>
                                        <a href='/editPost.php?post_id=$post_id' class='edit_btn flex justify-center items-center text-white text-lg bg-blue-600 hover:bg-blue-700 rounded-lg mx-2 p-2'>Edit</a>
                                        <input class='link_post hidden' value='http://cms215.dev1.local/viewPost.php?post_id=$post_id'>
                                        <button class='copy_btn flex justify-center items-center text-white text-lg bg-yellow-600 hover:bg-yellow-700 rounded-lg mx-2 p-2'>Copy</button>
                                        <a href='/deletePost.php?post_id=$post_id' class='delete_btn flex justify-center items-center text-white text-lg bg-red-600 hover:bg-red-700 rounded-lg mx-2 p-2'>Delete</a>
                                    </div>
                                </div>
                                <hr>
                                    ";
                            
                        }
                    }
                ?>
            </div>
        </div>
    </div>

<footer class="container-fluid">
</footer>

<script>

function copyClipboard() {
    const copyBtns = document.querySelectorAll(".copy_btn");

    copyBtns.forEach((ele) => {
        ele.addEventListener('click', () => {
            let str = ele.parentNode.getElementsByTagName('input')[0].value
            const el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            alert('Link of post was copy to clipboard!')

        })

    })
}
copyClipboard()

</script>
</body>
</html>
