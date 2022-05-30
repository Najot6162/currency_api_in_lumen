<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class CurrencyController extends Controller
{
        public function index(){
            $objCurrencies = new Currency();

            return $objCurrencies->all();
        }

    public function show(int $id){
        $objCurrency = new Currency();
        $currency = $objCurrency->find($id);
        if (!$currency){
            return abort(404,'error');
        }
        return $currency;
    }

}
