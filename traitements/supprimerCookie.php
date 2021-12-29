<?php

if (isset($_COOKIE['accept-cookie']) && isset($_COOKIE['id-token']))
{
    unset($_COOKIE['accept-cookie']);
    setcookie('accept-cookie', null, -1, '/');
    unset($_COOKIE['id-token']);
    setcookie('id-token', null, -1, '/');
    return true;
}
else if (isset($_COOKIE['accept-cookie']))
{
    unset($_COOKIE['accept-cookie']);
    setcookie('accept-cookie', null, -1, '/');
    return true;
}
else if (isset($_COOKIE['id-token']))
{
    unset($_COOKIE['id-token']);
    setcookie('id-token', null, -1, '/');
    return true;
}
else
{
    return false;
}