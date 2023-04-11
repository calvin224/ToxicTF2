<?php
$wall_paper = "Product.jpg";

?>
    <html>
<head>
    <title>ToxicityChecker.tf</title>
    <link rel="stylesheet" href="/CSS/Homepage.css">
</head>
<body>
<div class="top-bar">
    <a href="Homepage.php">Homepage</a>
    <a href="about.php">About</a>
</div>
<div class="banner">
    <style>
        body {
            background-image: url('<?php echo $wall_paper;?>');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .table-container {
            margin: 9%;
            width: 80%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            color: black;
        }
        .data-table{
            margin: auto;
            color: white;
        }
    </style>
</div>
</body>
</body>

<section class="data-table">

    <div class="table-container">
        <h1> hello </h1>
    </div>
</section>
    </html>
