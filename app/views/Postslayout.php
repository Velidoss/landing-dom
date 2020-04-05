<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php $cssVersion = "3.4.2"; ?>
    <link rel="stylesheet" href="/scss/style.css?v=<?php echo $cssVersion; ?>" />
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" />
    <title>Strict</title>
</head>

<body>
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
                        <li><a href="/posts/postlist/1">Posts</a></li>
                        <li><a href="/main/contact">Contact us</a></li>
                        <li>
                            <form action="/user/logout" method="POST">
                                <button class="logout-btn" name="logout-submit" type="submit">
                                    Logout
                                </button>
                            </form>
                        </li>
                    <?php } else {; ?>
                        <li><a href="/">Home</a></li>
                        <li><a href="/main/contact">Contact us</a></li>
                        <li><a href="/user/register">Signup</a></li>
                        <li><a href="/user/login">Login</a></li>
                    <?php } ?>
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
                <li><a href="/user/domainreg">Register domain name</a></li>
                <li><a href="/user/account">Account</a></li>
                <li><a href="/posts/postlist/1">Posts</a></li>
                <li><a href="/main/contact">Contact us</a></li>
                <li>
                    <form action="/user/logout" method="POST">
                        <button class="logout-btn" name="logout-submit" type="submit">
                            Logout
                        </button>
                    </form>
                </li>
            <?php } else {; ?>
                <li><a href="/">Home</a></li>
                <li><a href="/main/contact">Contact us</a></li>
                <li><a href="/user/register">Signup</a></li>
                <li><a href="/user/login">Login</a></li>
            <?php } ?>
        </ul>
    </div>
    <!-- posts-menu -->
    <section class="section-outer section-postmenu">
        <div class="section-inner">
            <div class="section-postmenu__nav">
                <ul class="section-postmenu__nav-functions">
                    <li class="section-postmenu__nav-functions-item"><a href="/posts/makepost">Make a post</a></li>
                    <li class="section-postmenu__nav-functions-item"><a href="/posts/postlist/1">Postlist</a></li>
                    <li class="section-postmenu__nav-functions-item"><a href="/posts/searchpost">Search a post</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- posts-menu -->
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
<script src="/js/editinfo.js"></script>

</html>