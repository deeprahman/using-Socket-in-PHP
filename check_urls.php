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
            if($fp = fsockopen($url_pieces['host'], $port, $errno, $errstr, 30)){

                // Send some data
                $send = "HEAD $path HTTP/1.1\r\n";
                $send .= "HOST:{$url_pieces['host']}\r\n";
                $send .= "CONNECTION: close\r\n\r\n";
                fwrite($fp,$send);
                // Read the response
                $data = fgets($fp,128);

                // Close the connection
                fclose($fp);

                // Return the response code
                list($response, $code) = explode(' ',$data);

                if ($code == 200) {
                    return array($code, 'good');
                }else{
                    return array($code, 'bad');
                }
            }else{ // No connection, return the error message:
                return array($errstr, 'bad');
            }
        } // End of chk_url function

        // Create the list of URLs:
        $urls = array(
            'http://www.larryullman.com/',
            'http://www.larryullman.com/wp-admin/',
            'http://www.yiiframework.com/tutorials/'
        );

        // Print the header
        echo "<h2>Validating URLs</h2>";

        // Kill the PHP time limit
        set_time_limit(0);

        foreach($urls as $url){
            list($code, $class) = check_url($url);
            echo "<p><a href=\"$url\" target=\"_new\">$url</a>(<span class=\"$class\">$code</span>)</p>\n";
        }
    ?>
</body>
</html>