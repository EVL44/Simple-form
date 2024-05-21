<?php
function cleanData($str)
{
    return filter_var($str, FILTER_SANITIZE_STRING);
}

function validateData($str, $data)
{
    if (empty($str)) {
        return "$data n'existe pas";
    }
    if (!preg_match('/^[a-zA-Z\-]+$/', $str)) {
        return "$data est invalide";
    }
    return true;
}


function verifGenre($val)
{
    if ($val === 'male' || $val === 'female') {
        return true;
    }
    return "genre is invalid!!";
}

function validateDateOfBirth($str)
{
    if (empty($str)) {
        return 'La date de naissance n\'existe pas';
    }
    if (!preg_match('/^\d{2}-\d{2}-\d{4}$/', $str)) {
        return 'La date de naissance est invalide';
    }
    return true;
}

function verifNumber($str, $data)
{
    $cleaned = filter_var($str, FILTER_VALIDATE_INT);
    if ($cleaned === false) {
        return "$data n'est pas valide";
    }
    return true;
}

function validateEmail($str)
{
    $cleaned = cleanData($str);
    if (empty($cleaned)) {
        return 'L\'email n\'existe pas';
    }
    $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    if (!preg_match($pattern, $cleaned)) {
        return 'L\'email n\'est pas valide';
    }
    return true;
}

function validateTelephone($str)
{
    $cleaned = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
    if (strlen($cleaned) !== 10) {
        return 'Le numéro de téléphone doit contenir 10 chiffres';
    }
    return true;
}

function verifAge($date)
{
    $diff = date_diff(date_create($date), date_create());

    if ($diff->y > 12) {
        return true;
    }

    return "you must be older than 12!!!";
}
