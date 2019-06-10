<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/statistics.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php   
        include_once './bot_nav.php';
        include_once './top_nav.php';
        include_once './filters.php';
    ?>
    <div class = "stats-container">
        <h2>Select options: </h2>
        <div class = "stat-item">
            <p>View statistics about: </p>
            <br>
            <select name="about" form="generate-statistics" >
                <option value = "Stock">Stock</option>
                <option value = "Sales">Best Buyers</option>
                <option value = "Album">Album</option>
                <option value = "Artist">Artist</option>
                <option value = "all-data">All data</option>
            </select>
            <br>
            <p>In the last: </p>
            <br>
            <select name="period" form="generate-statistics">
                <option value = "week">Week</option>
                <option value = "month">Month</option>
                <option value = "year">Year</option>
                <option value = "ever">All time</option>
            </select>
            <br>
            <p>Export as: </p>
            <form action = "/php/statistics.controller.php" id = "generate-statistics" method = "POST">
                        <button type = "submit"  name = "submit-PDF" class = "exp-btn">PDF</button>
                        <button type = "submit"  name = "submit-CSV" class = "exp-btn">CSV</button>
                        <button type = "submit"  name = "submit-HTML" class = "exp-btn">HTML</button>                        
            </form>

            <br>
        </div>
    </div>
</body>
</html>