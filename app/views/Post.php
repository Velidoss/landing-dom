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
                <div class="section-postlist__post-content-img">
                    <img src="<?php echo $data['post']['postImg'] ?>" alt="">   
                </div>
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
                <form class="section-postlist__post-actions-like" action="/posts/postlike/<?php echo $data['post']['postId'] ?>" method="post">
                    <button type="submit" name="like-btn"><img src="/img/svg/thumbs-up-solid.svg" alt=""></button>
                </form>
                <div class="section-postlist__post-actions-likecount">
                    <?php echo $data['post']['likecount'] ?>
                </div>
                <form class="section-postlist__post-actions-dislike" action="/posts/postdislike/<?php echo $data['post']['postId'] ?>" method="post">
                    <button type="submit" name="dislike-btn"><img src="/img/svg/thumbs-down-solid.svg" alt=""></button>
                </form>
            </div>
            <div class="section-postlist__post-comments">
                <?php
                    if (isset($data['comments'])):
                        foreach ($data['comments'] as $comment): ?>
                            <div class="section-postlist__post-comments-comment">
                                <div class="comment__author-img"><img src="<?php echo $comment['commentAuthorImg'] ?>" alt=""></div>
                                <div class="comment__text"><?php echo $comment['commentText'] ?></div>
                                <div class="comment__info">
                                    <p class="comment__info-author"><?php echo $comment['commentAuthorName'] ?></p>
                                    <p class="comment__info-date"><?php echo $comment['commentDate'] ?></p>
                                </div>
                                <div class="comment__actions">
                                    <form class="comment__actions-like" action="/posts/commentlike/<?php echo $comment['commentId'] ?>" method="post">
                                        <button type="submit" name="like-btn"><img src="/img/svg/thumbs-up-solid.svg" alt=""></button>
                                    </form>
                                    <div class="comment__actions-likecount">
                                        <?php echo $comment['commentLikeCount'] ?>
                                    </div>
                                    <form class="comment__actions-dislike" action="/posts/commentdislike/<?php echo $comment['commentId'] ?>" method="post">
                                            <button type="submit" name="dislike-btn"><img src="/img/svg/thumbs-down-solid.svg" alt=""></button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach ;
                    endif ?>
            </div>
        </div>
    </div>
</section>
<!-- postlist -->