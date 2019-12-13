<?php

function currencysign($amount)
{
    $num_format = config('pms.currency.sign').number_format($amount, 2);
    return $num_format;
}

function currencycode($amount)
{
    $num_format = number_format($amount, 2)." ".config('pms.currency.code');
    return $num_format;
}

function label_status($str)
{
    if ($str == 'Active') {
        $color = 'label-success';
    } elseif ($str == 'Pre-Terminated') {
        $color = 'label-warning';
    } elseif ($str == 'Terminated') {
        $color = 'label-danger';
    }
    return $color;
}

function Ymd($str)
{
    $Ymd_format = date('Y-m-d', strtotime($str));
    return $Ymd_format;
}

function md($str)
{
    $md_format = date('m-d', strtotime($str));
    return $md_format;
}

function MdY($str)
{
    $MdY_format = date('M d, Y', strtotime($str));
    return $MdY_format;
}

function FdY($str)
{
    $FdY_format = date('F d, Y', strtotime($str));
    return $FdY_format;
}

function MY($str)
{
    $MY_format = date('MY', strtotime($str));
    return $MY_format;
}

function FY($str)
{
    $FY_format = date('F Y', strtotime($str));
    return $FY_format;
}

function mdY_bslash($str)
{
    $MdY_format = date('m/d/Y', strtotime($str));
    return $MdY_format;
}

function dMY($str)
{
    $dMY_format = date('d-M-Y', strtotime($str));
    return $dMY_format;
}
