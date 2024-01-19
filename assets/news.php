<?php
// Include your database configuration file
include 'dbconfig.php';

// Include Goutte
require_once '../vendor/autoload.php';

// Fetch user interests from the database
session_start();
if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];

    // Adjust the query based on your database structure
    $sql = "SELECT DISTINCT interest FROM interest WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Array to store user interests
        $userInterests = [];

        while ($row = $result->fetch_assoc()) {
            $userInterests[] = $row['interest'];
        }

        // Now, let's crawl ESPN for each interest
        $client = new Goutte\Client();

        // URL for ESPN
        $baseUrl = 'http://www.espn.in';

        // Iterate through user interests
        foreach ($userInterests as $interest) {
            // Construct the URL for the specific interest
            $url = $baseUrl . '/' . urlencode($interest);

            // Crawl the URL
            $crawler = $client->request('GET', $url);

            // Check if the "main-container" element is present
            if ($crawler->filter('#main-container')->count() > 0) {
                // Extract HTML data from the "main-container" id
                $mainContainerHtml = $crawler->filter('#main-container')->html();
                // // Display the HTML data
                // echo '<h2>' . $interest . '</h2>';
                // echo '<div>';
                // echo $mainContainerHtml;
                // echo '</div>';
            } else {
                echo '<p>No data found for ' . $interest . '</p>';
            }
        }
    } else {
        echo "No interests found for the user.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - Alertify</title>
    <link href="../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Josefin+Sans:wght@500&family=Kdam+Thmor+Pro&family=Roboto+Serif:opsz@8..144&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-wt4B6BDx9VX+prONmvf+zJNcRkUJSMrYc+MKYOqFl9SsLofbNflXrVS+fdePFEu9ceA01ZkZl9m+chUStcYrxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'navbar.php' ?>

    <section id="news" class="bg-base-200 p-10">
    <p class="text-3xl font-bold text-center mb-4">Cricket News</p>
    <?php
    foreach ($userInterests as $interest) {
        $url = $baseUrl . '/' . urlencode($interest) . '/cricket'; // Adjust the path as needed

        // Crawl the URL
        $crawler = $client->request('GET', $url);

        // Check if the "contentItem" element is present
        if ($crawler->filter('.contentItem')->count() > 0) {
            // Extract all news within the ".contentItem" class
            $newsItems = $crawler->filter('.contentItem');

            if ($newsItems->count() > 0) {
                // Display each news item with Daisy UI card components
                echo '<div class="flex flex-wrap -mx-2">';

                // Iterate through each news item
                $newsItems->each(function ($newsItem) use ($interest) {
                    // Check if specific elements exist before extracting
                    $title = $newsItem->filter('.contentItem__titleWrapper')->count() > 0 ? $newsItem->filter('.contentItem__titleWrapper')->text() : '';
                    $link = $newsItem->filter('.contentItem__titleWrapper a')->count() > 0 ? $newsItem->filter('.contentItem__titleWrapper a')->attr('href') : '';

                    // Display each news item with Daisy UI card components
                    echo '<div class="w-full md:w-1/3 px-2 mb-4">';
                    echo '<div class="card bg-orange-700 text-white">';
                    echo '<div class="card-body">';
                    echo '<a href="' . $link . '" target="_blank" class="text-xl font-bold mb-2">' . $title . '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                });

                echo '</div>';
            } else {
                // No news items found
                echo '<div class="w-full md:w-1/3 px-2 mb-4">';
                echo '<div class="card bg-base-100">';
                echo '<div class="card-body">';
                echo '<p>No news found for ' . $interest . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No "contentItem" div found
            echo '<div class="w-full md:w-1/3 px-2 mb-4">';
            echo '<div class="card bg-base-100">';
            echo '<div class="card-body">';
            echo '<p>No data found for ' . $interest . ' news.</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</section>



<?php include 'footer.php'; ?>
</body>
</html>