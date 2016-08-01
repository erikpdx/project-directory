<?php

    $data = file_get_contents("php://input");
    $myfile = fopen("../js/data.json", "w") or die("Unable to open file!");
    fwrite($myfile, $data);
    fclose($myfile);
?>