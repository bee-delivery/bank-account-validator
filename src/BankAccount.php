<?php

namespace BankAccountValidator\src;

class BankAccount
{

    private static function validator($bankNumber) {

        $validators = array(
            "001" => BancoDoBrasilValidator::class,
            "237" => BradescoValidator::class,
            "341" => ItauValidator::class,
            "033" => SantanderValidator::class,
            "745" => CitibankValidator::class,
            "399" => HSBCValidator::class,
            "041" => BanrisulValidator::class
        );

        if (isset($validators[$bankNumber])) {
            return $validators[$bankNumber];
        } else {
            return GenericBankAccountValidator::class;
        }
    }

    public static function validate($params){

        $errors = array();
        $validator = BankAccount::validator($params->bankNumber);

        if (!GenericBankAccountValidator::bankNumberIsValid($params->bankNumber)) {
            array_push($errors, (object) array('description' => "Banco inválido", 'code' => "INVALID_BANK_NUMBER"));
        }

        if (!$validator::agencyNumberIsValid($params->agencyNumber)) {
            array_push($errors, (object) array('description' => $validator::agencyNumberMsgError(), 'code' => "INVALID_AGENCY_NUMBER"));
        }

        if (!$validator::agencyCheckNumberIsValid($params->agencyCheckNumber)) {
            array_push($errors, (object) array('description' => $validator::agencyCheckNumberMsgError(), 'code' => "INVALID_AGENCY_CHECK_NUMBER"));
        }

        if (!$validator::accountNumberIsValid($params->accountNumber)) {
            array_push($errors, (object) array('description' => $validator::accountNumberMsgError(), 'code' => "INVALID_ACCOUNT_NUMBER"));
        }

        if (!$validator::accountCheckNumberIsValid($params->accountCheckNumber)) {
            array_push($errors, (object) array('description' => "Dígito da conta corrente inválido", 'code' => "INVALID_ACCOUNT_CHECK_NUMBER"));
        }

        if ($validator::agencyNumberIsValid($params->agencyNumber) && $validator::agencyCheckNumberIsValid($params->agencyCheckNumber)) {
            if(!$validator::agencyCheckNumberMatch($params)) {
                array_push($errors, (object) array('description' => "Dígito da agência não corresponde ao número da agência preenchido", 'code' => "AGENCY_CHECK_NUMBER_DONT_MATCH"));
            }
        }

        if ($validator::accountNumberIsValid($params->accountNumber) && $validator::accountCheckNumberIsValid($params->accountCheckNumber)) {
            if(!$validator::accountCheckNumberMatch($params)) {
                array_push($errors, (object) array('description' => "Dígito da conta não corresponde ao número da conta/agência preenchido", 'code' => "ACCOUNT_CHECK_NUMBER_DONT_MATCH"));
            }
        }

        return $errors;
    }
}
