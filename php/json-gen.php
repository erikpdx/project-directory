<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	 <div class="overlay">
            <div class="newEntryForm">
                <span class="close-overlay"></span>
                <h3>Add New Project</h3>
                <div class="block">
                    <label>Project Name</label>
                    <input type="text" class="fix-label" placeholder="Some Guy's Website">
                </div>
                <div class="block">
                    <label>Status</label>
                    <select name="projectStatus" id="">
                        <option value="staged">Staged</option>
                        <option value="dev">In Development</option>
                        <option value="live">Live</option>
                    </select>
                </div>
                <div class="block">
                    <label>Dev URL</label>
                    <input type="text" class="fix-label" placeholder="http://someguyswebsite.com">
                </div>
                <div class="block">
                    <label>WDP Number</label>
                    <input type="text" class="fix-label" placeholder="E.g. 012345">
                </div>
                <div class="block">
                    <button>Add Project</button>
                </div>
            </div>
        </div>
        <script>
     var count = 0;
$.getJSON( "../js/data.json", function( data ) {
  
  $.each( data, function( key, val ) {
    count++;
  });

  var id = count;

        </script>
</body>
</html>

<?php




?>