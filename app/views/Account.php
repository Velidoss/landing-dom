<!-- account-info -->
<div class="section-outer section-account">
  <div class="section-inner">
  <?php var_dump($data['post_pagination']) ?>
    <div class="section-account__userinfo">
      <div class="section-account__userinfo-img">
        <img src="/img/userimage/<?php echo $data['userImg']; ?> " alt="anon" />
          <form class="section-account__userinfo-changeimg" action="/user/changeImg" enctype="multipart/form-data" method="post">
              <input name="new-image" type="file">
              <button name="changeimg-submit" type="submit">Change image</button>
          </form>
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
                          <textarea name="new-userdata" class="item-info__form-textarea" type="text"
                          rows = "5"><?php echo
                              $info['userInfo'] ?></textarea>
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
              <p class="post-category"><?php echo 'Category:' . $post['postCategory'] . ' .Posted on: ' . $post['postDateTime'] ?><a href="/posts/post/<?php echo $post['postId'] ?>">Go to post</a> </p>
              <p class="post-content"><?php echo $post['postContent'] ?></p>
              <p class="post-likes">Likes: <?php echo $post['postlikes'] ?></p>
            </div>
          
        <?php endforeach ?>
        </div>
        <?php
          if ($data['post_pagination']->countPages > 1) {
              echo $data['post_pagination'];
          }
        ?>
      </div>
      <div class="section-account__userstatistics-tabcontent" id="comments">
      <div class="section-account__userstatistics-tabcontent-comments">
        <?php foreach ($data['userComments'] as $key => $comment): ?>
            <div class="tab-item">
              <p class="comment-text"><?php echo $comment['commentText'] ?> <a href="/posts/post/<?php echo $comment['commentToPost'] ?>">Go to post</a></p>
              <p class="comment-date"><?php echo $comment['commentDate'] ?></p>
              <p class="comment-likes">Likes: <?php echo $comment['commentlikes'] ?></p>
            </div>
          
        <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- account-info -->