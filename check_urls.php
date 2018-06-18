<?php declare(strict_types = 1)?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VALIDATE URLs</title>
</head>
<body>
    <?php
        // This page validates a list of URLs. It uses the fsockopen() function and parse_url() function to do so


        // This function will try to connect to a URL:

        function check_url(string $url){
            // Break the url down into its parts:
            $url_pieces = parse_url($url);

            // Set the $path and $port:
            $path = (isset($url_pieces['path'])) ? $url_pieces['path'] : '/';
            $port = (isset($url_pieces['port'])) ? $url_pieces['port'] : 80;

            // Connect using fsockopen:
            
        }
    ?>
</body>
</html>