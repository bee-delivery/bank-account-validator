<?php

namespace BeeDelivery\BankAccountValidator;

class HSBCValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return  empty($agencyCheckNumber) || $agencyCheckNumber === "";
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == HSBCValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return true;
    }

    static function agencyCheckNumberMatch($bankAccount) {
        return true;
    }

    static function accountCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = HSBCCheckNumberCalculator::calculate($bankAccount->accountNumber, $bankAccount->agencyNumber);
        $checkNumberInformed = strtoupper($bankAccount->accountCheckNumber);

        return $checkNumberCalculated === $checkNumberInformed;
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError();
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(HSBCValidator::accountNumberLength());
    }

    static function accountNumberLength() {
        return 6;
    }

}
