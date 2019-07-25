<?php

function task1($fileName)
{
    $data = file_get_contents($fileName);

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

        foreach ($addressAttr as $attrKey => $attrVal) {
            $output .= $attrKey . ': ' . $attrVal . '.' . PHP_EOL;
        }

        foreach ($address as $addressKey => $addressVal) {
            $output .= $addressKey . ': ' . $addressVal . '.' . PHP_EOL;
        }

        $output .= PHP_EOL;
    }

    $output .= "Notes: {$orderNotes}" . PHP_EOL . PHP_EOL;

    foreach ($orderList as $order) {
        $orderAttr = $order->attributes();

        $output .= "Product data:" . PHP_EOL . PHP_EOL;

        foreach ($orderAttr as $attrKey => $attrVal) {
            $output .= $attrKey . ': ' . $attrVal . '.' . PHP_EOL;
        }

        foreach ($order as $orderKey => $orderVal) {
            $output .= "{$orderKey}: {$orderVal}." . PHP_EOL;
        }

        $output .= PHP_EOL;
    }

    return $output;
}

function task2($data)
{
    file_put_contents('output.json', json_encode($data));

    $isChange = rand(0, 1);

    if ($isChange) {
        $newCar = [
            'kia' => [
                'year' => 2013
            ]
        ];

        $output = json_decode(file_get_contents('output.json'), true);
        file_put_contents('output2.json', json_encode($output + $newCar));
        $output2 = json_decode(file_get_contents('output2.json'), true);

        return array_diff_assoc($output2, $output);
    }
}

function task3($file)
{
    $arrayNums = [];
    for ($i = 1; $i <= 50; $i++) {
        $arrayNums[$i] = rand(1, 100);
    }

    $csvFile = fopen($file, 'w');
    fputcsv($csvFile, $arrayNums);
    fclose($csvFile);

    $handle = fopen($file, 'r');

    $sumEvanNums = 0;
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        foreach ($data as $number) {
            if ($number % 2 == 0) {
                $sumEvanNums += $number;
            }
        }
    }
    return $sumEvanNums;
}

function task4($url)
{
    $json = json_decode(file_get_contents($url), true);

    $data = $json['query']['pages'][15580374];
    $output = [
        'pageid' => $data['pageid'],
        'title' => $data['title']
    ];

     return $output;
}