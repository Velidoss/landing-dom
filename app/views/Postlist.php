<!-- postlist -->
<section class="section-outer section-postlist">
    <div class="section-posts-inner">
        <?php foreach ($data['posts'] as $num => $post): ?>
            <div class="section-postlist__post">
                <div class="section-postlist__post-info">
                    <img class="section-postlist__post-info-pic" src="<?php echo $post['userImg'] ?>"
                         alt="" />
                    <p class="section-postlist__post-info-author"><?php echo htmlspecialchars($post['postAuthor']) ?></p>
                    <p class="section-postlist__post-info-dateposted"><?php echo $post['postDateTime'] ?></p>
                </div>
                <div class="section-postlist__post-content">
                    <div class="section-postlist__post-content-title"><?php echo htmlspecialchars($post['postTitle']) ?></div>
                    <div class="section-postlist__post-content-text">
                        <?php echo htmlspecialchars($post['postContent']) ?>
                    </div>

                </div>
                <div class="section-postlist__post-actions">
                    <a href="/posts/post/<?php echo $post['postId'] ?>"
                       class="section-postlist__post-actions-goto">Go to post</a>
                    <a href="/posts/post/<?php echo $post['postId'] ?>"
                       class="section-postlist__post-actions-comment">Comment</a>
                    <a href="/posts/post/<?php echo $post['postId'] ?>" class="section-postlist__post-actions-goto"><img src="/img/svg/thumbs-up-solid.svg" alt=""></a>
                        <div class="section-postlist__post-actions-likecount">
                            <?php echo $post['postLikeCount'] ?>
                        </div>
                    <a href="/posts/post/<?php echo $post['postId'] ?>" class="section-postlist__post-actions-goto"><img src="/img/svg/thumbs-down-solid.svg" alt=""></a>
                </div>
            </div>
        <?php endforeach ; ?>
        <div class="section-postlist__pagination">
                Постов: <?php echo count($data['posts']).' из '.$data['total'] ?>
                <?php if($data['pagination']->countPages >1){ 
                            $pagination->getHtml();
                 } ?>
        </div>
    </div>
</section>
<!-- postlist -->