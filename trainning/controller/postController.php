<?php
    require('config/database.php');
    // global $conn;
    session_start();
    class PostController {

        public function create($post)
        {
            global $conn;
            $user_id = $_SESSION['id'];
            $title = $post['title'];
            $description = $post['description'];
            // $hashtag = $post['hashtag'];
            $date = date('Y-m-d h:m:s');
            if ($title != '') {
                # code...
                $conn->query("INSERT INTO Posts(title, description, date, user_id) VALUES ('$title', '$description', '$date', $user_id);");
                
                echo "<div class='text-white font-bold p-3 bg-green-500 rounded-lg'>New Post created successfully</div>";
            } 
            // else {
            //     echo "<div class='text-white font-bold p-3 bg-red-500 rounded-lg'>Create fail</div>";
            // }
            $conn->close();

        }

        public function update($post, $post_id)
        {
            global $conn;
            $title = $post['title'];
            $description = $post['description'];
            if ($title != '') {
                # code...
            } 

        }
    }

    // $output = new PostController($conn);
?>