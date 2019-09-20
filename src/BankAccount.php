<?php

namespace BeeDelivery\BankAccountValidator;

class BankAccount
{

    private static function validator($bankNumber) {

        $validators = array(
            "001" => BancoDoBrasilValidator::class,         // Banco do Brasil
            "004" => BancoDoNordesteValidator::class,       // Banco do Nordeste
            "033" => SantanderValidator::class,             // Santander
            "041" => BanrisulValidator::class,              // Banrisul
            "077" => InterValidator::class,                 // Inter
            "104" => CaixaEconomicaFederalValidator::class, // Caixa Econômica Federal
            "212" => OriginalValidator::class,              // Original
            "237" => BradescoValidator::class,              // Bradesco | Next
            "260" => NubankValidator::class,                // Nubank
            "341" => ItauValidator::class,                  // Itaú
            "399" => HSBCValidator::class,                  // HSBC
            "745" => CitibankValidator::class               // Citibank
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

        // fill with zeros
        for($i = strlen($params->accountNumber); $i < $validator::accountNumberLength(); $i++)
            $params->accountNumber = "0" . $params->accountNumber;

        for($i = strlen($params->agencyNumber); $i < 4; $i++)
            $params->agencyNumber = "0" . $params->agencyNumber;
        // end fill

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

        return array('errors' => $errors, 'params' => $params);
    }
}
