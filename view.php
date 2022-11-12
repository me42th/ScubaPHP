<?php

function renderView(string $template, array $data = [])
{
    require VIEW_FOLDER . $template . '.php';
}
