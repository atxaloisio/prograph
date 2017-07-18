<?php
$output = shell_exec('artisan schedule:run >> "null" 2>&1');
echo "<p>$output</p>";



