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
            <script>
                // Get the search term from the URL
                const searchParams = new URLSearchParams(window.location.search);
                const searchTerm = searchParams.get('search');

                // Set default sort order
                let order = searchParams.get('order') || 'asc';

                // Set limit and offset
                const limit = 200;
                let offset = 0;

                // Construct the URL for loading more results
                const url = `data.php?order=${order}&offset=${offset}&search=${searchTerm}`;

                // Fetch the data from the data.php file
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        // Create a new temporary div to store the response HTML
                        const tempDiv = document.createElement("div");
                        tempDiv.innerHTML = html;
                        // Get the rows from the temporary div
                        const rows = tempDiv.querySelectorAll("#table-body tr");
                        // Get the table body element
                        const tableBody = document.getElementById("table-body");
                        // Add the rows to the table body
                        for (let i = 0; i < rows.length; i++) {
                            tableBody.appendChild(rows[i]);
                        }
                        // Add the "Load More" button if necessary
                        if (rows.length >= limit) {
                            tableBody.parentNode.appendChild(document.createElement("button"))
                                .setAttribute("id", "load-more-btn");
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
            </tbody>
        </table>
        <button id="load-more-btn">Load More</button>
    </section>
</main>
</body>
</html>