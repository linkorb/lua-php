local sandbox_env = {
  -- start with an empty environment
}

-- array of registered chunks
local chunks = {}

function registerChunk(chunk_name, code)
  local chunk, message = load(code, 'sandbox:' .. chunk_name, 't', sandbox_env)
  if not chunk then
    error("Failed to register chunk: " .. chunk_name)
  end
  chunks[chunk_name] = chunk()
end

-- promote an item in the global _ENV to the sandbox env
function registerCallback(name)
  sandbox_env[name] = _ENV[name]
end

-- call a chunk by name as a function with parameters
function callChunk(chunk_name, ...)
  local chunk = getChunk(chunk_name)
  local status, res = pcall(chunk, ...)
  if (not status) then
    error(res)
  end
  return res
end

-- retrieve a chunk by name
function getChunk(chunk_name)
  local chunk = chunks[chunk_name]
  if (not chunk) then
    error("Getting unregistered chunk: " .. chunk_name)
  end
  return chunk
end

-- retrieve the sandbox environment for inspection
function getEnvironment()
  return sandbox_env
end
