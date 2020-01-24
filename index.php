<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="scss/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" />
    <title>Strict</title>
</head>

<body>
    <!-- header -->
    <section class="section-outer section-header">
        <div class="section-inner">
            <div class="section-header__top-logo">
                <img src="./img/Blue Top.png" alt="img-logo" />Strict </div>
            <nav class="section-header__top-nav">
                <ul class="section-header__top-nav-menu">
                    <li><a href="#">Signup</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </nav>
            <div class="section-header__toggler">
                <button class="section-header__toggler-btn" type="submit" onclick="ToggleNav()">
                    <img src="img/svg/ellipsis-h-solid.svg" alt="menu" />
                </button>
            </div>
        </div>
    </section>
    <!-- header -->
    <!-- toggle-menu -->
    <div class="toggle">
        <ul class="toggle-menu">
            <li><a href="#">Signup</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </div>
    <!-- toggle-menu -->
    <!--banner-->
    <section class="section-outer section-banner">
        <div class="section-inner">
            <div class="section-banner__title">Strict</div>
            <div class="section-banner__text"> STRICT is a responsive theme with a a clean and minimal look. </div>
            <div class="section-banner__btn">
                <button class="btn-main" type="submit">Call to action</button>
            </div>
        </div>
    </section>
    <!--banner-->
    <!--registration-->
    <section class="section-outer section-banner">
        <div class="section-inner">
            <div class="section-banner__subtitle">Register</div>
            <div class="section-banner__register">
                <form class="section-banner__register-form" action="" method="POST">
                    <input name="username" type="text" placeholder="Enter nickname">
                    <input name="email" type="email"  placeholder="Enter email">
                    <input name="pwd" type="password"  placeholder="Enter password">
                    <input name="pwd-repeat" type="password"  placeholder="Repeat password">
                    <button name="register-submit" class="btn-main" type="submit">Register</button>
                </form>
                
            </div>
        </div>
    </section>
    <!--registration-->
    <!-- description -->
    <section class="section-outer section-description">
        <div class="section-inner">
            <div class="section-description__title">Simple & pure design.</div>
            <div class="section-description__text"> Designers everywhere gush with admiration upon seeing a web design
                and exclaim "its beautiful, it's so clean!". There are a countless number of webdesign round-ups
                dedicated to 'clean' design and it is a term thrown around quite a bit in the web design community. It
                can be easy to spot a good example of clean design. </div>
        </div>
    </section>
    <!-- description -->
    <!-- features -->
    <section class="section-outer section-features">
        <div class="section-inner">
            <div class="section-features__list">
                <div class="section-features__list-item">
                    <div class="section-features__list-item-img">
                        <img src="./img/Icon.png" alt="" />
                    </div>
                    <div class="section-features__list-item-title"> Optimized for all devices </div>
                    <div class="section-features__list-item-text"> STRICT has been designed to be fully responsive on
                        all devices </div>
                </div>
                <div class="section-features__list-item">
                    <div class="section-features__list-item-img">
                        <img src="./img/Icon-1.png" alt="" />
                    </div>
                    <div class="section-features__list-item-title"> Clean & Minimal Design </div>
                    <div class="section-features__list-item-text"> This multipurpose theme is especially created to be
                        used for different projects. </div>
                </div>
                <div class="section-features__list-item">
                    <div class="section-features__list-item-img">
                        <img src="./img/Icon-2.png" alt="" />
                    </div>
                    <div class="section-features__list-item-title"> Font Awesome Icon </div>
                    <div class="section-features__list-item-text"> This multipurpose theme is especially created to be
                        used for different projects. </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features -->
    <!-- portfolio -->
    <section class="section-outer section-portfolio">
        <div class="section-inner">
            <div class="section-portfolio__title"> Showcase your work like a pro. </div>
            <div class="section-portfolio__text"> Contact me if you like my work </div>
            <div class="section-portfolio__gallery">
                <div class="section-portfolio__gallery-img">
                    <img src="./img/Layer1.png" alt="" />
                </div>
                <div class="section-portfolio__gallery-img">
                    <img src="./img/Layer2.png" alt="" />
                </div>
                <div class="section-portfolio__gallery-img">
                    <img src="./img/Layer3.png" alt="" />
                </div>
                <div class="section-portfolio__gallery-img">
                    <img src="./img/Layer4.png" alt="" />
                </div>
                <div class="section-portfolio__gallery-img">
                    <img src="./img/Layer5.png" alt="" />
                </div>
                <div class="section-portfolio__gallery-img">
                    <img src="./img/Layer6.png" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio -->
    <!-- contact -->
    <section class="section-outer section-contact">
        <div class="section-inner">
            <div class="section-contact__title">Stay with us</div>
            <div class="section-contact__text">We ensure quailty & support</div>
            <div class="section-contact__contact">
                <form action="" class="section-contact__contact-form">
                    <input class="section-contact__contact-form-input" type="text" placeholder="Full Name" />
                    <input class="section-contact__contact-form-input" type="email" placeholder="Email Adress" />
                    <textarea class="section-contact__contact-form-textarea" rows="8" placeholder="Message"></textarea>
                    <div class="section-contact__contact-form-buttons">
                        <label for="checkbox" class="checkbox"><input id="checkbox" type="checkbox" />
                            <span>Subscribe for newsletter</span>
                        </label>
                        <button type="submit" class="btn-main">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- contact -->
    <!-- footer -->
    <section class="section-outer section-footer">
        <div class="section-inner">
            <div class="section-footer__copyright">Copyritht 2014, STRICT</div>
            <div class="section-footer__sm">
                <img src="img/svg/facebook-square-brands.svg" alt="" />
                <img src="img/svg/twitter-square-brands.svg" alt="" />
                <img src="img/svg/google-plus-square-brands.svg" alt="" />
                <img src="img/svg/linkedin-brands.svg" alt="" />
            </div>
        </div>
    </section>
    <!-- footer -->
</body>
<script src="js/toggle.js"></script>

</html>