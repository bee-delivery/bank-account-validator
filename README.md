# Bank Account Validator

A bank account validator for brazilian bank accounts.

## Getting started

Bank account validation is performed under the rules of the following banks: Itaú, Bradesco, Banco do Brasil, Santander, Citibank and HSBC. For other banks a default validation is performed:

* Agency from 1 to 5 numbers.
* 0-2 character agency digit.
* Account from 1 to 12 numbers.
* 0-2 character account digit.

The agency and account number of banks Itaú, Bradesco, and Banco do Brasil are validated by calculating the check digit (similar to CPF validation).


## Installing
Install with [composer](https://getcomposer.org/):

```bash
composer require bee-delivery/bank-account-validator
```

## Usage

The bank details received via the form must be passed as a parameter to the function called 'validate'.
If it was found errors, they will be returned within an array.

```php
<?php

    //..

    $params = (object) array(
        'bankNumber' => $this->bank,
        'agencyNumber' => $this->agency_number,
        'agencyCheckNumber' => $this->agency_check_number,
        'accountNumber' => $this->account_number,
        'accountCheckNumber' => $this->account_check_number
    );

    $errors = BankAccount::validate($params);

    // ..
```

## Bank Codes


A listing of all banks you can get at http://www.codigobanco.com.

## License

GNU General Public License v3
