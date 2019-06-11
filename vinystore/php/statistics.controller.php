<?php 
        include_once 'app.model.php';

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

                    // header('Location: /php/statistics.php');
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

                    // header('Location: /php/statistics.php');
                    break;
                case 'HTML':

                
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

                $data = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
                $output="<style>#customers {";
                $output.="font-family: Arial, Helvetica, sans-serif;";
                $output.="border-collapse: collapse;";
                $output.="width: 100%;}";

                $output.="#customers td, #customers th {";
                $output.="border: 1px solid #ddd;";
                $output.="padding: 8px;}";
                $output.="#customers tr:nth-child(even){background-color: #f2f2f2;}";
                $output.="#customers tr:hover {background-color: #ddd;}";

                $output.="#customers th {";
                $output.="padding-top: 12px;";
                $output.="padding-bottom: 12px;";
                $output.="text-align: left;";
                $output.="background-color: #4CAF50;";
                $output.="color: white;}</style>";

                $output.="<h1>Statistici</h1>";
                
                $output .= '<table id="customers" >';
                foreach($data as $key => $var) {
                    if($key===0) {
                        $output .= '<tr>';
                        foreach($var as $col => $val) {
                            $output .= "<td>" . $col . '</td>';
                        }
                        $output .= '</tr>';
                        foreach($var as $col => $val) {
                            $output .= '<td>' . $val . '</td>';
                        }
                        $output .= '</tr>';
                    }
                    else {
                        $output .= '<tr>';
                        foreach($var as $col => $val) {
                             $output .= '<td>' . $val . '</td>';
                        }
                        $output .= '</tr>';
                    }
                }
                $output .= '</table>';
                echo htmlspecialchars($output);
	            break;
            }
        }
    ?>