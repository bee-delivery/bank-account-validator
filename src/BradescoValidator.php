<?php

namespace BankAccountValidator\src;

class BradescoValidator
{

    static function agencyNumberIsValid($agencyNumber) {
        return CommonBankAccountValidator::agencyNumberIsValid($agencyNumber);
    }

    static function agencyCheckNumberIsValid($agencyCheckNumber) {
        return strlen($agencyCheckNumber) == BradescoValidator::agencyCheckNumberLength() && CommonBankAccountValidator::agencyCheckNumberIsValid($agencyCheckNumber);
    }

    static function accountNumberIsValid($accountNumber) {
        return strlen($accountNumber) == BradescoValidator::accountNumberLength() && CommonBankAccountValidator::accountNumberIsValid($accountNumber);
    }

    static function accountCheckNumberIsValid($accountCheckNumber) {
        return CommonBankAccountValidator::accountCheckNumberIsValid($accountCheckNumber);
    }

    static function agencyCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = BradescoCheckNumberCalculator::calculateAgency($bankAccount->agencyNumber);
        $checkNumberInformed = strtoupper($bankAccount->agencyCheckNumber);

        if ($checkNumberInformed === "0") {
            return $checkNumberCalculated === $checkNumberInformed || $checkNumberCalculated === "P";
        }
        return $checkNumberCalculated === $checkNumberInformed;
    }

    static function accountCheckNumberMatch($bankAccount) {
        $checkNumberCalculated = BradescoCheckNumberCalculator::calculateAccount($bankAccount->accountNumber);
        $checkNumberInformed = strtoupper($bankAccount->accountCheckNumber);
        if ($checkNumberInformed === "0") {
            return $checkNumberCalculated === $checkNumberInformed || $checkNumberCalculated === "P";
        }
        return $checkNumberCalculated === $checkNumberInformed;
    }

    static function agencyNumberMsgError() {
        return CommonBankAccountValidator::agencyNumberMsgError();
    }

    static function agencyCheckNumberMsgError() {
        return CommonBankAccountValidator::agencyCheckNumberMsgError(BradescoValidator::agencyCheckNumberLength());
    }

    static function accountNumberMsgError() {
        return CommonBankAccountValidator::accountNumberMsgError(BradescoValidator::accountNumberLength());
    }

    static function agencyCheckNumberLength() {
        return 1;
    }

    static function accountNumberLength() {
        return 7;
    }

}
