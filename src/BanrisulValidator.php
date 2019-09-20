<?php

namespace BeeDelivery\BankAccountValidator;

class BanrisulValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return strlen($agencyCheckNumber) == self::agencyCheckNumberLength() && CommonBankAccountValidator::agencyCheckNumberIsValid($agencyCheckNumber);
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == BanrisulValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return CommonBankAccountValidator::accountCheckNumberIsValid($accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = BanrisulCheckNumberCalculator::calculateAgency($bankAccount->agencyNumber);
        return $checkNumberCalculated == $bankAccount->agencyCheckNumber;
    }

    static function accountCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = BanrisulCheckNumberCalculator::calculateAccount($bankAccount->accountNumber);
        return $checkNumberCalculated == $bankAccount->accountCheckNumber;
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError();
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(BanrisulValidator::accountNumberLength());
    }

    static function agencyCheckNumberLength() {
        return 2;
    }

    static function accountNumberLength() {
        return 9;
    }

}
