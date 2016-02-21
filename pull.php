<?php
$output = shell_exec('sudo git pull origin master');
echo "<pre>$output</pre>";
?>