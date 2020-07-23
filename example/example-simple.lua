-- This is an example lua file to load into the sandbox

return function(foo, bar)
    print(reverse(foo) .. ", " .. bar)
    -- local f = io.open('/etc/hostname', "rb")
    -- local content = f:read "*a"
    -- print(content)
    return "This is returned from Lua"
end
