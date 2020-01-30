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
              <?php foreach($data as $key =>$domain){?>
                <div class="tab-item">
                    <p><?php echo $domain['domainName'].'.'.$domain['domainZone'] ?></p>
                </div>               
              <?php }?>
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