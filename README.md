# Bank Account Validator

A bank account validator for brazilian bank accounts.

## Getting started

Bank account validation is performed under the verifying digit rules of the following banks: 

BANK                        AG - DV | AC - DV | TYPE AC          | OBS
001 Banco do Brasil		    4  -  1 | 8  -  1 |	                 |   
004 Banco do Nordeste	    4  		| 7  -  1 | 2 (not included) | not checking DVs	
033 Banco Santander		    4  		| 8  -  1 | 2 (added to AC)	 |		
041 Banrisul			    4  -  2 | 9  -  1 | 2 (added to AC)	 |		
077 Banco Inter			    4       | 7  -  1 |	                 |
104 Caixa Econômica Federal	4  	    | 11 -  1 | 3 (added to AC)	 |
237 Banco Bradesco		    4  -  1 | 7  -  1 |                  |
237 Next bank			    4  		| 7  -  1 |                  | same thing as Bradesco
260 Nubank			        4  		| 7  -  1 |                  |
341 Banco Itaú			    4  		| 5  -  1 |                  |
399 HSBC			        4  		| 6  -  1 |                  |               
745 Citibank			    4  		| 10 -  1 |                  |               

For other banks a default validation is performed:

* Agency from 1 to 4 numbers.
* 0-2 character agency digit.
* Account from 1 to 12 numbers.
* 0-2 character account digit.

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

    use BeeDelivery\BankAccountValidator\BankAccount;
    
    // ..

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

Feel free to help us. Make a pr :)

GNU General Public License v3
