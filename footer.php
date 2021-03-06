    <footer class="pageFooter">
      <ul class="pageFooter__links footerLinks wow slideInUp">
        <a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) );
        ?>"><li class="footerLinks__link footerLinks__link--contact footerLink wow slideInLeft">
          <div class="footerLink__title footerLink__title--text">
            CONTACT
          </div>
          <small class="footerLink__description">
            取材依頼・その他お問い合わせ
          </small>
        </li></a>
        <a href="http://foodsalvage.or.jp" target="_blank">
          <li class="footerLinks__link footerLinks__link--foodSalvage footerLink wow slideInRight">
            <div class="footerLink__title footerLink__title--image">
              <img src="<?php
                echo get_template_directory_uri();
                echo '/images/logo_food_salvage.png';
              ?>" alt="Food Salvage" />
            </div>
            <small class="footerLink__description">
              運営団体について
            </small>
          </li>
        </a>
      </ul>

      <ul class="pageFooter__siteMap siteMap wow slideInUp">
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'about' ) ) );
        ?>">About</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'action' ) ) );
        ?>">Action</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'schedule' ) ) );
        ?>">Schedule</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
        ?>">Topic</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'report' ) ) );
        ?>">Report</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'feature' ) ) );
        ?>">Feature</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'information' ) ) );
        ?>">Information</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'fAQ' ) ) );
        ?>">FAQ</a></li>
      </ul>

      <div class="pageFooter__notes footerNotes wow slideInUp">
        <p class="footerNotes__note">
          <small>
            本ウェブサイトは、東京都環境局「持続可能な資源利用」に向けたモデル事業
            （2015年度）として制作されました。
          </small>
        </p>
        <p class="footerNotes__license">
          <small>
            &copy; 2016 <a href="http://foodsalvage.or.jp">Food Salvage</a>
          </small>
        </p>
      </div>
    </footer>

    <script src="<?php
      echo get_template_directory_uri() . '/js/app.babel.js';
    ?>"></script>
    <script src="<?php
      echo get_template_directory_uri() . '/js/wow.js';
    ?>"></script>
    <script type="text/javascript">
      new WOW().init()
    </script>
  </body>
</html>
