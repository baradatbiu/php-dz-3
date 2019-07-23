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

    foreach ($addressList as $address) {
        $addressAttr = $address->attributes();

        $output .= "Address data:" . PHP_EOL . PHP_EOL;
        $output .= "Type: {$addressAttr['Type']}." . PHP_EOL;

        foreach ($address as $addressKey => $addressVal) {
            $output .= $addressKey . ': ' . $addressVal . '. ' . PHP_EOL;
        }

        $output .= PHP_EOL;
    }

    $output .= "Notes: {$orderNotes}" . PHP_EOL . PHP_EOL;

    foreach ($orderList as $order) {
        $orderAttr = $order->attributes();

        $output .= "Product data:" . PHP_EOL . PHP_EOL;
        $output .= "Part number: {$orderAttr['PartNumber']}." . PHP_EOL;

        foreach ($order as $orderKey => $orderVal) {
            $output .= "{$orderKey}: {$orderVal}." . PHP_EOL;
        }

        $output .= PHP_EOL;
    }
    return $output;
}
