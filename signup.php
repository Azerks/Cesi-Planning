<?php

include("./components/db.php");

if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])
    && isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["password"]) && !empty($_POST["password"])) {

    $sql = "SELECT * FROM accounts WHERE email = " . $db->quote($_POST["email"]);
    $req = $db->prepare($sql);
    $req->execute();
    $userExist = $req->fetch();

    if ($userExist) {
        header('Location: signup.php');
        die();
    }

    $sql = "INSERT INTO accounts (pseudo, email, password) VALUES(?, ?, ?)";
    $req = $db->prepare($sql);
    $req->bindValue(1, $_POST["pseudo"]);
    $req->bindValue(2, $_POST["email"]);
    $req->bindValue(3, $_POST["password"]);
    if ($req->execute()) {
        header('Location: signin.php');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <!-- Favicon -->
    <link rel="icon" href="./assets/img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/vendor/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="./assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="./assets/css/argon.css?v=1.2.0" type="text/css">
    <title>Register</title>
</head>
<body class="bg-default g-sidenav-show g-sidenav-pinned">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="dashboard.html">
                            <img src="../assets/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="dashboard.html" class="nav-link">
                        <span class="nav-link-inner--text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="signin.php" class="nav-link">
                        <span class="nav-link-inner--text">Login</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="signup.php" class="nav-link">
                        <span class="nav-link-inner--text">Register</span>
                    </a>
                </li>
            </ul>
            <hr class="d-lg-none">
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank"
                       data-toggle="tooltip" data-original-title="Like us on Facebook">
                        <i class="fab fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Facebook</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial"
                       target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
                        <i class="fab fa-instagram"></i>
                        <span class="nav-link-inner--text d-lg-none">Instagram</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank"
                       data-toggle="tooltip" data-original-title="Follow us on Twitter">
                        <i class="fab fa-twitter-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Twitter</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial" target="_blank"
                       data-toggle="tooltip" data-original-title="Star us on Github">
                        <i class="fab fa-github"></i>
                        <span class="nav-link-inner--text d-lg-none">Github</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">Create an account</h1>
                        <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                            project for free.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                 xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Sign up with credentials</small>
                        </div>
                        <form role="form" abineguid="F59B648BA4164045A4E5FE994D921E4B" method="post" action="signup.php">
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Name" type="text" name="pseudo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email" name="email">
                                    <div id="pwm-inline-icon-12932" class="pwm-field-icon"
                                         style="position: absolute !important; width: 18px !important; height: 18px !important; min-height: 0px !important; min-width: 0px !important; z-index: 2147483645 !important; box-shadow: none !important; box-sizing: content-box !important; background: none !important; border: none !important; padding: 0px !important; cursor: pointer !important; outline: none !important; margin-top: 14px; margin-left: 423px;">
                                        <svg style="display: inline-block !important; width: 16px !important; height: 16px !important; fill: rgb(230, 0, 23) !important; margin-top: 0.5px !important; position: absolute !important; top: 0px !important; left: 0px !important;"
                                             viewBox="0 0 40 64">
                                            <g>
                                                <path d="m20,28.12a33.78,33.78 0 0 1 13.36,2.74a22.18,22.18 0 0 1 0.64,5.32c0,9.43 -5.66,17.81 -14,20.94c-8.34,-3.13 -14,-11.51 -14,-20.94a22.2,22.2 0 0 1 0.64,-5.32a33.78,33.78 0 0 1 13.36,-2.74m0,-28.12c-8.82,0 -14,7.36 -14,16.41l0,5.16c2,-1.2 2,-1.49 5,-2.08l0,-3.08c0,-6.21 2.9,-11.41 8.81,-11.41l0.19,0c6.6,0 9,4.77 9,11.41l0,3.08c3,0.58 3,0.88 5,2.08l0,-5.16c0,-9 -5.18,-16.41 -14,-16.41l0,0zm0,22c-6.39,0 -12.77,0.67 -18.47,4a31.6,31.6 0 0 0 -1.53,9.74c0,13.64 8.52,25 20,28.26c11.48,-3.27 20,-14.63 20,-28.26a31.66,31.66 0 0 0 -1.54,-9.77c-5.69,-3.3 -12.08,-4 -18.47,-4l0,0l0.01,0.03z"></path>
                                                <path d="m21.23,39.5a2.81,2.81 0 0 0 1.77,-2.59a2.94,2.94 0 0 0 -3,-2.93a3,3 0 0 0 -3,3a2.66,2.66 0 0 0 1.77,2.48l-1.77,4.54l6,0l-1.77,-4.5z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password" type="password" name="password">
                                    <div id="pwm-inline-icon-74430" class="pwm-field-icon"
                                         style="position: absolute !important; width: 18px !important; height: 18px !important; min-height: 0px !important; min-width: 0px !important; z-index: 2147483645 !important; box-shadow: none !important; box-sizing: content-box !important; background: none !important; border: none !important; padding: 0px !important; cursor: pointer !important; outline: none !important; margin-top: 14px; margin-left: 423px;">
                                        <svg style="display: inline-block !important; width: 16px !important; height: 16px !important; fill: rgb(230, 0, 23) !important; margin-top: 0.5px !important;"
                                             viewBox="0 0 20 20">
                                            <g>
                                                <path d="M14.9127559,5.43359723 C13.9827216,4.58951985 12.8308672,4.0225262 11.5692789,3.80232854 C7.92872888,3.16142854 4.44202888,5.60772854 3.80367888,9.25082854 C3.49342888,11.0154285 3.89037888,12.7953285 4.91887888,14.2624285 C5.94822888,15.7286785 7.48757888,16.7078785 9.25217888,17.0164285 C11.1238789,17.3453785 13.0576289,16.8591785 14.5561789,15.6836285 C14.9259289,15.3920785 15.4605789,15.4575285 15.7487289,15.8272785 C16.0394289,16.1970285 15.9748289,16.7308285 15.6059289,17.0206785 C14.1141789,18.1919785 12.2764789,18.8167285 10.4056289,18.8167285 C9.92367888,18.8167285 9.44002888,18.7750785 8.95807888,18.6917785 C6.74637888,18.3033285 4.81772888,17.0776285 3.52742888,15.2382285 C2.23797888,13.4005285 1.74072888,11.1692785 2.12832888,8.95672854 C2.92902888,4.38967854 7.29292888,1.32712854 11.8633789,2.12697854 C13.4205324,2.40009833 14.8442726,3.09412153 16.0007123,4.12545035 L16.7423789,3.23367854 C16.9905789,2.93532854 17.4691289,3.01777854 17.6034289,3.38242854 L18.9506789,7.03657854 C19.0849789,7.40122854 18.7747289,7.77352854 18.3922289,7.70807854 L14.5536289,7.04762854 C14.1711289,6.98217854 14.0036789,6.52657854 14.2518789,6.22822854 L14.9127559,5.43359723 Z M8.04092888,10.3711285 C8.04092888,11.0570785 7.48502888,11.6121285 6.79992888,11.6121285 C6.11482888,11.6121285 5.55892888,11.0570785 5.55892888,10.3711285 C5.55892888,9.68602854 6.11482888,9.13012854 6.79992888,9.13012854 C7.48502888,9.13012854 8.04092888,9.68602854 8.04092888,10.3711285 Z M11.9713289,10.3711285 C11.9713289,11.0570785 11.4154289,11.6121285 10.7303289,11.6121285 C10.0443789,11.6121285 9.48932888,11.0570785 9.48932888,10.3711285 C9.48932888,9.68602854 10.0443789,9.13012854 10.7303289,9.13012854 C11.4154289,9.13012854 11.9713289,9.68602854 11.9713289,10.3711285 Z M16.1601289,10.3711285 C16.1601289,11.0570785 15.6042289,11.6121285 14.9191289,11.6121285 C14.2331789,11.6121285 13.6781289,11.0570785 13.6781289,10.3711285 C13.6781289,9.68602854 14.2331789,9.13012854 14.9191289,9.13012854 C15.6042289,9.13012854 16.1601289,9.68602854 16.1601289,10.3711285 Z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="text-muted font-italic"><small>password strength: <span
                                            class="text-success font-weight-700">strong</span></small></div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">I agree with the <a
                                                        href="#!">Privacy Policy</a></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Create account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    © 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative
                        Tim</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md"
                           class="nav-link" target="_blank">MIT License</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.min.js?v=1.2.0"></script>
<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>


</body>
</html>
