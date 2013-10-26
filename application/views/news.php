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

                            <p style="font-weight:bold; font-size: 17px; margin-bottom: 4px;">{{art.title}}</p>
                            <div ng-style="{'background-image':'url('+art.images[0].url+')', 'height':art.random_height}" style='background-position:center; background-size: cover;'></div>

                            <p style="font-size:11px;padding-right:5px">{{art.description}}</p>
                            <p style="font-weight:300;font-size:11px;">Shared by </p>
                            
                            <p class="tooltip-demo" style="margin-bottom:50px">
                                <img data-toggle="tooltip" title="{{user_info(art.to_resolve).name}}" ng-src="{{user_info(art.to_resolve).profile_picture}}" style="float:left;width:30px;" />
                            </p>
                            
                            <hr style="width:102%;margin-top:20px;margin-bottom:0px;margin-left:-5px" />
                            <a ng-href="{{art.original_url}}"><p style="margin-bottom:5px;">
                                    <img src="{{art.favicon_url}}" style="width:15px;float:left" /> 
                                    <span style="color:#b3b3b3;padding-left:10px;font-size:10px">
                                        {{art.provider_name}}
                                    </span>
                                </p>
                            </a>   
                        </li>


                    </ul>

                </div>

            </div>

        </div>
    </div>

</div>

<script>
    var urls = <?php echo json_encode($urls); ?>;
    var config = {base_url: "<?php echo base_url(); ?>"};
    var extra_info = <?php echo json_encode($extra_info); ?>;
</script>
