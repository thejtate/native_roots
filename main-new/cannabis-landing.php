<?php include 'tpl/utils.inc'; ?>
<?php Utils::set("active_header_nav", 3); ?>
<?php $title = 'Native Roots'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body class="page page-cannabis-landing">
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
  <div class="content-wrapper">
    <div class="site-container">
      <div class="content-top">
        <h2>Already know what you’re looking for?</h2>
        <p>Whether you’re looking for strains, edibles, concetrates or more, <br/>
          select from the dropdown below and be on your way.</p>
        <div class="form form-pick-your-strain">
          <div class="form-item form-type-select">
            <select class="form-select">
              <option value="cannabis-landing">PICK YOUR STRAIN</option>
              <option value="cannabis">PINEAPPLE EXPRESS</option>
              <option value="blueberry-afgoo">Blueberry Afgoo</option>
              <option value="agent-orange">Agent Orange</option>
              <option value="cantaloupe-haze">Cantaloupe Haze</option>
              <option value="cherry-pie-kush">Cherry Pie Kush </option>
              <option value="grape-romulan">Grape Romulan </option>
              <option value="jack-herer">Jack Herer</option>
              <option value="ingrid">Ingrid</option>
              <option value="juicy-fruit">Juicy Fruit</option>
              <option value="master-kush">Master Kush</option>
              <option value="jillybean">Jillybean</option>
            </select>
          </div>
        </div>
        <div class="el-with-animation el-1"><img src="theme/images/tmp/flower1.png" alt=""/></div>
        <div class="el-with-animation el-2"><img src="theme/images/tmp/flower2.png" alt=""/></div>
        <div class="el-with-animation el-3"><img src="theme/images/tmp/flower3.png" alt=""/></div>
      </div>
<!--      <div class="content-middle">-->
<!--        <h2>NOT SURE WHAT STRAIN YOU SEEK?</h2>-->
<!--        <p>No problem, we can help! Let us know what experience you’re looking for <br/>-->
<!--          and we’ll show you the way.</p>-->
<!--        <div class="form form-want-to">-->
<!--          <h3>I want to</h3>-->
<!--          <div class="form-item form-type-select">-->
<!--            <select class="form-select first-control">-->
<!--              <option value="0">FEEL</option>-->
<!--              <option value="1">TASTE</option>-->
<!--              <option value="2">SMELL</option>-->
<!--            </select>-->
<!--          </div>-->
<!--          <div data-filter="0" class="form-item form-type-select">-->
<!--            <select class="form-select">-->
<!--              <option>RELAXED</option>-->
<!--              <option>Awake</option>-->
<!--            </select>-->
<!--          </div>-->
<!--          <div data-filter="1" class="form-item form-type-select">-->
<!--            <select class="form-select">-->
<!--              <option>Skittles</option>-->
<!--              <option>Sour</option>-->
<!--              <option>Tart</option>-->
<!--            </select>-->
<!--          </div>-->
<!--          <div data-filter="2" class="form-item form-type-select">-->
<!--            <select class="form-select">-->
<!--              <option>Skunk</option>-->
<!--              <option>Sweet</option>-->
<!--            </select>-->
<!--          </div>-->
<!--          <div class="btn-wrap"><a href="cannabis.php">FIND MY STRAIN</a></div>-->
<!--        </div>-->
<!--      </div>-->
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>