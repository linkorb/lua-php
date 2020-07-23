<?php

require __DIR__ . '/../vendor/autoload.php';

use LinkORB\Lua\LuaSandbox;

// Instantiate a Lua sandbox
$sandbox = LuaSandbox::build();

// A new sandbox has a completely clean environment
// This means you'll have to register your own functions/callbacks
// to make it useful
$sandbox->registerCallback('print', function($text) {
    echo "PRINT: "  . $text . PHP_EOL;
});

$sandbox->registerCallback('reverse', function($text) {
    return strrev($text);
});

// Let's register some callable Lua chunks:
$code = file_get_contents(__DIR__ . '/example-simple.lua');
$sandbox->registerChunk('example-simple', $code);

$code = file_get_contents(__DIR__ . '/example-advanced.lua');
$sandbox->registerChunk('example-advanced', $code);


// You can now call a chunk (assuming it is a function) with arguments:
$res = $sandbox->callChunk('example-simple', ['hello', 'world']);
echo "RETURN VALUE: " . $res .  PHP_EOL;

// You can also retrieve a chunk by name:
$chunk = $sandbox->getChunk('example-advanced');
print_r($chunk);
$chunk['on_click']('Click test');

// You can retrieve the environment for inspection:
$e = $sandbox->getEnvironment();
print_r($e);

echo "Done\n";
