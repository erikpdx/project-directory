<?php
    $allowed = array("73.25.186.143","76.115.112.245", "185.94.28.238", "75.164.162.221", "185.94.28.246");
    if (!in_array ($_SERVER['REMOTE_ADDR'], $allowed)) {
       header("location: https://www.youtube.com/embed/DLzxrzFCyOs?rel=0&autoplay=1");
       exit();
    } 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title></title>
    <link href="lib/ionic/css/ionic.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- IF using Sass (run gulp sass first), then uncomment below and remove the CSS includes above
    <link href="css/ionic.app.css" rel="stylesheet">
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- ionic/angularjs js -->
    <script src="lib/ionic/js/ionic.bundle.js"></script>
    <!-- your app's js -->
    <script src="js/app.js"></script>
</head>

<body ng-app="bddev" ng-controller="ListController">
    <div id="wrap">
        <header class="bar-positive">
            <h1 class="title">Brandefined Development Sites</h1>
            <div id="results">
                <div class="search" id="search_box">
                    <div class="container">
                        <label>Search: </label>
                        <input ng-model="query" placeholder="Search for project" autofocus id="querybox">
                        <label class="formgroup">Order by:</label>
                        <select ng-model="statusOrder">
                            <option value="site">Business</option>
                            <option value="wdp">WDP</option>
                            <option value="status">Status</option>
                        </select>
                        <button id="newEntry" ng-click="showAdd=true">New Site Entry</button>
                    </div>
                </div>
        </header>
        <div class="overlay" ng-show="showAdd">
            <div class="newEntryForm">
                <span class="close-overlay" ng-click="showAdd=false"></span>
                <h3>Add New Project</h3>
                <div class="block">
                    <label>ID</label>
                    <input type="text" id="site_id" class="projectID fix-label" readonly="readonly">
                </div>
                <div class="block">
                    <label>Project Name</label>
                    <input name="site" id="site_name" type="text" class="fix-label">
                </div>
                <div class="block">
                    <label>Status</label>
                    <select name="status" id="site_status">
                        <option value="staged">Staged</option>
                        <option value="dev">In Development</option>
                        <option value="live">Live</option>
                    </select>
                </div>
                <div class="block">
                    <label>Dev URL</label>
                    <input name="url" id="site_url" type="text" class="fix-label" placeholder="http://someguyswebsite.com">
                </div>
                <div class="block">
                    <label>WDP Number</label>
                    <input name="wdp" id="site_wdp" type="text" class="fix-label" placeholder="E.g. 012345">
                </div>
                <div class="block">
                    <button ng-click="showAdd=false;addSite()">Add Project</button>
                </div>
            </div>
        </div>
        <div class="project-item" ng-repeat="item in devsites | filter:query | orderBy:statusOrder">
            <div class="items" ng-hide="deleted">
                <div class="container">
                    <div class="icon-wrapper">
                        <span ng-if="item.status == 'live'"><i class="icon ion-ios-pulse-strong live"></i></span>
                        <span ng-if="item.status == 'dev'"><i class="icon ion-code-working dev"></i></span>
                        <span ng-if="item.status == 'staged'"><i class="icon ion-upload staged"></i></span>
                    </div>
                    <div class="info-wrapper">
                        <div class="group">
                            <h2 class="project-site">{{item.site}}</h2>
                            <h4><a class="urlLink" target="_blank" href="{{item.url}}">Dev Site</a>
                                <span class="seperator">|</span>
                                <a target="_blank" class="urlLink" href="{{item.url}}wp-admin">WP-Admin</a> <span class="seperator">|</span> <a href="#" ng-click="editMode = true;editSite(item)">Edit</a>

                            </div>
                        </div>

                        <h2 class="toRight wdpText"><input type="text" value="WDP-{{item.wdp}}" ng-click="onItemClicked(item)" onclick="this.select();document.execCommand('copy')"></h2>
                        <div ng-show="item.isVisible" class="copiedMessage">Copied to clipboard!</div>

                            <div class="editOverlay" ng-show="editMode" class="cssFade">
            <div class="newEntryForm" >
                <span class="close-overlay" ng-click="editMode=false"></span>
                    <h3>Edit Project</h3>

                    <div class="block">
                        <label>ID</label>
                        <input type="text" class="fix-label" readonly="readonly" value="{{item.id}}">
                    </div>
                    <div class="block">
                        <label>Project Name</label>
                        <input type="text" class="fix-label" ng-model="item.site">
                    </div>

                    <div class="block">
                        <label>Status</label>
                        <select id="" ng-model="item.status">
                            <option value="staged">Staged</option>
                            <option value="dev">In Development</option>
                            <option value="live">Live</option>
                        </select>
                    </div>

                    <div class="block">
                        <label>Dev URL</label>
                        <input type="text" class="fix-label" ng-model="item.url">
                    </div>

                    <div class="block">
                        <label>WDP Number</label>
                        <input type="text" class="fix-label" ng-model="item.wdp">
                    </div>

                    <div class="block">
                        <button class="button-delete" ng-hide="confirm" ng-click="confirm=true">Delete</button>
                        <button class="button-confirm" ng-show="confirm" ng-click="deleteSite(item.id);deleted=true;confirm=false;">Are you sure?</button>
                        <button class="button-save" ng-click="editMode=false;saveField()">Save</button>
                    </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.wrap -->

</body>

</html>
