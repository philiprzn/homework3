<?php


// ////////////// Задание №1:

function task1($file) {



    $purchaseOrder = simplexml_load_file($file);

    if ($purchaseOrder === false) {
        die();
    }

//    print_r($purchaseOrder);

    echo "<table border='1' cellpadding='6' rules='groups' style='border-collapse: collapse'>
            <tbody><tr><th>Order №</th><td>{$purchaseOrder['PurchaseOrderNumber']}</td></tr><tr><th>Order Date</th><td>{$purchaseOrder['OrderDate']}</td></tr></tbody>";
    foreach ($purchaseOrder as $key => $value) {

        echo "<tbody><tr><th align='left '> {$value['Type']} $key</th><td>$value</td></tr>";

        if(is_object($value)) {

            foreach($value as $innerKey => $innerVal) {
                if ($innerKey === 'Item') {
                    echo "<tr><th align='right'>$innerKey {$innerVal['PartNumber']}</td><th>$innerVal</td></tr>";
                } else {
                    echo "<tr><td align='right'>$innerKey {$innerVal['PartNumber']}</td><td>$innerVal</td></tr>";
                }
                if(is_object($innerVal)) {
                    foreach ($innerVal as $itemKey => $itemVal) {
                        echo "<tr><td align='right'>$itemKey</td><td>$itemVal</td></tr>";
                    }
                }
            };
            echo "</tbody>";

        }

    };
    echo "</table>";
};


// ////////////// Задание №2:

function changeArray($arr) {
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            $arr[$key] = changeArray($value);
        } else {
            $arr[$key] = rand(0,1) ? $value : $value .' '. $value;
        }
    }
    return $arr;
}

function changeJsonRandomly($file, $newFile) {
    file_put_contents($newFile,
        json_encode(
            changeArray(
                json_decode(
                    file_get_contents($file), $assoc = true)
            )));

}

function compareArrays($a, $b) {

    $diff = array_diff_assoc($b, $a);

    foreach ($a as $key => $value) {
        if ( is_array($a[$key]) && is_array($b[$key]) ) {
            if ( $res = compareArrays($a[$key], $b[$key]) ) {
                $diff[$key] = $res;
            }
        }
    }

    return $diff;
}

function compareJson($fileA, $fileB) {
    $a = json_decode(file_get_contents($fileA), $assoc = true);
    $b = json_decode(file_get_contents($fileB), $assoc = true);

    return compareArrays($a, $b);
}

// ////////////// Задание №3:


function csvCreateFile($arr) {
    $fp = fopen('file.csv', 'w');
    fputcsv($fp, $arr);
    fclose($fp);
}

function cvsFileEvenSum($filename) {
    $fp = fopen($filename, 'r');
    $arr = fgetcsv($fp);
    fclose($fp);

    return array_sum(array_filter($arr, function($item){
        return $item % 2 == 0;
    }));
}


// ////////////// Задание №4:


function curlShow() {

    $url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $res=curl_exec($ch);
    curl_close($ch);

    $json = json_decode($res, $assoc = true);
    $pages = $json['query']['pages'];
    foreach ($pages as $page=>$value) {
        echo "Page id = {$value['pageid']}, title = {$value['title']}";
    };
}