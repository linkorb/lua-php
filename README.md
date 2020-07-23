Lua PHP
=======

This library enables you to add Lua scripting support to your PHP applications.

## LuaSandbox

The LuaSandbox class allows you to easily run user-supplied Lua scripts in an empty sandbox environment.
This means that dangerous functions (i.e. for file and network IO) are unavailable by default.
To make the sandbox useful, you register your own PHP-implemented functions that you allow the chunks to execute.

## Use-cases

* Support user-supplied scripts to respond to events in your application
* Advanced expressions, filters, segments
* Customizable routing
* ... and many more :)

## Usage

Check the `example/` directory for a well-documented example.

## About Lua

* Website: http://www.lua.org/
* Wikipedia: https://en.wikipedia.org/wiki/Lua_(programming_language)

## Requirements

This library requires that the [PHP Lua extension](https://www.php.net/manual/en/book.lua.php) is installed.

A quick install guide for Ubuntu:

```sh
# Install lua library
apt-get install -y --no-install-recommends lua5.3 liblua5.3-dev
# pecl expects liblua and includes in specific locations, so move them around a bit:
cp /usr/lib/x86_64-linux-gnu/liblua5.3.a /usr/lib/liblua.a
cp /usr/lib/x86_64-linux-gnu/liblua5.3.so /usr/lib/liblua.so
ln -s /usr/include/lua5.3 /usr/include/lua
# Install the lua extension through pecl
pecl install lua
# Activate the lua extension in your PHP config
php --ini # find out where your PHP config files are located
echo "extension=lua.so" > /path/to/my/php/conf.d/lua.ini
```

## License

MIT. Please refer to the [license file](LICENSE) for details.

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
