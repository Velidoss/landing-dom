<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="/scss/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" />
    <title>Strict</title>
</head>

<body>
    <?php
    // var_dump($_SERVER['REQUEST_URI']);
    // var_dump($_SESSION);
    ?>
    <!-- header -->
    <section class="section-outer section-header">
        <div class="section-inner">
            <div class="section-header__top-logo">
                <a href="/">
                    <img src="/img/Blue Top.png" alt="img-logo" />
                    <h1>Strict</h1>
                </a>
            </div>
            <nav class="section-header__top-nav">
                <ul class="section-header__top-nav-menu">
                    <?php if (isset($_SESSION['userId'])) { ?>
                        <li><a href="/">Home</a></li>
                        <li><a href="/user/domainreg">Register domain name</a></li>
                        <li><a href="/user/account">Account</a></li>
                        <li><a href="/posts/postlist">Posts</a></li>
                        <li><a href="/main/contact">Contact us</a></li>
                        <li>
                            <form action="/user/logout" method="POST">
                                <button class="logout-btn" name="logout-submit" type="submit">
                                    Logout
                                </button>
                            </form>
                        </li>
                    <?php } else {
        ; ?>
                        <li><a href="/">Home</a></li>
                        <li><a href="/user/register">Signup</a></li>
                        <li><a href="/user/login">Login</a></li>
                        <li><a href="/main/contact">Contact us</a></li>
                    <?php
    } ?>
                </ul>
            </nav>
            <div class="section-header__toggler">
                <button class="section-header__toggler-btn" type="submit" onclick="ToggleNav()">
                    <img src="/img/svg/ellipsis-h-solid.svg" alt="menu" />
                </button>
            </div>
        </div>
    </section>
    <!-- header -->
    <!-- toggle-menu -->
    <div class="toggle">
        <ul class="toggle-menu">

            <?php if (isset($_SESSION['userId'])) { ?>
                <li><a href="/">Home</a></li>
                <li><a href="/user/about">Register domain name</a></li>
                <li><a href="/user/account">Account</a></li>
                <li><a href="/posts/postlist">Posts</a></li>
                <li><a href="/main/contact">Contact us</a></li>
                <li>
                    <form action="/user/logout" method="POST">
                        <button class="logout-btn" name="logout-submit" type="submit">
                            Logout
                        </button>
                    </form>
                </li>
            <?php } else {
        ; ?>
                <li><a href="/">Home</a></li>
                <li><a href="/main/contact">Contact us</a></li>
                <li><a href="/user/domainreg">Signup</a></li>
                <li><a href="/user/login">Login</a></li>
            <?php
    } ?>
        </ul>
    </div>
    <!-- toggle-menu -->
    <?php
    include 'app/views/' . $contentView; ?>
    <!-- footer -->
    <section class="section-outer section-footer">
        <div class="section-inner">
            <div class="section-footer__copyright">Copyritht 2014, STRICT</div>
            <div class="section-footer__sm">
                <img src="/img/svg/facebook-square-brands.svg" alt="" />
                <img src="/img/svg/twitter-square-brands.svg" alt="" />
                <img src="/img/svg/google-plus-square-brands.svg" alt="" />
                <img src="/img/svg/linkedin-brands.svg" alt="" />
            </div>
        </div>
    </section>
    <!-- footer -->
</body>
<script src="/js/toggle.js"></script>

</html>