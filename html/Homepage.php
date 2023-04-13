<?php
$wall_paper = "Product.jpg";

?>
<!DOCTYPE html>
<html>
<head>
    <title>ToxicityChecker.tf</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/CSS/Homepage.css" />
</head>
<body>

<div class="top-bar">
    <a href="Messages.php">Chat logs</a>
    <a href="about.php">About</a>
</div>
<style>
    body {
        background-image: url('<?php echo $wall_paper;?>');
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<div class="banner">
    <div class="text">
        <h1>Toxicity classification of competitive tf2 matches </h1>
        <p>powered by BERT</p>
    </div>
    <div class="scroll-down" onclick="scrollDown()">
        <i></i>
    </div>
</div>
<div class="image-container">
    <a href="https://etf2l.org/">
        <img src="2018_etf2l_long_nobackground.png" alt="Description of the first image" />
    </a>
    <a href="https://www.teamfortress.com/">
        <img src="team-fortress-2-logo (1).png" alt="Description of the second image" />
    </a>
    <a href="https://ai.googleblog.com/2018/11/open-sourcing-bert-state-of-art-pre.html">
        <img src="output-onlinejpgtools (1).png" alt="Description of the third image" />
    </a>
</div>
<script>
    function scrollDown() {
        window.scroll({
            top: document.body.offsetHeight,
            behavior: "smooth"
        });
    }
</script>
</body>
</html>