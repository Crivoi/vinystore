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
            <select>
                <option value = "stock">Stock</option>
                <option value = "sales">Sales</option>
                <option value = "buyers">Faithful Buyers</option>
            </select>
            <br>
            <p>In the last: </p>
            <br>
            <select>
                <option value = "week">Week</option>
                <option value = "month">Month</option>
                <option value = "sem">Semester</option>
                <option value = "year">Year</option>
                <option value = "ever">All time</option>
            </select>
            <br>
            <p>Export as: </p>
            <br>
            <button class = "exp-btn">PDF</button>
            <button class = "exp-btn">CSV</button>
            <button class = "exp-btn">HTML</button>
            <button class = "exp-btn">View In Browser</button>
        </div>
    </div>
</body>
</html>