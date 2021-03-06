<?php

namespace BeeDelivery\BankAccountValidator;

class BancoDoNordesteValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return empty($agencyCheckNumber) || $agencyCheckNumber === "";
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == BancoDoNordesteValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return CommonBankAccountValidator::accountCheckNumberIsValid($accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount) {
        return true;
    }

    static function accountCheckNumberMatch($bankAccount) {
        return true;
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError();
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(BancoDoNordesteValidator::accountNumberLength());
    }

    static function accountNumberLength() {
        return 7;
    }

}
