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
    <title>Homepage - Alertify</title>
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

    <div class="toast toast-top toast-end" style="display: none; z-index: 2;" id="alertToast">
  <div class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>You will be notified for the upcoming event</span>
  </div>
</div>
<section class="bg-base-200 p-10" id="event">
    <p class="text-3xl font-bold text-center mb-4">Cricking events</p>
    <?php
    foreach ($userInterests as $interest) {
        $url = $baseUrl . '/' . urlencode($interest) . '/scores'; // Adjust the path as needed

        // Crawl the URL
        $crawler = $client->request('GET', $url);

        // Check if the "scoreCollection" element is present
        if ($crawler->filter('.scoreCollection.cricket')->count() > 0) {
            // Extract each event within the ".scoreCollection.cricket" class
            $events = $crawler->filter('.scoreCollection.cricket .cscore')->slice(0, 3); // Fetch only the first 5 events

            if ($events->count() > 0) {
                // Display each event with Daisy UI card components
                echo '<div class="flex flex-wrap -mx-2">';

                // Iterate through each event
                $events->each(function ($event) use ($interest) {
                    // Check if specific elements exist before extracting
                    $header = $event->filter('.scoreCollection_header')->count() > 0 ? $event->filter('.scoreCollection_header')->html() : '';
                    $dateTime = $event->filter('.cscore_date-time')->count() > 0 ? $event->filter('.cscore_date-time')->html() : '';
                    $infoOverview = $event->filter('.cscore_info-overview')->count() > 0 ? $event->filter('.cscore_info-overview')->html() : '';
                    $competitors = $event->filter('.cscore_competitors')->count() > 0 ? $event->filter('.cscore_competitors')->html() : '';
                    $commentary = $event->filter('.cscore_commentary')->count() > 0 ? $event->filter('.cscore_commentary')->html() : '';

                    // Display each event with Daisy UI card components
                    echo '<div class="w-full md:w-1/3 px-2 mb-4">';
                    echo '<div class="card bg-orange-700 text-white">';
                    echo '<div class="card-body">';
                    echo '<div class="text-xl font-bold mb-2">' . $header . '</div>';
                    echo '<div class="text-sm">' . $infoOverview . '</div><hr>';
                    echo '<div class="text-sm">' . $competitors . '</div><hr>';
                    echo '<div class="text-sm">' . $commentary . '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                });

                echo '</div>';
            } else {
                // No events found
                echo '<div class="w-full md:w-1/3 px-2 mb-4">';
                echo '<div class="card bg-base-100">';
                echo '<div class="card-body">';
                echo '<p>No events found for ' . $interest . ' scores.</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No "scoreCollection" div found
            echo '<div class="w-full md:w-1/3 px-2 mb-4">';
            echo '<div class="card bg-base-100">';
            echo '<div class="card-body">';
            echo '<p>No data found for ' . $interest . ' scores.</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</section>

<section class="bg-base-200 p-10" id="upcoming">
    <p class="text-3xl font-bold mb-4">Upcoming cricket events</p>
    <?php
    $nextTwoDays = date('Ymd', strtotime('+2 days'));

    foreach ($userInterests as $interest) {
        // Construct the URL for upcoming events
        $url = $baseUrl . '/' . urlencode($interest) . '/scores?date=' . $nextTwoDays;

        // Crawl the URL
        $crawler = $client->request('GET', $url);

        // Check if the "scoreCollection" element is present
        if ($crawler->filter('.scoreCollection.cricket')->count() > 0) {
            // Extract each event within the ".scoreCollection.cricket" class
            $events = $crawler->filter('.scoreCollection.cricket .cscore')->slice(0, 6); // Fetch only the first 5 events

            if ($events->count() > 0) {
                // Display each event with Daisy UI card components
                echo '<div class="flex flex-wrap -mx-2">';

                // Iterate through each event
                $counter = 1;
                $events->each(function ($event) use ($interest, &$counter) {
                    // Check if specific elements exist before extracting
                    $header = $event->filter('.scoreCollection_header')->count() > 0 ? $event->filter('.scoreCollection_header')->html() : '';
                    $dateTime = $event->filter('.cscore_date-time')->count() > 0 ? $event->filter('.cscore_date-time')->html() : '';
                    $infoOverview = $event->filter('.cscore_info-overview')->count() > 0 ? $event->filter('.cscore_info-overview')->html() : '';
                    $competitors = $event->filter('.cscore_competitors')->count() > 0 ? $event->filter('.cscore_competitors')->html() : '';
                    $commentary = $event->filter('.cscore_commentary')->count() > 0 ? $event->filter('.cscore_commentary')->html() : '';

                    // Display each event with Daisy UI card components
                    echo '<div class="w-full md:w-1/3 px-2 mb-4">';
                    echo '<div class="card bg-orange-700 text-white">';
                    echo '<div class="card-body">';
                    echo '<div class="text-xl font-bold mb-2">' . $header . '</div>';
                    echo '<div class="text-sm">' . $infoOverview . '</div><hr>';
                    echo '<div class="text-sm">' . $competitors . '</div><hr>';
                    echo '<div class="text-sm">' . $commentary . '</div>';
                    echo '<button class="bg-base-200 text-black font-bold py-2 px-4 rounded mt-4" onclick="showAlert(\'alertCard-' . $counter . '\')"><i class="fa fa-bell"></i> Get Alert</button>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    $counter++;
                });

                echo '</div>';
            } else {
                // No events found
                echo '<div class="w-full md:w-1/3 px-2 mb-4">';
                echo '<div class="card bg-base-100">';
                echo '<div class="card-body">';
                echo '<p>No upcoming events found for ' . $interest . ' scores.</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No "scoreCollection" div found
            echo '<div class="w-full md:w-1/3 px-2 mb-4">';
            echo '<div class="card bg-base-100">';
            echo '<div class="card-body">';
            echo '<p>No data found for ' . $interest . ' scores.</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</section>
<script>
    // Function to show alert and close after 3 seconds
    function showAlert(cardId) {
        // Display the toast
        document.getElementById('alertToast').style.display = 'block';

        // Close the toast after 3 seconds (adjust as needed)
        setTimeout(function () {
            document.getElementById('alertToast').style.display = 'none';
        }, 5000);
    }
</script>
<?php include 'footer.php'; ?>
</body>
</html>