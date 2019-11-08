<?php

namespace BeeDelivery\BankAccountValidator;

class CommonBankAccountValidator
{

    static function agencyNumberIsValid($agencyNumber)
    {
        return preg_match("/^(?!0000)([0-9]{4})$/", $agencyNumber);
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
        return preg_match("/^[a-zA-Z0-9]{1}$/", $accountCheckNumber);
    }

    static function agencyNumberMsgError($length = null)
    {
        if (empty($length)) {
            $length = CommonBankAccountValidator::agencyNumberLength();
        }

        return "A agência deve conter " . $length . " números.";
    }

    static function agencyCheckNumberMsgError($length = null)
    {
        if (empty($length) || $length === 0) {
            return "O dígito da agência deve ser vazio";
        } else if ($length === 1) {
            return "O dígito da agência deve conter 1 dígito";
        } else {
            return "O dígito da agência deve conter " . $length . " números.";
        }
    }

    static function accountNumberMsgError($length)
    {
        return "A conta corrente deve conter " . $length . " números.";
    }

    static function agencyNumberLength()
    {
        return 4;
    }
}
