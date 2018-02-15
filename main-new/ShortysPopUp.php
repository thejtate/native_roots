<?php include 'tpl/utils.inc'; ?>
<?php Utils::set("active_header_nav", -1); ?>
<?php $title = 'ShortysPopUp'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page">
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="content-wrapper">
    <div class="site-container">
      <div class="modal">
        <a class="close" href="#">Close Window</a>
        <form action="">
          <h2>YOU FOUND IT</h2>
          <p>Hard to find, huh? That’s the benefit of Shortys: Discreet, small, pocket-sized. Now all you need to do is fill out the fields below and we’ll email you the coupon!</p>
          <div class="img"><img src="theme/images/bg/popup-bg.png" alt=""/></div>
          <div class="form form-popup">
            <div class="form-item field-first-name">
              <input class="form-text" type="text" placeholder="First Name"/>
            </div>
            <div class="form-item field-last-name">
              <input class="form-text" type="text" placeholder="Last Name"/>
            </div>
            <div class="form-item">
              <input class="form-text" type="text" placeholder="Email Name"/>
            </div>
            <div class="form-actions">
              <input type="submit" class="form-submit" value="SUBMIT"/>
            </div>
          </div>
        </form>
      </div>
      <br/>
      <div class="modal">
        <a class="close" href="#">Close Window</a>
        <div class="webform-confirmation">
          <h2>AND... DONE!</h2>
          <p>Congrats! Keep an eye on your email for the coupon code.</p>
          <div class="form-actions">
            <div class="form-submit ctools_backdrop_close-processed" id="modal-close">Close window</div>
          </div>
        </div>
      </div>
      <br/>
      <div class="modal form-done">
        <a class="close" href="#">Close Window</a>
        <div class="webform-confirmation">
          <h2>WELL... BUMMER.</h2>
          <p>We hate to be the bearer of bad news, but the coupons are already claimed. <br/> Check back next <strong>Friday, July 15th</strong> for another chance to win!</p>
          <div class="form-actions">
            <div class="form-submit ctools_backdrop_close-processed" id="modal-close">Close window</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>