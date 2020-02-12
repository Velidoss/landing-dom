<?php

$selector = $_GET["selector"];
$validator = $_GET["validator"];
if(empty($selector) || empty($validator)){
    echo 'could not validate your request';
}else{
    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
?>
<!--changepwd-->
<section class="section-outer section-forgotpwd">
    <div class="section-inner">
        <div class="section-banner__subtitle">Enter new password</div>
        <div class="section-banner__forgotpwd">
            <form class="section-banner__forgotpwd-form" action="/user/forgotpwd" method="POST">
                <input type="hidden" name="selector" value="<?php echo $selector ;?>">
                <input type="hidden" name="validator" value="<?php echo $validator ;?>">
                <input name="new-pwd" type="password" placeholder="Enter new password">
                <input name="repeat-new-pwd" type="password" placeholder="Repeat password">
                <button name="changepwd-submit" class="btn-main" type="submit">Change password</button>
            </form>
        </div>
    </div>
</section>
<?php }} ?>
<!--changepwd-->