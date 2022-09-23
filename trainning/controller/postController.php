<?php
    require('config/database.php');
    session_start();

    class PostController {

        public $conn;
        public $title;
        public $description;
        public $category;

        public function __construct($conn, $title = '', $description = '', $category = '')
        {   
            $this->conn = $conn;
            $this->title = $title;
            $this->description = $description;
            $this->category = $category;
        }

        public function create()
        {
            // global $conn;
            $user_id = $_SESSION['id'];

            $date = date('Y-m-d h:i:s');
            if ($this->title != '') {
                $this->conn->query("INSERT INTO Posts(title, description, date, user_id, category) VALUES ('$this->title', '$this->description', '$date', $user_id, '$this->category');");
                header('Location: /management.php');
            } 

            $this->conn->close();

        }

        public function update($postId)
        {
            if ($this->title != '') {
                $this->conn->query("UPDATE Posts SET title='$this->title', description='$this->description', category='$this->category' WHERE post_id=$postId;");
                header('Location: /management.php');
            } 
            $this->conn->close();

        }

        public function delete($postId)
        {
            $this->conn->query("DELETE FROM Posts WHERE post_id=$postId;");
            header('Location: /management.php');
            $this->conn->close();
        }
    }

?>