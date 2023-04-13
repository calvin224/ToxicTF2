<?php
$wall_paper = "Product.jpg";
?>

<html>
<head>
    <title>ToxicityChecker.tf</title>
    <link rel="stylesheet" href="/CSS/Messages.css">
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
    </style>
</div>
<section class="search-bar">
    <form method="GET" action="">
        <input type="text" name="name" placeholder="Search by Name...">
        <input type="text" name="steamid" placeholder="Search by Steam ID...">
        <input type="text" name="search" placeholder="Search by Message...">
        <button type="submit">Go</button>
    </form>
</section>
<section class="data-table">
    <p>Sort by toxicity level:
        <a href="?order=asc">Ascending</a>
        <a href="?order=desc">Descending</a>
    </p>
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Steam Id</th>
                <th>Message</th>
                <th>Toxicity Level</th>
                <th>threat</th>
                <th>identity hate</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php
            // Connect to database
            $conn = mysqli_connect('localhost', 'root', '', 'toxicity');
            if (!$conn) {
                die('Connection failed: ' . mysqli_connect_error());
            }

            // Set default sort order
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';

            // Set limit and offset
            $limit = 50;
            $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

            // Get messages and their toxicity level
            $name = isset($_GET['name']) ? $_GET['name'] : '';
            $steamid = isset($_GET['steamid']) ? $_GET['steamid'] : '';
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT Name, steamid, commenttext, toxic, identityhate, threat FROM chatlogs ";
            if (!empty($name) || !empty($steamid) || !empty($searchTerm)) {
                $sql .= "WHERE ";
                if (!empty($name)) {
                    $sql .= "Name LIKE '%$name%' AND ";
                }
                if (!empty($steamid)) {
                    $sql .= "steamid LIKE '%$steamid%' AND ";
                }
                if (!empty($searchTerm)) {
                    $sql .= "commenttext LIKE '%$searchTerm%' AND ";
                }
                $sql = rtrim($sql, ' AND ');
            }
            $sql .= " ORDER BY toxic $order LIMIT 500";
            $result = mysqli_query($conn, $sql);
            echo(mysqli_num_rows($result));

            // Calculate total number of rows and pages
            $totalRows = mysqli_num_rows($result);
            $totalPages = ceil($totalRows / $limit);

            // Set current page number
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate offset based on current page number
            $offset = ($currentPage - 1) * $limit;

            // Get messages and their toxicity level for current page
            $sql = "SELECT Name, steamid, commenttext, toxic, identityhate, threat FROM chatlogs ";
            if (!empty($name) || !empty($steamid) || !empty($searchTerm)) {
                $sql .= "WHERE ";
                if (!empty($name)) {
                    $sql .= "Name LIKE '%$name%' AND ";
                }
                if (!empty($steamid)) {
                    $sql .= "steamid LIKE '%$steamid%' AND ";
                }
                if (!empty($searchTerm)) {
                    $sql .= "commenttext LIKE '%$searchTerm%' AND ";
                }
                $sql = rtrim($sql, ' AND ');
            }
            $sql .= " ORDER BY toxic $order LIMIT $limit OFFSET $offset";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["steamid"] . "</td>";
                    echo "<td>" . $row["commenttext"] . "</td>";
                    echo "<td>" . $row["toxic"] . "</td>";
                    echo "<td>" . $row["threat"] . "</td>";
                    echo "<td>" . $row["identityhate"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }

            // Generate page links
            echo "<div class='pagination'>";
            $startPage = max(1, $currentPage - 4);
            $endPage = min($totalPages, $startPage + 9);
            for ($i = $startPage; $i <= $endPage; $i++) {
                $isActive = ($i == $currentPage) ? 'active' : '';
                $url = "?order=$order&page=$i";
                if (!empty($name)) {
                    $url .= "&name=$name";
                }
                if (!empty($steamid)) {
                    $url .= "&steamid=$steamid";
                }
                if (!empty($searchTerm)) {
                    $url .= "&search=$searchTerm";
                }
                echo "<a class='$isActive' href='$url'> $i </a>";
            }
            echo "</div>";

            // Close the database connection
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
</section>
</html>