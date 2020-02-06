<!-- postlist -->
<section class="section-outer section-postlist">
    <div class="section-posts-inner">
        <?php foreach ($data['posts'] as $num => $post) { ?>
            <div class="section-postlist__post">
                <div class="section-postlist__post-info">
                    <img class="section-postlist__post-info-pic" src="/img/anon.png" alt="" />
                    <p class="section-postlist__post-info-author"><?php echo $post['postAuthor'] ?></p>
                    <p class="section-postlist__post-info-dateposted"><?php echo $post['postDateTime'] ?></p>
                </div>
                <div class="section-postlist__post-content">
                    <div class="section-postlist__post-content-title"><?php echo $post['postTitle'] ?></div>
                    <div class="section-postlist__post-content-text">
                        <?php echo $post['postContent'] ?>
                    </div>
                </div>
            </div>
        <?php }; ?>
    </div>
</section>
<!-- postlist -->