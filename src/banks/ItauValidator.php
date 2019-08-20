<?php

namespace App\Models;

class ItauValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return  empty($agencyCheckNumber) || $agencyCheckNumber === "";
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == ItauValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return CommonBankAccountValidator::accountCheckNumberIsValid($accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount) {
        return true;
    }

    static function accountCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = ItauCheckNumberCalculator::calculate($bankAccount->agencyNumber, $bankAccount->accountNumber);
        return $checkNumberCalculated === $bankAccount->accountCheckNumber;
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError();
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(ItauValidator::accountNumberLength());
    }

    static function accountNumberLength() {
        return 5;
    }

}
