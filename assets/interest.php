<?php
session_start();
if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
} else {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconfig.php'; // Adjust the path as needed

    $interests = json_decode($_POST['interests'], true);

    if (!empty($interests['sub_categories'])) {
        foreach ($interests['sub_categories'] as $subCategory) {
            $mainCategory = $subCategory['main_category'];
            $subCategoryValue = $subCategory['sub_category'];
            $sqlSub = "INSERT INTO interest (email, interest, sub_interest) VALUES ('$userEmail', '$mainCategory', '$subCategoryValue')";
            $conn->query($sqlSub);
        }
    }
header("Location: home.php");
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertify - Select your interests</title>
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
<h2 class="text-3xl font-bold text-center mt-10">Select Your Interest from the given Categories..</h2>
<section class="flex flex-col justify-center items-center h-screen flex-wrap">
    <div class="main-category" id="main-category" style="display: block;">
    <!-- First row of cards -->
    <div class="flex justify-center mb-8">
        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; margin-right: 20px; cursor: pointer" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Sports</h2>
                <p>Select your favorite sports category and stay updated with the latest news, scores, and events.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>

        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; cursor: pointer" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Event</h2>
                <p>Explore and choose your preferred events. Receive timely alerts for upcoming events in your area.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>
    </div>

    <!-- Second row of cards -->
    <div class="flex justify-center mb-8">
        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; margin-right: 20px; cursor: pointer" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Concert</h2>
                <p>Discover upcoming concerts and music events. Get notified about your favorite artists and bands.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>

        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; cursor: pointer;" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Conferences</h2>
                <p>Stay informed about relevant conferences and seminars. Receive alerts for educational and professional events.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>
    </div>
    </div>

<!-- more categories after selection -->
<div class="more" id="more" style="display: none;">
    <!-- First row of cards -->
    <div class="flex justify-center mb-8">
        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; margin-right: 20px; cursor: pointer" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Cricket</h2>
                <p>Stay updated with the latest news, scores, and events in the world of cricket.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>

        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; cursor: pointer" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Hockey</h2>
                <p>Get the latest updates and scores from the world of hockey.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>
    </div>

    <!-- Second row of cards -->
    <div class="flex justify-center mb-8">
        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; margin-right: 20px; cursor: pointer" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Football</h2>
                <p>Stay updated with the latest football news, scores, and events from around the world.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>

        <div class="card w-80 bg-base-200 text-black hover:bg-primary hover:text-white shadow-xl" style="height: 30vh; cursor: pointer;" onclick="selectCard(this)">
            <div class="card-body">
                <h2 class="card-title">Tennis</h2>
                <p>Discover the latest updates and scores from the world of tennis.</p>
                <div class="card-actions justify-end">
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Button -->
    <div class="btn btn-primary p-4" onclick="nextAction()" id="nextBtn" style="display: block;">Next</div>
    <a href="home.php"><div id="submitBtn" class="btn btn-success p-4" style="display: none;" onclick="submitAction()">Submit</div></a>

</section>

<script>
  var selectedInterests = { main_categories: [], sub_categories: [] };

function selectCard(selectedCard) {
    document.querySelectorAll('.card').forEach(card => {
        card.classList.remove('bg-primary', 'text-white');
    });
    selectedCard.classList.add('bg-primary', 'text-white');
    var mainCategory = selectedCard.querySelector('.card-title').innerText;
    if (document.getElementById('more').style.display === 'none') {
        // Main category
        selectedInterests.main_categories = [mainCategory];
    } else {
        var subCategory = selectedCard.querySelector('p').innerText;
        selectedInterests.sub_categories.push({ main_category: mainCategory, sub_category: subCategory });
    }
}

function nextAction() {
    const main = document.getElementById('main-category');
    const more = document.getElementById('more');
    const submitBtn = document.getElementById('submitBtn');
    const nextBtn = document.getElementById('nextBtn');


    if (more.style.display == 'none') {
        main.style.display = 'none';
        more.style.display = 'block';

        // Show the submit button
        submitBtn.style.display = 'block';
        nextBtn.style.display = 'none';
    }
}

function submitAction() {
    // Using fetch for simplicity
    fetch('', {  // Add the correct path to your PHP script
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'interests=' + encodeURIComponent(JSON.stringify(selectedInterests)),
    })
    .then(response => response.text())
    .then(data => {
        // Handle the response from the PHP script
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


</script>
</body>
</html>
