<?php
$page = ($_GET['page']??'login').'.view';
$content = file_get_contents(VIEW_FOLDER.$page);
echo $content;