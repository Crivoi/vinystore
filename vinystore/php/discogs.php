<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action = './index.php' method = "GET">
        <input type = "number" placeholder = "page" name = "page">
        <input type = "number" placeholder = "per_page" name = "per_page">
        <button type = "submit" name = "submit">Search</button>
    </form>
</body>
</html>

<?php 

    ini_set('user_agent', $_SERVER['HTTP_USER_AGENT']);
    if(!empty($_GET['page']) && !empty($_GET['per_page'])){
        $rls_url = "https://api.discogs.com/artists/1/releases?page=". urlencode($_GET['page']) ."&per_page=". urlencode($_GET['per_page']);

        $rls_json = file_get_contents($rls_url);
        $rls_array = json_decode($rls_json, true);

        foreach($rls_array['releases'] as $rls){
            echo $rls['id'] ."<br>";
            $url = "https://api.discogs.com/releases/". urlencode($rls['id']);
            $info_json = file_get_contents($url);
            $info_array = json_decode($info_json, true);
            echo $info_array['title'];
        }
    }
?>

