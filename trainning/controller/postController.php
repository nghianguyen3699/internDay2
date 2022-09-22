<?php
    require('config/database.php');
    session_start();

    class PostController {

        public $title;
        public $description;
        public $category;

        public function __construct($title = '', $description = '', $category = '')
        {
            $this->title = $title;
            $this->description = $description;
            $this->category = $category;
        }

        public function create()
        {
            global $conn;
            $user_id = $_SESSION['id'];

            $date = date('Y-m-d h:m:s');
            if ($this->title != '') {
                $conn->query("INSERT INTO Posts(title, description, date, user_id, category) VALUES ('$this->title', '$this->description', '$date', $user_id, '$this->category');");
                header('Location: /management.php');
            } 

            $conn->close();

        }

        public function update($postId)
        {
            global $conn;

            if ($this->title != '') {
                $conn->query("UPDATE Posts SET title='$this->title', description='$this->description', category='$this->category' WHERE post_id=$postId;");
                header('Location: /management.php');
            } 
            $conn->close();

        }

        public function delete($postId)
        {
            global $conn;
            $conn->query("DELETE FROM Posts WHERE post_id=$postId;");
            header('Location: /management.php');
            $conn->close();
        }
    }

?>