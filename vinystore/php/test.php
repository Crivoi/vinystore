<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action = './test.php' method = GET>
        <button type = "submit" value = "get_id">GET RECORD INFO</button>
    </form>
    
    <?php 
        include_once './app.model.php';

        $files = glob("../img/records/*.{jpg,gif,png,PNG,BMP}", GLOB_BRACE);
        echo $files;
        
        foreach($files as $file){
            echo '<p>'.$file.'</p><br>';
        }
    ?>
</body>
</html>