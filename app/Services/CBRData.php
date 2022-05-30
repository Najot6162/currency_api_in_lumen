<?php

namespace App\Services;

use DOMDocument;
use Illuminate\Support\Str;

class CBRData
{
    protected $data = [];
    public function load($date = null)
    {
        $url = "http://www.cbr.ru/scripts/XML_daily.asp";
        if ($date) {
            $dateStr = strtotime($date);
            $url = $url . "?data_req=" . date('d/m/Y', $dateStr);
        }

        $xml = new DOMDocument();
        if ($xml->load($url)) {
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');
            foreach ($items as $item) {
                $code = $item->getelementsByTagName('CharCode')->item(0)->nodeValue;
                $digitalCode = $item->getelementsByTagName('NumCode')->item(0)->nodeValue;
                $name = $item->getelementsByTagName('Name')->item(0)->nodeValue;
                $curs = $item->getelementsByTagName('Value')->item(0)->nodeValue;

                echo "$code -   ";
                $this->data[$code] = [
                    'alphabetic_code' => $code,
                    'digit_code' => $digitalCode,
                    'name' => $name,
                    'rate' => $curs,
                    'english_name'=>Str::slug($name)
                ];
            }
            return true;
        }
        return false;
    }
    public function getCurrencyAll(){
        return $this->data;
    }

    public function getCurrency($cur){
        return isset($this->data[$cur])?$this->data[$cur]:[];
    }
}
