Array.prototype.removeJson = function(name, value){
   var array = $.map(this, function(v,i){
      return v[name] === value ? null : v;
   });
   this.length = 0; 
   this.push.apply(this, array); 
}

// Angular App
angular.module('bddev', ['ionic'])
    .controller('ListController', ['$scope', '$http', '$timeout', function ($scope, $http, $timeout)
    {
        $http.get('js/data.json').success(function (data)
        {
            $scope.devsites = data;
            $scope.statusOrder = 'site';
            $scope.editing = false;
            var count = $scope.devsites.length;
            $('.projectID').val(count);
            var clearForm = function ()
            {
                site_id = $('.projectID').val(""),
                site_name = $("#site_name").val(""),
                site_url = $("#site_url").val(""),
                site_status = $("#site_status").val(""),
                site_wdp = $("#site_wdp").val("");
            }
            var updateCount = function ()
            {
                clearForm();
                count = count + 1;
                $('.projectID').val(count);
            }
            var httpPost = function ()
            {
                $.post('php/handler.php', angular.toJson($scope.devsites)).success(function ()
                {
                    updateCount();
                })
            };
            $scope.onItemClicked = function (item) {
                item.isVisible = true;
                $timeout(function() {
                    item.isVisible = false;
                    window.getSelection().removeAllRanges();
                }, 3000)

            }
            $scope.editSite = function (field)
            {
                $scope.editing = $scope.devsites.indexOf(field);
            };
            $scope.addSite = function (index)
            {
                var site_id = $('.projectID').val(),
                    site_name = $("#site_name").val(),
                    site_url = $("#site_url").val(),
                    site_status = $("#site_status").val(),
                    site_wdp = $("#site_wdp").val();
                $scope.devsites.push(
                {
                    id: parseInt(site_id),
                    site: site_name,
                    url: site_url,
                    status: site_status,
                    wdp: site_wdp
                });
                httpPost();
            };
            $scope.saveField = function (index)
            {
                editMode = false;
                if ($scope.editing !== false)
                {
                    $scope.editing = false;
                }
                httpPost();
            };
            $scope.deleteSite = function (id)
            {
                $scope.devsites.removeJson("id", id);
                httpPost();
            };
            $scope.cancel = function (index)
            {
                if ($scope.editing !== false)
                {
                    $scope.editing = false;
                }
            };
        })
    }])
    // Custom stuff, don't judge me.
$(window).scroll(function ()
{
    var search = $('#search_box'),
        scroll = $(window).scrollTop();
    (scroll >= 100) ? search.addClass('fixed'): search.removeClass('fixed');
});