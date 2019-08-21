<?php

namespace BankAccountValidator\src;

class GenericBankAccountValidator
{

    static function bankNumberIsValid($bankNumber)
    {
        return preg_match("/^([0-9A-Za-x]{3,5})$/", $bankNumber);
    }

    static function agencyNumberIsValid($agencyNumber)
    {
        return preg_match("/^[0-9]{1,5}$/", $agencyNumber) && intval($agencyNumber) > 0;
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber)
    {
        return preg_match("/^[a-zA-Z0-9]{0,2}$/", $agencyCheckNumber);
    }

    static function accountNumberIsValid($accountNumber)
    {
        return preg_match("/^[0-9]{1,12}$/", $accountNumber) && intval($accountNumber) > 0;
    }

    static function accountCheckNumberIsValid($accountCheckNumber)
    {
        return preg_match("/^[a-zA-Z0-9]{0,2}$/", $accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount)
    {
        return true;
    }

    static function accountCheckNumberMatch($bankAccount)
    {
        return true;
    }

    static function agencyNumberMsgError($length = null)
    {
        return "Agência inválida";
    }

    static function agencyCheckNumberMsgError()
    {
        return "Dígito da agência inválido";
    }

    static function accountNumberMsgError($length = null)
    {
        return "Conta corrente inválida";
    }
}
