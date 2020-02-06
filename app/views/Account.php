<!-- account-info -->
<div class="seciotn-outer section-account">
  <div class="section-inner">
    <div class="section-account__userinfo">
      <div class="section-account__userinfo-img">
        <img src="/img/anon.png" alt="anon" />
      </div>
      <div class="section-account__userinfo-data">
        <div class="section-account__userinfo-data-item">
          <?php foreach ($data['userData'] as $key => $info) { ?>
            <div class="data-item-info">
              <p class="name-surname"><?php echo $info['userName'] ?> </p>
            </div>
          <?php } ?>
          <button onclick="changeData()" class="open-form-btn" type="submit" name="open-form">
            <img src="/img/svg/edit-solid.svg" alt="">
          </button>
          <form class="change-data-form" action="/user/changeName" method="POST">
            <input type="text" name="new-name">
            <button onclick="changeData()" class="change-data-btn" type="submit" name="changeName-submit">
              <img src="/img/svg/edit-solid.svg" alt="">
            </button>
          </form>
        </div>
        <div class="section-account__userinfo-data-item">
          <?php foreach ($data['userData'] as $key => $info) { ?>
            <div class="data-item-info">
              <p class="name-age"><?php echo $info['userBrthDate'] ?> </p>
            </div>
          <?php } ?>
          <button onclick="changeData()" class="open-form-btn" type="submit" name="open-form">
            <img src="/img/svg/edit-solid.svg" alt="">
          </button>
          <form class="change-data-form" action="/user/changeDateBirth" method="POST">
            <input type="text" name="new-birthdate">
            <button onclick="changeData()" class="change-data-btn" type="submit" name="changeDateBirth-submit">
              <img src="/img/svg/edit-solid.svg" alt="">
            </button>
          </form>
        </div>
        <div class="section-account__userinfo-data-item">
          <?php foreach ($data['userData'] as $key => $info) { ?>
            <div class="data-item-info">
              <p class="name-description"><?php echo $info['userInfo'] ?> </p>
            </div>
          <?php } ?>
          <button onclick="changeData()" class="open-form-btn" type="submit" name="open-form">
            <img src="/img/svg/edit-solid.svg" alt="">
          </button>
          <form class="change-data-form" action="/user/changeData" method="POST">
            <textarea name="new-userdata" id="" cols="30" rows="4"></textarea>
            <button onclick="changeData()" class="change-data-btn" type="submit" name="changeData-submit">
              <img src="/img/svg/edit-solid.svg" alt="">
            </button>
          </form>
        </div>

      </div>
    </div>
    <div class="section-account__userstatistics">
      <div class="section-account__userstatistics-tabs">
        <button class="section-account__userstatistics-tabs-tablink" id="defaultOpen">
          My domains
        </button>
        <button class="section-account__userstatistics-tabs-tablink">
          My posts
        </button>
        <button class="section-account__userstatistics-tabs-tablink">
          My comments
        </button>
      </div>
      <div class="section-account__userstatistics-tabcontent" id="domains">
        <?php foreach ($data['domains'] as $key => $domain) { ?>
          <div class="tab-item">
            <p><?php echo $domain['domainName'] . '.' . $domain['domainZone'] ?></p>
          </div>
        <?php } ?>
      </div>
      <div class="section-account__userstatistics-tabcontent" id="posts"></div>
      <div class="section-account__userstatistics-tabcontent" id="comments"></div>
    </div>
  </div>
</div>
<!-- account-info -->