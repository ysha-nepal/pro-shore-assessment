
const mix = require("laravel-mix");
const glob = require("glob");
const commands = require("./packages/core/assets/webpack/app.js")
commands.run(mix,glob);
