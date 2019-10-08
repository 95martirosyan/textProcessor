<?php
include 'TextProcessor.php';

$data = [
    "job" => [
        "text" => "Привет, мне на <a href=\"test@test.ru\">test@test.ru</a> пришло приглашение встретиться, попить кофе с <strong>10%</strong> содержанием молока за <i>$5</i>, пойдем вместе!",
        "methods"=> [
            "stripTags",
            "removeSpaces",
            "replaceSpacesToEol",
            "htmlspecialchars",
            "removeSymbols",
            "toNumber"
        ]
    ]
];


$text_processor = new TextProcessor($data);

print_r($text_processor);
