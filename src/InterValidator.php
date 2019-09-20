<?php

namespace BeeDelivery\BankAccountValidator;

class InterValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return empty($agencyCheckNumber) || $agencyCheckNumber === "";
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == InterValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return CommonBankAccountValidator::accountCheckNumberIsValid($accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount) {
        return empty($agencyCheckNumber) || $agencyCheckNumber === "";
    }

    static function accountCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = InterCheckNumberCalculator::calculateAccount($bankAccount->accountNumber);
        return $checkNumberCalculated === strtoupper($bankAccount->accountCheckNumber);
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError();
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(InterValidator::accountNumberLength());
    }

    static function accountNumberLength() {
        return 7;
    }

}
