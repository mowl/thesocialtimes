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
            
            $scope.$apply();
        });

        request.fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Ajax Error: " + textStatus, errorThrown);
        });

    };
}
