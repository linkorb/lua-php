<?php

namespace LinkORB\Lua;

use Lua;

class LuaSandbox
{

    protected $lua;

    public static function build()
    {
        $lua = new Lua();
        $sandbox = new self($lua);
        return $sandbox;
    }

    protected function error(string $message)
    {
        throw new LuaException($message);
    }

    public function __construct(Lua $lua)
    {
        $this->lua = $lua;

        $this->lua->registerCallback("error", function($message) {
            $this->error($message);
        });

        $this->lua->registerCallback("cool", function($message) {
            echo "COOL: $message\n";
        });

        $this->lua->registerCallback("print", function($message, $a = null, $b = null, $c = null) {
            echo "PRINT: $message $a $b $c\n";
        });

        $sandboxCode = file_get_contents(__DIR__ . '/../lua/sandbox.lua');
        $this->lua->eval($sandboxCode);
    }

    public function registerChunk(string $name, string $code): void
    {
        $res = $this->lua->call("registerChunk", array($name, $code));
        if ($res) {
            throw new LuaException("Failed to register chunk " . $name);
        }
    }

    public function registerCallback(string $name, callable $cb)
    {
        $this->lua->registerCallback($name, $cb);
        $res = $this->lua->call("registerCallback", array($name));
    }


    public function getChunk(string $name)
    {
        $res = $this->lua->call("getChunk", array($name));
        return $res;
    }


    public function callChunk(string $name, $arguments)
    {
        array_unshift($arguments, $name);
        $res = $this->lua->call("callChunk", $arguments);
        return $res;
    }

    public function getEnvironment()
    {
        $res = $this->lua->call("getEnvironment", []);
        return $res;
    }



// $x = $lua->call("getChunk", array('demo-advanced'));
// if (!$x) {
//     echo "PHP: That failed\n";
// }
// print_r($x);
// $f = $x['onFrame'];
// try {
//     $f('ahaha');
// } catch (\Exception $e) {
//     print_r($e);
// }
// $f = ($x['onTerminate'] ?? null);
// $f("bye", "x");

// echo "Done\n";

//     }

}
