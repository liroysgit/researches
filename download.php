<?php
    $file = "research_files/research_file.txt";

    if(!file_exists($file)) die("File not found");

    $type = filetype($file);
    $time = time();

    header("Content-type: $type");
    header("Content-Disposition: attachment;filename=research_file.txt");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');

    set_time_limit(0);
    ob_clean();
    flush();
    readfile($file);

    exit();
