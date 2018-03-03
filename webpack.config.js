const path = require('path');
const webpack = require('webpack');

module.exports = {
  entry: {
    vacancies: './src/vacancies/script/index.tsx',
    vacancy: './src/vacancy/script/index.tsx',
    ownvacancies: './src/ownvacancies/script/index.tsx'
  },
  plugins: [
    new webpack.NoEmitOnErrorsPlugin(),
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      Tether: 'tether'
    })
  ],
  resolve: {
    extensions: [ '.tsx', '.ts', '.js' ]
  },
  output: {
    filename: 'js/[name].bundle.js',
    path: path.resolve(__dirname, 'public')
  }
};