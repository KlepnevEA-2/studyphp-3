<?php


function task1()
{
    $file = file_get_contents('data.xml');
    $xml = new SimpleXMLElement($file);

    foreach ($xml->Address as $item) {
        echo 'Address <br />';
        echo 'Name: ' . $item->Name . '<br />';
        echo 'Street: ' . $item->Street . '<br />';
        echo 'City: ' . $item->City . '<br />';
        echo 'Zip: ' . $item->Zip . '<br />';
        echo 'Country: ' . $item->Country . '<br />';
        echo '<br />';
    }

    foreach ($xml->Items->Item as $item) {
        echo 'Item <br />';
        echo 'ProductName: ' . $item->ProductName . '<br />';
        echo 'Quantity: ' . $item->Quantity . '<br />';
        echo 'USPrice: ' . $item->USPrice . '<br />';
        echo 'Comment: ' . $item->Comment . '<br />';
        echo '<br />';
    }
}

function task2()
{

    $array = [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => 4,
        'e' => 5,
    ];

    $encodedArr = json_encode($array, JSON_UNESCAPED_UNICODE);
    file_put_contents('output.json', $encodedArr);

    function comparison($arr1, $arr2)
    {
        $jsonArr1 = (array)(json_decode(file_get_contents($arr1)));
        $jsonArr2 = (array)(json_decode(file_get_contents($arr2)));
        $diff = array_diff($jsonArr1, $jsonArr2);
        echo 'вот тут произошли изменения в массиве - ';
        print_r($diff);
    }

    function mix()
    {
        $file1 = 'output.json';
        $file2 = 'output2.json';
        $decoded = (array)(json_decode(file_get_contents($file1)));
        $decoded['b'] = '200';
        file_put_contents($file2, json_encode($decoded, JSON_UNESCAPED_UNICODE));
        comparison($file1, $file2);
    }

    $flag = rand(0, 1);
    if ($flag) {
        mix();
    } else {
        echo 'изменений в массиве не было';
    }
}


function task3($num)
{
    function writeCsv($num)
    {
        $array = ['a' => []];
        for ($i = 0; $i < $num; $i++) {
            array_push($array['a'], rand(1, 100));
        }
        $fp = fopen('task3.csv', 'w');

        foreach ($array as $fields) {
            fputcsv($fp, $fields);
        };
        fclose($fp);
        readCsv();
    }

    function readCsv()
    {
        $csvPath = './task3.csv';
        $csvFile = fopen($csvPath, "r");
        if ($csvFile) {
            $res = [];
            while (($csvData = fgetcsv($csvFile)) !== false) {
                $res[] = $csvData;
            }
        }
        fclose($csvFile);
        countCsv($res);
    }

    function countCsv($res) {
        $result = 0;
        for ($i= 0; $i< count($res[0]); $i++) {

            if($res[0][$i]%2 == 0) {
                $result += $res[0][$i];
            }
        };
        echo "Сумма всех четных чисел массива равна: $result";
    };
    writeCsv($num);
}


function task4() {
    $data = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');
    $decoded = json_decode($data, true);
    echo $decoded[query][pages][15580374][title];
    echo '<br>';
    echo $decoded[query][pages][15580374][ pageid];
}