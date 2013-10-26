<div ng-controller='TheSocialTimes' ng-init='init()'>
    <div class="row">
        <div class="col col-lg-12" style="">



            <div ng-hide='articles_loaded'>
                <h1 class="loadingfeest">Loading your articles</h1>
                <!-- 	<div id="loaderImage"></div> -->
            </div>

            <div ng-show='articles_loaded'>
                <div id="main" role="main">

                    <ul id="tiles">
                        <li ng-repeat="art in articles">

                            <p style="font-weight:bold;">{{art.title}}</p>
                            <img ng-src="{{art.images[0].url}}">


                            <p style="font-size:11px;padding-right:5px">{{art.description}}</p>
                            <p style="font-weight:300;font-size:11px;">Shared by </p>
                            <p class="tooltip-demo" style="margin-bottom:50px"><img data-toggle="tooltip" title="Fritz Hoste" src="img/profilepic.jpg" style="float:left;width:30px;" />
                            </p>
                            <hr style="width:102%;margin-top:20px;margin-bottom:0px;margin-left:-5px" />
                            <a ng-href="{{art.original_url}}"><p style="margin-bottom:5px;"><img src="{{art.favicon_url}}" style="width:15px;float:left"> 
                                    <span style="color:#b3b3b3;padding-left:10px;font-size:10px">{{art.provider_name}}</span></p></a>   
                        </li>


                    </ul>

                </div>

            </div>

        </div>
    </div>

</div>

<script>
    var cSpeed = 8;
    var cWidth = 142;
    var cHeight = 142;
    var cTotalFrames = 30;
    var cFrameWidth = 142;
    var cImageSrc = 'img/sprites.png';

    var cImageTimeout = false;
    var cIndex = 0;
    var cXpos = 0;
    var cPreloaderTimeout = false;
    var SECONDS_BETWEEN_FRAMES = 0;

    function startAnimation() {

        document.getElementById('loaderImage').style.backgroundImage = 'url(' + cImageSrc + ')';
        document.getElementById('loaderImage').style.width = cWidth + 'px';
        document.getElementById('loaderImage').style.height = cHeight + 'px';

        //FPS = Math.round(100/(maxSpeed+2-speed));
        FPS = Math.round(100 / cSpeed);
        SECONDS_BETWEEN_FRAMES = 1 / FPS;

        cPreloaderTimeout = setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES / 1000);

    }

    function continueAnimation() {

        cXpos += cFrameWidth;
        //increase the index so we know which frame of our animation we are currently on
        cIndex += 1;

        //if our cIndex is higher than our total number of frames, we're at the end and should restart
        if (cIndex >= cTotalFrames) {
            cXpos = 0;
            cIndex = 0;
        }

        if (document.getElementById('loaderImage'))
            document.getElementById('loaderImage').style.backgroundPosition = (-cXpos) + 'px 0';

        cPreloaderTimeout = setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES * 1000);
    }

    function stopAnimation() {//stops animation
        clearTimeout(cPreloaderTimeout);
        cPreloaderTimeout = false;
    }

    function imageLoader(s, fun)//Pre-loads the sprites image
    {
        clearTimeout(cImageTimeout);
        cImageTimeout = 0;
        genImage = new Image();
        genImage.onload = function() {
            cImageTimeout = setTimeout(fun, 0)
        };
        genImage.onerror = new Function('alert(\'Could not load the image\')');
        genImage.src = s;
    }

    //The following code starts the animation
    new imageLoader(cImageSrc, 'startAnimation()');
    var urls = <?php echo json_encode($urls); ?>;
    var config = {base_url: "<?php echo base_url(); ?>"};
</script>
