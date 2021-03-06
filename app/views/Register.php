    <!--registration-->
    <section class="section-outer section-register">
        <div class="section-inner">
            <div class="section-banner__subtitle">Register</div>
            <div class="section-banner__register">
                <form class="section-banner__register-form" action="/user/registerUser" method="POST">
                    <input name="username" type="text" placeholder="Enter nickname">
                    <input name="email" type="email" placeholder="Enter email">
                    <input name="pwd" type="password" placeholder="Enter password">
                    <input name="pwd-repeat" type="password" placeholder="Repeat password">
                    <button name="register-submit" class="btn-main" type="submit">Register</button>
                </form>
                <div class="section-banner__register-redirect">
                    <a href="/user/login">Already have an account? Log in!</a>
                </div>
            </div>
        </div>
    </section>
    <!--registration-->