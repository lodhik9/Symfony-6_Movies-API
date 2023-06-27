let tailwindcss = require("tailwiindcss")

module.exports = {
  plugins: [
    tailwindcss('./tailwindcss.config.js'),
    require('postcss-import'),
    require('autoprefixer')
  ]
}
