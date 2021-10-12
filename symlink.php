<?php
$target = '/home/public_html/aplikasiep3/storage/app/public';
   $shortcut = '/home/public_html/aplikasiep3/public/storage';
   symlink($target, $shortcut);
echo 'Symlink process successfully completed';
?>