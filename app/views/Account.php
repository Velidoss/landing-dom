<!-- account-info -->
<div class="seciotn-outer section-account">
      <div class="section-inner">
        <div class="section-account__userinfo">
          <div class="section-account__userinfo-img">
            <img src="/img/anon.png" alt="anon" />
          </div>
          <div class="section-account__userinfo-data">
            <p class="name-surname">John Doe</p>
            <p class="name-age">19</p>
            <p class="name-description">
              I am a funny and self-motivated person. I like spending my time
              with my dogo - Morty.
            </p>
          </div>
        </div>
        <div class="section-account__userstatistics">
          <div class="section-account__userstatistics-tabs">
            <button class="section-account__userstatistics-tabs-tablink">
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
              <?php var_dump($data); ?>
            <div class="tab-item">
              <p>ololo.ing</p>
            </div>
            <div class="tab-item">
              <p>beta.com</p>
            </div>
            <div class="tab-item">
              <p>trololo.gov.ua</p>
            </div>
            <div class="tab-item">
              <p>begov.biz</p>
            </div>
          </div>
          <div
            class="section-account__userstatistics-tabcontent"
            id="posts"
          ></div>
          <div
            class="section-account__userstatistics-tabcontent"
            id="comments"
          ></div>
        </div>
      </div>
    </div>
    <!-- account-info -->