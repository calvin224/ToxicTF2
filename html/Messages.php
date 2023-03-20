<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Game Toxicity Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap">
    <link rel="stylesheet" href="/CSS/Messages.css">
</head>
<body>
<header>
    <h1>Video Game Toxicity Data</h1>
</header>
<main>
    <section class="overview">
        <h2>Overview</h2>
        <p>On this page, you will find data collected from video game messages that have been analyzed to determine the level of toxicity in the messages.</p>
    </section>
    <section class="search-bar">
        <form method="GET">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Go</button>
        </form>
    </section>
    <section class="data-table">
        <p>Sort by toxicity level:
            <a href="?order=asc">Ascending</a>
            <a href="?order=desc">Descending</a>
        </p>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Message</th>
                <th>Toxicity Level</th>
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
            $limit = 200;
            $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

            // Get messages and their toxicity level
            $sql = "SELECT Name, commenttext, toxic FROM messagestable ORDER BY toxic $order LIMIT $limit OFFSET $offset";
            $result = mysqli_query($conn, $sql);
            // Set default values
            $searchTerm = '';
            $whereClause = '';

            // Check if a search term was submitted
            if (isset($_GET['search'])) {
                // Sanitize the search term to prevent SQL injection
                $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
                // Add the search term to the WHERE clause
                $whereClause = "WHERE Name LIKE '%$searchTerm%' OR commenttext LIKE '%$searchTerm%'";
            }

            // Set default sort order
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';

            // Set limit and offset
            $limit = 200;
            $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

            // Get messages and their toxicity level
            $sql = "SELECT Name, commenttext, toxic FROM messagestable $whereClause ORDER BY toxic $order LIMIT $limit OFFSET $offset";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["commenttext"] . "</td>";
                    echo "<td>" . $row["toxic"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
        <?php if (mysqli_num_rows($result) >= $limit): ?>
            <button id="load-more-btn">Load More</button>
        <?php endif; ?>
        <script>
            // Get the search term from the URL
            const searchParams = new URLSearchParams(window.location.search);
            const searchTerm = searchParams.get('search');

            // Construct the URL for loading more results
            const url = window.location.href.split("?")[0] + `?order=<?php echo $order ?>&offset=${offset}&search=${searchTerm}`;
            // Add event listener to the "Load More" button
            const loadMoreBtn = document.getElementById("load-more-btn");
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener("click", () => {
                    const tableBody = document.getElementById("table-body");
                    const offset = tableBody.getElementsByTagName("tr").length - 1;
                    const url = window.location.href.split("?")[0] + `?order=<?php echo $order ?>&offset=${offset}`;
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            // Create a new temporary div to store the response HTML
                            const tempDiv = document.createElement("div");
                            tempDiv.innerHTML = html;
                            // Get the new rows from the temporary div
                            const newRows = tempDiv.querySelectorAll("#table-body tr");
                            // Remove the old "Load More" button
                            loadMoreBtn.parentNode.removeChild(loadMoreBtn);
                            // Append the new rows to the table
                            for (let i = 0; i < newRows.length; i++) {
                                tableBody.appendChild(newRows[i]);
                            }
                            // Add a new "Load More" button if there are more results
                            const newLoadMoreBtn = tempDiv.querySelector("#load-more-btn");
                            if (newLoadMoreBtn) {
                                tableBody.parentNode.insertBefore(newLoadMoreBtn, tableBody.nextSibling);
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            }
        </script>
    </section>