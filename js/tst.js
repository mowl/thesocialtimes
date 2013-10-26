function TheSocialTimes($scope, $http) {

    $scope.urls = urls;
    $scope.init = function() {

        var url = config.base_url + 'news/resolve';

        var request = $.ajax({
            url: url,
            type: "post",
            data: {urls: JSON.stringify($scope.urls)}
        });

        request.done(function(response) {
            $scope.articles = response;
            $scope.articles_loaded = true;
            console.log($scope.articles);


            $scope.$apply();

            var options = {
                itemWidth: 200, // Optional min width of a grid item
                autoResize: true, // This will auto-update the layout when the browser window is resized.
                container: $('#tiles'), // Optional, used for some extra CSS styling
                offset: 5, // Optional, the distance between grid items
                outerOffset: 20, // Optional the distance from grid to parent
                flexibleWidth: 350  // Optional, the maximum width of a grid item
            };

            // Get a reference to your grid items.
            var handler = $('#tiles li');

            // Call the layout function.
            handler.wookmark(options);
        });

        request.fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Ajax Error: " + textStatus, errorThrown);
        });

    };
}
