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
            margin: 10px;
            color: transparent;
        }
        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            margin: auto;
            height: 10%;
        }
        .white-box {
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            color: black;
        }
    </style>
    <section class="data-table">
        <div class="table-container">
            <div class="white-box">
                <h1> This is a website using BERT to classify competitive tf2 matches taken from logs.tf,
                    it was built using HTML,CSS,Python,PHP and javascript
                    Any questions can be directed towards calvinpower44@gmail.com or Kosuke#1102</h1>
            </div>
        </div>
    </section>
</div>
</body>
</body>

    </html>
