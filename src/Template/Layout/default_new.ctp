<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
    <link rel="stylesheet" type="text/css" href="">

    <?php echo $this->Html->charset(); ?>
  <title>
    <?php
      if(isset($title)) {
        echo $title;
      }
      else {
        echo $this->fetch('title');
      }
    ?>
  </title>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
    <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous">
      </script>
  <?php
      echo $this->Html->meta('icon');
      echo $this->Html->css('/lib/bootstrap.min.css');
      echo $this->Html->css('/lib/font-awesome.min.css');
      echo $this->Html->css('/css/animate.css');
      echo $this->Html->css('/css/membership.css');
      echo $this->Html->css('/css/custom.css');
      echo $this->Html->css('/css/custom2.css');
      echo $this->Html->css('/css/jquery-ui.min.css');
      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');
      echo $this->Html->script('/js/custom3.js');
      echo $this->Html->script('/js/coundown-timer.js');
      echo $this->Html->script('/js/gmaps.js');
      echo $this->Html->script('/js/html5shiv.js');
      echo $this->Html->script('/js/jquery.js');
      echo $this->Html->script('/js/jquery.nav.js');
      echo $this->Html->script('/js/jquery.parallax.js');
      echo $this->Html->script('/js/jquery.scrollTo.js');
      echo $this->Html->script('/js/main.js');
      echo $this->Html->script('/js/modernizr.custom.86080.js');
      echo $this->Html->script('/js/respond.min.js');
      echo $this->Html->script('/js/smoothscroll.js');
      echo $this->Html->script('/lib/bootstrap.min.js');
      echo $this->Html->script('/js/jquery-1.12.4.js');
      echo $this->Html->script('/js/jquery-ui.min.js');
      echo $this->Html->script('/js/custom2.js');
      echo $this->Html->script('ckeditor/ckeditor');
      echo $this->Html->script('/js/pollChart.js');
      echo $this->Html->script('/js/canvasjs.js');
      echo $this->Html->script('/js/canvas.min.js');
      echo $this->Html->script('/js/custom.js');
      echo $this->Html->script('/js/jquery.validate.min.js');
      
  ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="shortcut icon" href="/files/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/files/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/files/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/files/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/files/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

<div class="first-wrap" style="width: 100; height: 100vh;overflow: -moz-scrollbars-none; ">

<div id="overlayer"></div>
<span class="loader">
  <span class="loader-inner" style="text-align: center;">
    <img src="/files/images/Spinner-1s-200px.gif">
  </span>
</span>

</div>

<div class="second-wrap" style="display: none;">
    <header>
      <?php echo $this->element('header'); ?>
    </header>
    <main role="main">
      <div class="main-container">
        <div id="content">
          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>
        </div>
      </div>
      <!-- FOOTER -->
      <footer>
        <?= $this->element('footer') ?>
      </footer>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>

  </div>

</body>
</html>
