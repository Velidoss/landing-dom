<!-- postlist -->
<section class="section-outer section-postlist">
    <div class="section-posts-inner">
        <div class="section-postlist__post">
            <div class="section-postlist__post-info">
                <img class="section-postlist__post-info-pic" src="<?php echo $data['post']['userImg'] ?>"
                        alt="" />
                <p class="section-postlist__post-info-author"><?php echo $data['post']['postAuthor'] ?></p>
                <p class="section-postlist__post-info-dateposted"><?php echo $data['post']['postDateTime'] ?></p>
            </div>
            <div class="section-postlist__post-content">
                <div class="section-postlist__post-content-title"><?php echo $data['post']['postTitle'] ?></div>
                <div class="section-postlist__post-content-text">
                    <?php echo $data['post']['postContent'] ?>
                </div>
            </div>
            <div class="section-postlist__post-actions">
                <button type="submit" onclick="ToggleCommentField()" class="section-postlist__post-actions-comment_btn">Comment</button>
                <form class="section-postlist__post-actions-comment_make" action="/posts/makecomment/<?php echo $data['post']['postId'] ?>" method="POST">
                    <textarea  name="comment-text" id="" cols="30" rows="5" placeholder="Type a comment"></textarea>  
                    <button onclick="ToggleCommentField()" class="section-postlist__post-actions-comment_make-btn" name="comment-submit" type="submit">Submit</button>
                </form>        
                <a class="section-postlist__post-actions-like"><img src="/img/svg/thumbs-up-solid.svg" alt=""></a>
                <a class="section-postlist__post-actions-dislike"><img src="/img/svg/thumbs-down-solid.svg" alt=""></a>
            </div>
            <div class="section-postlist__post-comments">
                <?php var_dump($data['comments']) ?>
                <?php foreach ($data['comments'] as $comment): ?>
                    <div class="section-postlist__post-comments-comment">
                        <div class="comment_text"><?php echo $comment['commentText'] ?></div>
                        <div class="comment_info">
                            <p class="comment_info-author"></p>
                            <p class="comment_info-date"></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-- postlist -->