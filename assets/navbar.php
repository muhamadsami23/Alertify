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
    <header?>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
          <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a>Home</a></li>
            <li><a>About Us</a></li>
        <li>
              <details>
                <summary>Categories</summary>
                <ul class="p-2">
                  <li><a>Sports</a></li>
                  <li><a>Events</a></li>
                  <li><a>Meetups</a></li>

                </ul>
              </details>
            </li>
            <li><a>Events</a></li>
            <li><a>Contact</a></li>  
          </ul>
          </div>
          <a class="btn btn-ghost text-3xl logo" hre="../index.html">Alertify</a>
        </div>
        <div class="navbar-center hidden lg:flex">
          <ul class="menu menu-horizontal px-1">
            <li><a href="home.php">Home</a></li>
            <li><a href="news.php">News</a></li>
        <li>
              <details>
                <summary>Categories</summary>
                <ul class="p-2">
                  <li><a href="#">Events</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Meetups</a></li>

                </ul>
              </details>
            </li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Contact</a></li>  
          </ul>
        </div>
        <div class="navbar-end">
        <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
            <i class="fa fa-user text-2xl"></i>
        </div>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li>
          <a class="justify-between">
            Profile
          </a>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>        </div>
      </div>
</header>
</body>
</html>