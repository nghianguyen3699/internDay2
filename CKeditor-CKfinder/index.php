<?php
    if (isset($_POST['submit'])) {
        # code...
        $conn = new mysqli('192.168.1.215', 'root', 'cms-8341', 'mysql');
        $editor_data = $_POST[ 'editor' ];
        $query = "INSERT INTO contents(content) VALUE('$editor_data');";
        $conn->query($query);
        // echo $editor_data;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="ckfinder/ckfinder.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <textarea name="editor" id="editor" class="editor"></textarea>
        <button type="submit" name="submit">submit</button>
    </form>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor(editor);

        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
        console.log();
    </script>
</body>
</html>