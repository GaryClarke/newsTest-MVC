<?php

namespace OCFram;
session_start();


class User extends ApplicationComponent
{


    public function getAttribute($attr)
    {
        // return the session $attr if set, if not, return null
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function getFlash()
    {
        // store the flash session attribute
        $flash = $_SESSION['flash'];

        // unset the flash session attribute
        unset($_SESSION['flash']);

        // return the val stored in the first step
        return $flash;
    }

    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($attr, $attrVal)
    {
        $_SESSION[$attr] = $attrVal;
    }

    // set $authenticated default to true
    public function setAuthenticated($authenticated = true)
    {
        // check that $authenticated is a bool, if not throw invalid arg exception
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('The value supplied to the User::setAuthenticated
                                                 method must be a boolean');
        }

        // set session auth to $authenticated
        $_SESSION['auth'] = $authenticated;
    }

    public function setFlash($flashVal)
    {
        $_SESSION['flash'] = $flashVal;
    }

}