<!-- makepost -->
<section class="section-outer section-makepost">
        <div class="section-inner">
            <div class="section-makepost__title">Make a post!</div>          
            <form action="/posts/makepostact" class="section-makepost__form" method="POST">
                <input class="section-makepost__form-input" name="posttile" type="text" placeholder="Post title" />
                <input class="section-makepost__form-input" name="postcategory" type="text" placeholder="Post category" />
                <textarea class="section-makepost__form-textarea" name="posttext" rows="8" placeholder="Message"></textarea>
                <button type="submit" class="btn-main" name="post-create">Make a post</button>
            </form>
        </div>
    </section>
    <!-- makepost -->