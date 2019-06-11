<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/statistics.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php
        include_once 'bot_nav.php';
        include_once 'top_nav.php';
        include_once 'filters.php';
        include_once 'app.model.php';

        if(isset($_SESSION['id_user'])){
            $user = getLoggedUser($_SESSION['id_user']);
        }else{
            header('Location: /login');
        }
    ?>
    
    <div class = "stats-container">
        <h2>Select options: </h2>
        <form action = "statistics.controller.php" id = "generate-statistics" method = "POST">
            <div class = "stat-item">
                <p>View statistics about: </p>
                <br>
                <select name="about" form="generate-statistics" >
                    <option value = "stock">Stock</option>
                    <option value = "sales">Best Buyers</option>
                    <option value = "album">Album</option>
                    <option value = "artist">Artist</option>
                    <option value = "all-data">All data</option>
                </select>
                <br>
                <p>In the last: </p>
                <br>
                <select name="period" form="generate-statistics">
                    <option value = "week">Week</option>
                    <option value = "month">Month</option>
                    <option value = "year">Year</option>
                    <option value = "all-time">All time</option>
                </select>
                <br>
                <p>Export as: </p>
                <button type = "submit"  name = "submit" class = "exp-btn" value = "PDF">PDF</button>
                <button type = "submit"  name = "submit" class = "exp-btn" value = "CSV">CSV</button>
                <button type = "submit"  name = "submit" class = "exp-btn" value = "HTML">HTML</button>                        
                <br>
            </div>
        </form>
    </div>

    <?php 
        GLOBAL $conn;
        if(isset($_POST['submit'])){
            switch($_POST['submit']){
                case 'PDF':
                    define('FPDF_FONTPATH','./font/');
                    include_once './fpdf.php';

                    if($_POST['period']=='week' and $_POST['about']=='all-data'){
                        $query = "SELECT username AS USER,label  AS LABEL, catalogue AS CATALOGUE,price AS PRICE,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY date_added asc";
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='all-data'){
                        $query = "SELECT username  AS USER,label  AS LABEL, catalogue AS CATALOGUE,price AS PRICE ,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='all-data'){
                        $query = "SELECT username  AS USER,label  AS LABEL, catalogue AS CATALOGUE,price AS PRICE,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='all-data'){
                        $query = "SELECT username AS USER,label AS LABEL, catalogue AS CATALOGUE,price AS PRICE,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user ORDER BY date_added asc";
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='album'){
                        $query = "SELECT album AS ALBUM,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY album asc";
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='album'){
                        $query = "SELECT album AS ALBUM ,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='album'){
                        $query = "SELECT album AS ALBUM ,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
                    }
            
                    if($_POST['period']=='all time' and $_POST['about']=='album'){
                        $query = "SELECT album AS ALBUM ,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records ORDER BY album asc";
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='artist'){
                        $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY artist asc";
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='artist'){
                        $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='artist'){
                        $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='artist'){
                        $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records ORDER BY artist asc";
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='stock'){
                        $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY label asc";
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='stock'){
                        $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='stock'){
                        $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='stock'){
                        $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records ORDER BY label asc";
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY PERCENT asc";
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user ORDER BY PERCENT asc";
                    }

                    $resultset = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
            
                    $pdf = new FPDF();
                        $pdf->AddPage();
                        $pdf->SetFont('Arial','B',10);
                        while ($field_info = mysqli_fetch_field($resultset)) {
                                $pdf->Cell(38,12,$field_info->name,1);
                        }
                        while($rows = mysqli_fetch_assoc($resultset)) {
                                $pdf->SetFont('Arial','',10);
                                $pdf->Ln();
                                foreach($rows as $column) {
                                    $pdf->Cell(38,12,$column,1);
                                }
                            }
                    $pdf->Output();
                    break;
                case 'CSV':
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Disposition: attachment; filename=Statistici_VinyStore.csv');
                
                    $output = fopen('php://output', 'w');

                    if($_POST['period']=='week' and $_POST['about']=='all-data'){
                        $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY date_added asc";
                        fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='all-data'){
                        $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
                        fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='all-data'){
                        $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
                        fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='all-data'){
                        $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records ORDER BY date_added asc";
                        fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='album'){
                        $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY album asc";
                        fputcsv($output, array('ALBUM','NUMBER OF ALBUMS','ALBUM PERCENTAGE'));
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='album'){
                        $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
                        fputcsv($output, array('ALBUM','NUMBER OF ALBUMS','ALBUM PERCENTAGE'));
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='album'){
                        $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
                        fputcsv($output, array('ALBUM','NUMBER OF ALBUMS','ALBUM PERCENTAGE'));
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='album'){
                        $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records ORDER BY album asc";
                        fputcsv($output, array('ALBUM','NUMBER OF ALBUMS IN STOCK','ALBUM PERCENTAGE'));
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='artist'){
                        $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY artist asc";
                        fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='artist'){
                        $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
                        fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='artist'){
                        $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
                        fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='artist'){
                        $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records ORDER BY artist asc";
                        fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
                    }
            
                    if($_POST['period']=='week' and $_POST['about']=='stock'){
                        $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY label asc";
                        fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
                    }
            
                    if($_POST['period']=='month' and $_POST['about']=='stock'){
                        $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
                        fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
                    }
            
                    if($_POST['period']=='year' and $_POST['about']=='stock'){
                        $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
                        fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
                    }
            
                    if($_POST['period']=='all-time' and $_POST['about']=='stock'){
                        $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records ORDER BY label asc";
                        fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
            
                    if($_POST['period']=='week' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY PERCENT asc";
                        fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
                    }
                
                    if($_POST['period']=='month' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
                        fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
                    }
                
                    if($_POST['period']=='year' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
                        fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
                    }
                
                    if($_POST['period']=='all-time' and $_POST['about']=='sales'){
                        $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user ORDER BY PERCENT asc";
                        fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
                    }
                    }
                    
                    $rows = mysqli_query($conn, $query);
            
            
                    while ($row = mysqli_fetch_row($rows)) fputcsv($output, $row);
                    break;
                case 'HTML':
                    break;
            }
        }
    ?>
</body>
</html>