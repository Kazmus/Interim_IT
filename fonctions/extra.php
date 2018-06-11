<?php
function getVarName(&$var)
{
    $ret = '';
    $tmp = $var;
    $var = md5(uniqid(rand(), TRUE));

    $key = array_keys($GLOBALS);
    foreach ( $key as $k )
        if ( $GLOBALS[$k] === $var )
        {
            $ret = $k;
            break;
        }

        $var = $tmp;
        return $ret;
}
?>