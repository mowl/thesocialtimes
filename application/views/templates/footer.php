</div>


</div>
<!-- include jQuery -->
<script src="libs/jquery.min.js"></script>

<!-- Include the imagesLoaded plug-in -->
<script src="libs/jquery.imagesloaded.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Include the plug-in -->
<script src="jquery.wookmark.js"></script>

<!-- Once the images are loaded, initalize the Wookmark plug-in. -->
<script type="text/javascript">
    (function($) {
        $('#tiles').imagesLoaded(function() {
            // Prepare layout options.
            var options = {
                itemWidth: 200, // Optional min width of a grid item
                autoResize: true, // This will auto-update the layout when the browser window is resized.
                container: $('#tiles'), // Optional, used for some extra CSS styling
                offset: 5, // Optional, the distance between grid items
                outerOffset: 20, // Optional the distance from grid to parent
                flexibleWidth: 500 // Optional, the maximum width of a grid item
            };

            // Get a reference to your grid items.
            var handler = $('#tiles li');

            // Call the layout function.
            handler.wookmark(options);
        });

        $('.tooltip-demo').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

    })(jQuery);


</script>


<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
<script src="<?php echo base_url('js/tst.js'); ?>"></script>

</body>
</html>