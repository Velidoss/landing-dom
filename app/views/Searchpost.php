<!-- search-post-->
<section class="section-outer section-searchpost">
    <div class="section-inner">
        <div class="section-searchpost__title">Search a post.</div>          
        <form action="/posts/searchpost" class="section-searchpost__form" method="POST">
            <input class="section-searchpost__form-input" name="searchpost-query" type="text" placeholder="Write a post name or word" />
            <button type="submit" class="btn-main" name="post-searchpost">Search a post</button>
        </form>
    </div>
</section>

<!-- search-post-->
<!-- postlist -->
<?php if($data['postsfound']>0): ?>
<section class="section-outer section-postlist">
    <div class="section-posts-inner">
        <?php foreach ($data['postsfound'] as $num => $post) { ?>
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
<?php endif ?>
<!-- postlist -->