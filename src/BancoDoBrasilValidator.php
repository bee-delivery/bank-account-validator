<?php

namespace BeeDelivery\BankAccountValidator;

class BancoDoBrasilValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return strlen($agencyCheckNumber) == BancoDoBrasilValidator::agencyCheckNumberLength() && CommonBankAccountValidator::agencyCheckNumberIsValid($agencyCheckNumber);
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == BancoDoBrasilValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return CommonBankAccountValidator::accountCheckNumberIsValid($accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = BancoDoBrasilCheckNumberCalculator::calculateAgency($bankAccount->agencyNumber);
        return $checkNumberCalculated === strtoupper($bankAccount->agencyCheckNumber);
    }

    static function accountCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = BancoDoBrasilCheckNumberCalculator::calculateAccount($bankAccount->accountNumber);
        return $checkNumberCalculated === strtoupper($bankAccount->accountCheckNumber);
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError(BancoDoBrasilValidator::agencyCheckNumberLength());
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(BancoDoBrasilValidator::accountNumberLength());
    }

    static function agencyCheckNumberLength() {
        return 1;
    }

    static function accountNumberLength() {
        return 8;
    }

}
