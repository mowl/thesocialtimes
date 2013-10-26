<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>iMinds</title>
        <meta name="description" content="We'll keep performing if free drinks and food is provided.">
        <meta name="author" content="Devs at iMinds">

        <link rel="stylesheet" href="<?php echo base_url('css/root.css'); ?>">     
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet" media="screen">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url('js/html5shiv.js'); ?>"></script>
          <script src="<?php echo base_url('js/respond.min.js'); ?>"></script>
        <![endif]-->
          <link rel="stylesheet" href="css/reset.css">

          <!-- Global CSS for the page and tiles -->
          <link rel="stylesheet" href="css/main.css">

           <!-- Specific CSS for the example -->
  <style>
    /**
     * Grid items
     */
    #tiles li {
      -moz-box-sizing: border-box;
           box-sizing: border-box;
    }

    #tiles li img {
      width: 100%;
      height: auto;
    }
  </style>

    </head>
<body>
<div class="container">

      <h1 class="loadingfeest">Loading your articles</h1>
     <div id="loaderImage"></div>

</div>

<script type="text/javascript">
  var cSpeed=8;
  var cWidth=142;
  var cHeight=142;
  var cTotalFrames=30;
  var cFrameWidth=142;
  var cImageSrc='img/sprites.png';
  
  var cImageTimeout=false;
  var cIndex=0;
  var cXpos=0;
  var cPreloaderTimeout=false;
  var SECONDS_BETWEEN_FRAMES=0;
  
  function startAnimation(){
    
    document.getElementById('loaderImage').style.backgroundImage='url('+cImageSrc+')';
    document.getElementById('loaderImage').style.width=cWidth+'px';
    document.getElementById('loaderImage').style.height=cHeight+'px';
    
    //FPS = Math.round(100/(maxSpeed+2-speed));
    FPS = Math.round(100/cSpeed);
    SECONDS_BETWEEN_FRAMES = 1 / FPS;
    
    cPreloaderTimeout=setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES/1000);
    
  }
  
  function continueAnimation(){
    
    cXpos += cFrameWidth;
    //increase the index so we know which frame of our animation we are currently on
    cIndex += 1;
     
    //if our cIndex is higher than our total number of frames, we're at the end and should restart
    if (cIndex >= cTotalFrames) {
      cXpos =0;
      cIndex=0;
    }
    
    if(document.getElementById('loaderImage'))
      document.getElementById('loaderImage').style.backgroundPosition=(-cXpos)+'px 0';
    
    cPreloaderTimeout=setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES*1000);
  }
  
  function stopAnimation(){//stops animation
    clearTimeout(cPreloaderTimeout);
    cPreloaderTimeout=false;
  }
  
  function imageLoader(s, fun)//Pre-loads the sprites image
  {
    clearTimeout(cImageTimeout);
    cImageTimeout=0;
    genImage = new Image();
    genImage.onload=function (){cImageTimeout=setTimeout(fun, 0)};
    genImage.onerror=new Function('alert(\'Could not load the image\')');
    genImage.src=s;
  }
  
  //The following code starts the animation
  new imageLoader(cImageSrc, 'startAnimation()');
</script>
</body>

</html>