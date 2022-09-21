<?php

    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    // print_r($_SERVER);

    function login($email, $password){
        $dbHostname='192.168.1.215';
        $dbUsername='root';
        $dbPassword='cms-8341';
        $db='mysql';
        $table='Users';

        $conn=new mysqli($dbHostname,$dbUsername,$dbPassword,$db);

        if(!$conn){
            die('Error In connection'.mysqli_connect_error());
        }
        $query = $conn->query("SELECT id, email, password FROM $table");

        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()) {
                if ($email != '' || $password != '') {
                    if ($email == $row["email"] && $password == $row["password"]) {
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $row['id'];
                        header("Location: ./management.php");
                    } else {
                        echo 'Email or Password is incorrect';
                    }
                }
            }
          } else {
            echo "0 results";
        }

        mysqli_close($conn);

    }
    login($email, $password);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mx-10 my-10 min-h-screen flex flex-col items-center justify-center">
        <h1 class="mb-8">Login</h1>
        <form class="w-1/2"
            method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>
    </div>
</body>
</html>