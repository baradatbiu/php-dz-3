<?php

function task1($fileName)
{
    $data = file_get_contents(__DIR__ . '/' . $fileName);

    $xml = new SimpleXMLIterator($data);

    $addressList = $xml->Address;
    $orderList = $xml->Items->Item;
    $orderAttributes = $xml->attributes();

    $orderNumber = $orderAttributes['PurchaseOrderNumber'];
    $orderDate = $orderAttributes['OrderDate'];
    $orderNotes = $xml->DeliveryNotes;

    $output = "";

    $output .= "Order: {$orderNumber} / {$orderDate}" . PHP_EOL . PHP_EOL;

    $output = outputData($addressList, $output);

    $output .= "Notes: {$orderNotes}" . PHP_EOL . PHP_EOL;

    $output = outputData($orderList, $output);

    return $output;
}

function outputData($array, $output) {
    foreach ($array as $item) {
        $itemAttr = $item->attributes();

        $output .= "Product data:" . PHP_EOL . PHP_EOL;

        foreach ($itemAttr as $key => $val) {
            $output .= "{$key}: {$val}." . PHP_EOL;
        }

        foreach ($item as $key => $val) {
            $output .= "{$key}: {$val}." . PHP_EOL;
        }

        $output .= PHP_EOL;
    }
    return $output;
}
