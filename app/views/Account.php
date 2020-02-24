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
            <div class="item-info">
                <form class="item-info__form" action="/user/changeName" method="POST">
                    <input name="new-name" class="item-info__form-data" type="text" value="<?php echo $info['userName'] ?>">
                    <button class="item-info__form-btn" type="submit" name="changeName-submit">
                        <img src="/img/svg/edit-solid.svg" alt="">
                    </button>
                </form>
            </div>
          <?php } ?>
        </div>
          <div class="section-account__userinfo-data-item">
              <?php foreach ($data['userData'] as $key => $info) { ?>
                  <div class="item-info">
                      <form class="item-info__form" action="/user/changeDateBirth" method="POST">
                          <input name="new-birthdate" class="item-info__form-data" type="text" value="<?php echo $info['userBrthDate'] ?>">
                          <button class="item-info__form-btn" type="submit" name="changeDateBirth-submit">
                              <img src="/img/svg/edit-solid.svg" alt="">
                          </button>
                      </form>
                  </div>
              <?php } ?>
          </div>
          <div class="section-account__userinfo-data-item">
              <?php foreach ($data['userData'] as $key => $info) { ?>
                  <div class="item-info">
                      <form class="item-info__form" action="/user/changeData" method="POST">
                          <input name="new-userdata" class="item-info__form-data" type="text" value="<?php echo $info['userInfo'] ?>">
                          <button class="item-info__form-btn" type="submit" name="changeData-submit">
                              <img src="/img/svg/edit-solid.svg" alt="">
                          </button>
                      </form>
                  </div>
              <?php } ?>
          </div>
      </div>
    </div>
    <div class="section-account__userstatistics">
      <div class="section-account__userstatistics-tabs">
        <button onclick="openUserStat('domains')" class="section-account__userstatistics-tabs-tablink" id="defaultOpen">
          My domains
        </button>
        <button onclick="openUserStat('posts')" class="section-account__userstatistics-tabs-tablink">
          My posts
        </button>
        <button onclick="openUserStat('comments')" class="section-account__userstatistics-tabs-tablink">
          My comments
        </button>
      </div>
      <div class="section-account__userstatistics-tabcontent" id="domains">
        <div class="section-account__userstatistics-tabcontent-domains">
        <?php foreach ($data['domains'] as $key => $domain) { ?>
            <div class="tab-item">
              <p><?php echo $domain['domainName'] . '.' . $domain['domainZone'] ?></p>
            </div>
        <?php } ?>
        </div>
      </div>
      <div class="section-account__userstatistics-tabcontent" id="posts">
        <div class="section-account__userstatistics-tabcontent-posts">
        <?php foreach ($data['userPosts'] as $key => $post): ?>
          
            <div class="tab-item">
              <p class="post-title"><?php echo $post['postTitle'] ?></p>
              <p class="post-category"><?php echo 'Category:'.$post['postCategory'].' .Posted on: '.$post['postDateTime'] ?></p>
              <p class="post-content"><?php echo $post['postContent'] ?></p>
            </div>
          
        <?php endforeach ?>
        </div>
      </div>
      <div class="section-account__userstatistics-tabcontent" id="comments"></div>
    </div>
  </div>
</div>
<!-- account-info -->