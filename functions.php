<?php
function get_checked($field_name)
{
    global $blog_category;
    if (in_array($field_name, $blog_category)) {
        echo 'checked';
    }
}