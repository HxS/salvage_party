    <footer class="pageFooter">
      <ul class="pageFooter__links footerLinks">
        <a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'CONTACT' ) ) );
        ?>">
          <li class="footerLinks__link footerLinks__link--contact footerLink">
            <div class="footerLink__title footerLink__title--text">
              CONTACT
            </div>
            <small class="footerLink__description">
              取材依頼・その他お問い合わせ
            </small>
          </li>
        </a>
        <a href="http://foodsalvage.or.jp" target="_blank">
          <li class="footerLinks__link footerLinks__link--foodSalvage footerLink">
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

      <ul class="pageFooter__siteMap siteMap">
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'ABOUT' ) ) );
        ?>">About</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'ACTION' ) ) );
        ?>">Action</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'SCHEDULE' ) ) );
        ?>">Schedule</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'TOPIC' ) ) );
        ?>">Topic</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'REPORT' ) ) );
        ?>">Report</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'FEATURE' ) ) );
        ?>">Feature</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'INFORMATION' ) ) );
        ?>">Information</a></li>
        <li><a href="<?php
          echo esc_url( get_permalink( get_page_by_title( 'FAQ' ) ) );
        ?>">FAQ</a></li>
      </ul>

      <div class="pageFooter__notes footerNotes">
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
  </body>
</html>
