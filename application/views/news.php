<div ng-controller='TheSocialTimes' ng-init='init()'>
    <div class="row">
        <div class="col col-lg-12" style="">



            <div ng-hide='articles_loaded'>
                <h1 class="loadingfeest">Loading your articles</h1>
               <center><img src="img/twload.GIF" align="middle" /></center>
            </div>

            <div ng-show='articles_loaded'>
                <div id="main" role="main">

                    <ul id="tiles">
                        <li ng-repeat="art in articles" >

                            <a ng-click="set_active_item(art)" data-toggle="modal" href="#myModal"><p style="font-weight:500; font-size: 16px; margin-bottom: 4px;">{{art.title}}</p>
                            <div  ng-style="{'background-image':'url('+art.images[0].url+')', 'height':art.random_height}" style='background-position:center; background-size: cover;'></div></a>

                            <p style="font-size:11px;padding-right:5px;">{{art.description}}</p>
                            <p style="font-weight:300;font-size:11px;">Shared by </p>
                            
                            <p class="tooltip-demo" style="margin-bottom:50px">
                                <img data-toggle="tooltip" title="{{user_info(art.to_resolve).name}}" ng-src="{{user_info(art.to_resolve).profile_picture}}" style="float:left;width:30px;" />
                            </p>
                            
                            <hr style="width:103%;margin-top:20px;margin-bottom:0px;margin-left:-5px" />
                            <a ng-href="{{art.original_url}}"><p style="margin-bottom:5px;">
                                    <img src="{{art.favicon_url}}" style="width:15px;float:left" /> 
                                    <span style="color:#b3b3b3;padding-left:10px;font-size:10px">
                                        {{art.provider_name}}
                                    </span>
                                    <span class="pull-right">{{art.published | date:'yyyy-MM-dd HH:mm'}}</span>
                                </p>
                            </a>

                          
                        </li>


                    </ul>
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog" style="width:780px!important;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{active_item.title}}</h4>
                                  </div>
                                  <div class="modal-body">
                                   <div ng-bind-html-unsafe="active_item.content"></div> 
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->   

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
