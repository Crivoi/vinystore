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

    <!-- <form action = './test.php' method = POST>
        <button type = "submit" value = "post">POST</button>
    </form> -->

    <?php 
        include_once './app.model.php';

        $record = get_record_by_id(5);
        // echo $record->artist;

        foreach($record as $rec){
            echo $rec['album'];
        }
    ?>
</body>
</html>