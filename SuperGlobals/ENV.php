<?php
// PC User
echo 'The username is: ' .$_ENV["USER"] . '!';

// get Enviroument Info
getenv("REMOTE_ADDR"); //fetch the current user's IP address
putenv("tmp=usr"); //set the user's value for environment variable
getenv("tmp");

?>