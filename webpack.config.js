const path = require('path');
const webpack = require('webpack');

module.exports = {
  entry: {
    vacancies: './src/first/js/testjsx.tsx'
  },
  plugins: [
    new webpack.NoEmitOnErrorsPlugin(),
  ],
  resolve: {
    extensions: [ '.tsx', '.ts', '.js' ]
  },
  output: {
    filename: '[name].bundle.js',
    path: path.resolve(__dirname, 'dist')
  }
};