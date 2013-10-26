<div ng-controller='TheSocialTimes' ng-init='init()'>

    <div ng-hide='articles_loaded'>
        Loading the awesomeness
    </div>

    <div ng-show='articles_loaded'>
        <pre>
        {{articles}}
        </pre>
    </div>

</div>

<script>
    var urls = <?php echo json_encode($urls); ?>;
    var config = {base_url: "<?php echo base_url(); ?>"};
</script>