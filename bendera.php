<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>admin_assets/js/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>admin_assets/css/indonesia.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <style type="text/css">
    html,
    body {
      margin: 0;
      padding: 0;
    }

    body {
      font-size: 16px;
      line-height: 26px;
      font-family: Helvetica, 'Helvetica Neue', Arial;
    }

    .ground {
      background-image: linear-gradient(white 50%, #ddd);
      padding-bottom: 20px;
      height: 480px;
    }

    .flag {
      position: relative;
      display: inline-block;
      margin: 2em 3em 120px;
      width: 120px;
      height: 120px;
      border: 1px solid #bbb;
      border-left-color: white;
      box-sizing: border-box;
      box-shadow: 2px 5px 14px 0px rgba(0, 0, 0, 0.4);
      -webkit-backface-visibility: hidden;
      -webkit-perspective: 1000;
      -webkit-transform-style: preserve3d;
      -webkit-transform-origin: 0 250px;
      -webkit-transform: translate3d(0, 0, 0) rotateZ(5deg) rotateY(-22deg);
      -webkit-animation-name: wave;
      -webkit-animation-duration: 8s;
      -webkit-animation-timing-function: cubic-bezier(0.16, 0.14, 0.82, 0.73);
      -webkit-animation-timing-function: linear;
      -webkit-animation-iteration-count: infinite;
    }

    .flag:nth-child(odd) {
      -webkit-animation-delay: 1s;
    }

    .flag:before {
      position: absolute;
      content: "";
      height: 240px;
      left: -5px;
      top: -3px;
      width: 6px;
      border-right: 1px solid white;
      border-radius: 3px;
      background-color: #444;
      box-shadow: -3px 3px 8px 0px rgba(0, 0, 0, 0.4);
    }

    .flag.rect {
      width: 168px;
    }

    .flag-pattern {
      position: absolute;
      width: 100%;
      height: 100%;
      box-sizing: border-box;
      -webkit-box-reflect: below 60px -webkit-gradient(linear, left top, left bottom, from(transparent), color-stop(70%, transparent), to(rgba(255, 255, 255, 0.05)));
    }

    .flag-pattern.id {
      background-color: white;
      background-image: linear-gradient(#c80000 50%, transparent 50%);
    }

    .flag-wave {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: -webkit-gradient(linear, 0 -25%, 100% top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(20%, rgba(255, 255, 255, 0)), color-stop(30%, rgba(0, 0, 0, 0.04)), color-stop(40%, rgba(255, 255, 255, 0.2)), color-stop(60%, rgba(255, 255, 255, 0)), color-stop(65%, rgba(255, 255, 255, 0.2)), color-stop(80%, rgba(0, 0, 0, 0.05)), color-stop(100%, rgba(255, 255, 255, 0)));
      background-size: 200%;
      -webkit-animation-name: flutter;
      -webkit-animation-duration: 8s;
      -webkit-animation-timing-function: cubic-bezier(0.16, 0.14, 0.82, 0.73);
      -webkit-animation-iteration-count: infinite;
    }

    @-webkit-keyframes flutter {
      0% {
        background-position: -200% 0px;
      }

      30% {
        background-position: -60% 5px;
      }

      70% {
        background-position: 70% -5px;
      }

      100% {
        background-position: 200% 0px;
      }
    }

    @-webkit-keyframes wave {
      0% {
        box-shadow: 4px 5px 5px 0 rgba(0, 0, 0, 0.1);
        -webkit-transform: translate3d(0, 0, 0) rotateZ(5deg) rotateY(22deg);
      }

      20% {
        box-shadow: 4px 5px 15px 0 rgba(0, 0, 0, 0.1);
        -webkit-transform: translate3d(0, 0, 0) rotateZ(5deg) rotateY(0deg);
      }

      40% {
        box-shadow: 4px 5px 20px 0 rgba(0, 0, 0, 0.4);
        -webkit-transform: translate3d(0, 0, 0) rotateZ(6deg) rotateY(-22deg);
      }

      60% {
        box-shadow: 4px 5px 5px 0 rgba(0, 0, 0, 0.1);
        -webkit-transform: translate3d(0, 0, 0) rotateZ(5deg) rotateY(0deg);
      }

      80% {
        box-shadow: 4px 5px 5px 0 rgba(0, 0, 0, 0.3);
        -webkit-transform: translate3d(0, 0, 0) rotateZ(5deg) rotateY(16deg);
      }

      100% {
        box-shadow: 4px 5px 5px 0 rgba(0, 0, 0, 0.1);
        -webkit-transform: translate3d(0, 0, 0) rotateZ(5deg) rotateY(22deg);
      }
    }

    .logo {
      width: 32%;
      margin-left: 10px;
      position: relative;
      top: -30px;
    }
  </style>

<body>
  <div class="ground">
    <div class="flag rect">
      <div class="flag-pattern id"></div>
      <div class="flag-wave"></div>
    </div>
    <img src="<?php echo base_url(); ?>assets/image/74.png" class="logo">
  </div>
</body>
</head>

</html>