<?php
$loginAlert = isset($_GET['loginAlert']) ? $_GET['loginAlert'] : 'true';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alertify</title>
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
    <style>
        .hero {
            transition: min-height 0.3s ease-in-out; /* Add smooth transition effect */
        }
    </style>
</head>
<body>
<?php
if ($loginAlert === 'false') {

?>
<div id="errorToast" class="toast toast-top toast-end">
  <div class="alert alert-error text-white">
  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>

    <span>Password is Incorrect.</span>
  </div>
</div>
<?php }
?>
<section class="px-20">
    <div class="hero min-h-screen mt-3" id="loginForm">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left" id="loginImageContainer">
                <figure><img src="../images/login.png" alt="" style="width: 30rem; margin-left: 40px;"></figure>
                <p class="py-6 text-center">Securely Login with <span class="logo">Alertify.</span></p>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" action="controller.php" method="post">
                    <!-- Login Form -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text" >Email</span>
                        </label>
                        <input type="email" placeholder="email" name="email" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password"  name="password" placeholder="password" class="input input-bordered" required />
                        <label class="label">
                            <a href="#" class="label-text-alt link link-hover" onclick="toggleForms()">Forgot password?</a>
                        </label>
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary text-primary hover:text-white"  type="submit" name="login">Login</button>
                    </div>
                    <p class="text-center">New here? <a href="#" class="text-primary" onclick="toggleForms()">Register.</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="hero min-h-screen" style="display: none;" id="registerForm">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left" id="registerImageContainer">
                <figure><img src="../images/login.png" alt="" style="width: 30rem; margin-left: 40px;"></figure>
                <p class="py-6 text-center">Securely Register with <span class="logo">Alertify.</span></p>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body"  action="controller.php" method="post">
                    <!-- Registration Form -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="name" name="name" placeholder="Name" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Phone number</span>
                        </label>
                        <input type="number" name="number" placeholder="Phone Number" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" placeholder="email" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary text-primary hover:text-white" type="submit" name="register">Register</button>
                    </div>
                    <p class="text-center">Already a User <a href="#" class="text-primary" onclick="toggleForms()">Login.</a></p>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    function toggleForms() {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const loginImageContainer = document.getElementById('loginImageContainer');
        const registerImageContainer = document.getElementById('registerImageContainer');

        if (loginForm.style.display === 'none') {
            loginForm.style.display = 'block';
            loginImageContainer.style.display = 'block';
            registerForm.style.display = 'none';
            registerImageContainer.style.display = 'none';
        } else {
            loginForm.style.display = 'none';
            loginImageContainer.style.display = 'none';

            registerForm.style.display = 'block';
            registerImageContainer.style.display = 'block';
            heroContainer.style.minHeight = registerForm.offsetHeight + 'px';
        }
    }
</script>

<script>
setTimeout(function(){
    var errorToast = document.getElementById('errorToast');
    if (errorToast) {
        errorToast.style.display = 'none';
    }
}, 2000);
</script>


</body>
</html>