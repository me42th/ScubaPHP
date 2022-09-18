<?php
$page = ($_GET['page']??'default').'.view';
$content = file_get_contents(VIEW_FOLDER.$page);
echo $content;