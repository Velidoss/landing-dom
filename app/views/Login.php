    <!--login-->
    <section class="section-outer section-login">
        <div class="section-inner">
            <div class="section-banner__subtitle">Log in</div>
            <div class="section-banner__login">
                <form class="section-banner__login-form" action="/user/loginUser" method="POST">
                    <input name="username" type="text" placeholder="Enter nickname">
                    <input name="pwd" type="password" placeholder="Enter password">
                    <a href="/user/forgotpwd">Forgot your password?</a>
                    <button name="login-submit" class="btn-main" type="submit">Log in</button>
                </form>
                <div class="section-banner__login-redirect">
                    <a href="/user/register">Dont have an account? Sign in!</a>
                </div>
            </div>
        </div>
    </section>
    <!--login-->