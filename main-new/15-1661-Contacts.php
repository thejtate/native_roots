<?php include 'tpl/utils.inc'; ?>
<?php Utils::set("active_header_nav", -1); ?>
<?php $title = '15-1661-Contacts'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page page-contact">
<div class="b-popup">
  <div class="inner-popup">
    <!--    <div class="logo"><img src="theme/images/logo-a.png" alt=""/></div>-->
    <div class="title title-1"><img src="theme/images/tmp/title-are-you.png" alt=""/></div>
    <div class="title title-2"><img src="theme/images/tmp/title-twenty-one.png" alt=""/></div>
    <div class="title title-3"><img src="theme/images/tmp/title-or-older.png" alt=""/></div>
    <div class="btns-control">
      <a class="btn btn-yes" href="#"><img src="theme/images/tmp/title-yes.png" alt=""/></a>
      <span class="icon"></span>
      <a class="btn btn-no" href="#"><img src="theme/images/tmp/title-no.png" alt=""/></a>
    </div>
  </div>
</div>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <section class="section section-top parallax-box image-parallax-box">
    <div class="parallax-content media">
      <div class="title title-2"><img class="el-with-animation animate-opacity animate-zoom-in" src="theme/images/tmp/title-contact-retina.png" alt=""/></div>
<!--      <div class="text">-->
<!--        <p>For all media inquiries or requests for interviews, shoot us an email.</p>-->
<!--        <div class="btn-wrap"><a href="#">EMAIL US</a></div>-->
<!--      </div>-->
    </div>
    <div class="parallax-bg" data-parallax-type="image" data-img-url="theme/images/tmp/Contact.jpg" data-speed="normal" data-invert="false"></div>
  </section>
  <div class="content-wrapper">
    <div class="site-container">
      <div class="left-part">
        <div class="top-text">
          <p>For all media inquiries or requests for interviews,
            please email <a href="mailto:media@nativeroots303.com">media@nativeroots303.com</a>.</p>
        </div>
        <div class="text">
          <p>If you’d like to ask us a question or just simply give us a shout out, fill out the fields below. We’d love to hear from you!</p>
        </div>
        <!--      <div class="thank-you"><img src="theme/images/tmp/title-thank-you-s-a.png" alt=""/></div>-->
        <div class="form form-contact">
          <div class="form-item form-type-text">
            <label>NAME</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-text">
            <label>EMAIL</label>
            <input type="text" class="form-text"/>
          </div>
          <div class="form-item form-type-textarea">
            <label>MESSAGE</label>
            <textarea class="form-textarea"></textarea>
          </div>
          <div class="form-actions">
            <input type="submit" class="form-submit" value="SUBMIT"/>
          </div>
        </div>
      </div>
      <div class="right-part">
        <h2>FOLLOW US ON
          SOCIAL MEDIA</h2>
        <div class="social-menu">
          <ul>
            <li class="social-1"><a href="#"></a></li>
            <li class="social-2"><a href="#"></a></li>
            <li class="social-3"><a href="#"></a></li>
            <li class="social-4"><a href="#"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <section class="section section-newsletter parallax-box image-parallax-box">
    <!--    <div class="bg el-with-animation animate-opacity animate-zoom-out"></div>-->
    <div class="parallax-content">
      <div class="site-container">
        <div class="left-part">
          <h3>NEWSLETTER</h3>
          <p>Monthly promotions coming your way. Sign up and get all Native offers you can handle. You won't want to miss out on all the exclusive goods.</p>
        </div>
        <div class="right-part">
          <div class="form form-newsletter">
            <form action="demo_actions/submit.php" method="post" id="test" class="ajax-submit">
              <div class="form-item form-type-text">
                <input type="text" class="form-text" name="first_name" placeholder="FIRST NAME"/>
              </div>
              <div class="form-item form-type-text">
                <input type="text" class="form-text" name="last_name" placeholder="LAST NAME"/>
              </div>
              <div class="form-item form-type-text">
                <input type="text" class="form-text" name="email" placeholder="EMAIL"/>
              </div>
              <div class="form-item form-type-radio">
                <input id="medical" type="radio" name="type" value="Medical" class="form-radio"/>
                <label for="medical">Medical</label>
              </div>
              <div class="form-item form-type-radio">
                <input checked id="recreational"  type="radio" name="type" value="Recreational"  class="form-radio"/>
                <label for="recreational">Recreational</label>
              </div>
              <div class="form-actions">
                <input type="submit" class="form-submit" value="SIGN-UP"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax-bg" data-parallax-type="image" data-img-url="theme/images/bg/bg-3.jpg" data-speed="normal" data-invert="false"></div>
  </section>
  <section class="section section-location">
    <div class="site-container">
      <div class="content-item">
        <a href="#"><h3>NATIVE ROOTS DENVER</h3>
          <p>Medical <span>18+</span> Recreational <span>21+</span></p>
          <div class="location">
            1555 Champa Street <br/>
            Denver, CO 80202
          </div>
          <div class="info">9am-7pm</div>
          <div class="tel">303-623-1900</div></a>
      </div>
      <div class="content-item">
        <a href="#"><h3>NATIVE ROOTS DENVER</h3>
          <p>Medical <span>18+</span> Recreational <span>21+</span></p>
          <div class="location">
            1555 Champa Street <br/>
            Denver, CO 80202
          </div>
          <div class="info">9am-7pm</div>
          <div class="tel">303-623-1900</div></a>
      </div>
      <div class="content-item">
        <a href="#"><h3>NATIVE ROOTS DENVER</h3>
          <p>Medical <span>18+</span> Recreational <span>21+</span></p>
          <div class="location">
            1555 Champa Street <br/>
            Denver, CO 80202
          </div>
          <div class="info">9am-7pm</div>
          <div class="tel">303-623-1900</div></a>
      </div>
      <div class="content-item">
        <a href="#"><h3>NATIVE ROOTS DENVER</h3>
          <p>Medical <span>18+</span> Recreational <span>21+</span></p>
          <div class="location">
            1555 Champa Street <br/>
            Denver, CO 80202
          </div>
          <div class="info">9am-7pm</div>
          <div class="tel">303-623-1900</div></a>
      </div>
      <div class="content-item">
        <a href="#"><h3>NATIVE ROOTS DENVER</h3>
          <p>Medical <span>18+</span> Recreational <span>21+</span></p>
          <div class="location">
            1555 Champa Street <br/>
            Denver, CO 80202
          </div>
          <div class="info">9am-7pm</div>
          <div class="tel">303-623-1900</div></a>
      </div>
      <div class="content-item">
        <a href="#"><h3>NATIVE ROOTS DENVER</h3>
          <p>Medical <span>18+</span> Recreational <span>21+</span></p>
          <div class="location">
            1555 Champa Street <br/>
            Denver, CO 80202
          </div>
          <div class="info">9am-7pm</div>
          <div class="tel">303-623-1900</div></a>
      </div>
    </div>
  </section>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>