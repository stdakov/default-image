<?php
function dd($val, $color = false)
{
    $call_info = current(debug_backtrace());
    $code_line = $call_info['line'];
    $parsedPath = explode('/', $call_info['file']);
    $file = array_pop($parsedPath);

    $file_array = file($call_info['file']);
    $colored = highlight_string('<?php' . trim($file_array[$code_line - 1]) . '?>', true);
    $colored = str_replace(array("&lt;?php", "?&gt;"), array("", ""), $colored);

    echo '<br /><b>' . $file . ' : ' . $code_line . ' :</b>' . $colored . '<br />';

    if ($color) {
        $ret = highlight_string('<?php' . var_export($val, true) . '?>', true);
        echo '<pre>';
        echo str_replace(array("&lt;?php", "?&gt;"), array("", ""), $ret);
        echo '</pre>';
    } else if (is_array($val) || is_object($val)) {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    } else {
        var_dump($val);
    }
}


function showImageImg($img)
{
    echo '<img src="/' . $img . '" />';
}

function showImage($image)
{
    header("Access-Control-Allow-Origin: *");
    header('Content-type: image/jpeg');
    readfile($image);

}