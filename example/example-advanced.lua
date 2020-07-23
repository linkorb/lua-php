local function on_click(data)
  -- error("BWAM")
  print("On click!!")
end

return {
  name = "My advanced chunk",
  description = "This is an example structure",
  on_click = on_click,
  on_exit = function(data)
    print("I'll be back")
  end,
}
