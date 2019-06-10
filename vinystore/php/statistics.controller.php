<?php   
    $CONFIG = [
        'servername' => "localhost",
        'username' => "root",
        'password' => '',
        'db' => 'vinystore'
    ];

    $conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);

    if(isset($_POST['submit-PDF'])){


        define('FPDF_FONTPATH','./font/');
        include_once './fpdf.php';
        
        GLOBAL $conn;

        if($_POST['period']=='Week' and $_POST['about']=='All data'){
            $query = "SELECT username AS USER,label  AS LABEL, catalogue AS CATALOGUE,price AS PRICE,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY date_added asc";
        }

        if($_POST['period']=='Month' and $_POST['about']=='All data'){
            $query = "SELECT username  AS USER,label  AS LABEL, catalogue AS CATALOGUE,price AS PRICE ,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
        }

        if($_POST['period']=='Year' and $_POST['about']=='All data'){
            $query = "SELECT username  AS USER,label  AS LABEL, catalogue AS CATALOGUE,price AS PRICE,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
        }

        if($_POST['period']=='All time' and $_POST['about']=='All data'){
            $query = "SELECT username AS USER,label AS LABEL, catalogue AS CATALOGUE,price AS PRICE,date_added AS DATE FROM records JOIN users ON records.id_user=users.id_user ORDER BY date_added asc";
        }

        if($_POST['period']=='Week' and $_POST['about']=='Album'){
            $query = "SELECT album AS ALBUM,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY album asc";
        }

        if($_POST['period']=='Month' and $_POST['about']=='Album'){
            $query = "SELECT album AS ALBUM ,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
        }

        if($_POST['period']=='Year' and $_POST['about']=='Album'){
            $query = "SELECT album AS ALBUM ,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
        }

        if($_POST['period']=='All time' and $_POST['about']=='Album'){
            $query = "SELECT album AS ALBUM ,Count(album) as NR_OF_COPIES,(Count(album)* 100 / (Select Count(*) From records)) as PERCENT FROM records ORDER BY album asc";
        }

        if($_POST['period']=='Week' and $_POST['about']=='Artist'){
            $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY artist asc";
        }

        if($_POST['period']=='Month' and $_POST['about']=='Artist'){
            $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
        }

        if($_POST['period']=='Year' and $_POST['about']=='Artist'){
            $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
        }

        if($_POST['period']=='All time' and $_POST['about']=='Artist'){
            $query = "SELECT artist AS ARTIST ,Count(artist) as NR_OF_COPIES,(Count(artist)* 100 / (Select Count(*) From records)) as PERCENT FROM records ORDER BY artist asc";
        }

        if($_POST['period']=='Week' and $_POST['about']=='Stock'){
            $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY label asc";
        }

        if($_POST['period']=='Month' and $_POST['about']=='Stock'){
            $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
        }

        if($_POST['period']=='Year' and $_POST['about']=='Stock'){
            $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
        }

        if($_POST['period']=='All time' and $_POST['about']=='Stock'){
            $query = "SELECT label AS LABEL ,Count(label) as NR_OF_COPIES,(Count(label)* 100 / (Select Count(*) From records)) as PERCENT FROM records ORDER BY label asc";
        }

        if($_POST['period']=='Week' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY PERCENT asc";
        }

        if($_POST['period']=='Month' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
        }

        if($_POST['period']=='Year' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
        }

        if($_POST['period']=='All time' and $_POST['about']=='Best Buyer'){
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

    }

    if(isset($_POST['submit-CSV'])){

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Statistici_VinyStore.csv');
    
        $output = fopen('php://output', 'w');

        GLOBAL $conn;
        
        if($_POST['period']=='Week' and $_POST['about']=='All data'){
            $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY date_added asc";
            fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
        }

        if($_POST['period']=='Month' and $_POST['about']=='All data'){
            $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
            fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
        }

        if($_POST['period']=='Year' and $_POST['about']=='All data'){
            $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY date_added asc";
            fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
        }

        if($_POST['period']=='All time' and $_POST['about']=='All data'){
            $query = "SELECT id_user,artist,album,label,catalogue,genre,cond,price,date_added FROM records ORDER BY date_added asc";
            fputcsv($output, array('ID User', 'ARTIST', 'ALBUM', 'LABEL', 'CATALOGUE','GENRE','CONDITION','PRICE','DATE ADDED'));
        }

        if($_POST['period']=='Week' and $_POST['about']=='Album'){
            $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY album asc";
            fputcsv($output, array('ALBUM','NUMBER OF ALBUMS','ALBUM PERCENTAGE'));
        }

        if($_POST['period']=='Month' and $_POST['about']=='Album'){
            $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
            fputcsv($output, array('ALBUM','NUMBER OF ALBUMS','ALBUM PERCENTAGE'));
        }

        if($_POST['period']=='Year' and $_POST['about']=='Album'){
            $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY album asc";
            fputcsv($output, array('ALBUM','NUMBER OF ALBUMS','ALBUM PERCENTAGE'));
        }

        if($_POST['period']=='All time' and $_POST['about']=='Album'){
            $query = "SELECT album,Count(album) as NRALBUMS,(Count(album)* 100 / (Select Count(*) From records)) as PRCALBUMS FROM records ORDER BY album asc";
            fputcsv($output, array('ALBUM','NUMBER OF ALBUMS IN STOCK','ALBUM PERCENTAGE'));
        }

        if($_POST['period']=='Week' and $_POST['about']=='Artist'){
            $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY artist asc";
            fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
        }

        if($_POST['period']=='Month' and $_POST['about']=='Artist'){
            $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
            fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
        }

        if($_POST['period']=='Year' and $_POST['about']=='Artist'){
            $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY artist asc";
            fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
        }

        if($_POST['period']=='All time' and $_POST['about']=='Artist'){
            $query = "SELECT artist,Count(artist) as NRARTIST,(Count(artist)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records ORDER BY artist asc";
            fputcsv($output, array('ARTIST','NUMBER OF ARTIST','ARTIST PERCENTAGE'));
        }

        if($_POST['period']=='Week' and $_POST['about']=='Stock'){
            $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY label asc";
            fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
        }

        if($_POST['period']=='Month' and $_POST['about']=='Stock'){
            $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
            fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
        }

        if($_POST['period']=='Year' and $_POST['about']=='Stock'){
            $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY label asc";
            fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));
        }

        if($_POST['period']=='All time' and $_POST['about']=='Stock'){
            $query = "SELECT label,Count(label) as NRARTIST,(Count(label)* 100 / (Select Count(*) From records)) as PRCARTIST FROM records ORDER BY label asc";
            fputcsv($output, array('LABEL','NUMBER OF LABEL','LABEL PERCENTAGE'));

        if($_POST['period']=='Week' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  ORDER BY PERCENT asc";
            fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
        }
    
        if($_POST['period']=='Month' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
            fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
        }
    
        if($_POST['period']=='Year' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user WHERE date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+365 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ORDER BY PERCENT asc";
            fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
        }
    
        if($_POST['period']=='All time' and $_POST['about']=='Best Buyer'){
            $query = "SELECT username AS BUYER ,Count(orders.id_user) as NR_OF_PURC,(Count(orders.id_user)* 100 / (Select Count(*) From records)) as PERCENT FROM users join orders ON users.id_user = orders.id_user ORDER BY PERCENT asc";
            fputcsv($output, array('BUYER','NUMBER OF PURCHASES','NUMBER OF PURCHASES'));
        }
        }
        
        $rows = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_row($rows)) fputcsv($output, $row);
    }

    if(isset($_POST['submit-HTML'])){

    }
?>