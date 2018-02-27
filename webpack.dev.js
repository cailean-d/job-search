const merge = require('webpack-merge');
const path = require('path');
const webpack = require('webpack');
const common = require('./webpack.config.js');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = merge(common, {
    devtool: 'inline-source-map',
    output: {
      filename: 'javascript/[name].bundle.js',
      path: path.resolve(__dirname, 'dev/public')
    },
    watchOptions: {
      aggregateTimeout: 300,
      poll: 1000
    },
    plugins: [
      // new CleanWebpackPlugin(['dev/public/javascript', 'dev/public/stylesheet']),
      new ExtractTextPlugin("stylesheet/[name].bundle.css"),
      new BrowserSyncPlugin({
        open: true,
        host: 'localhost',
        port: 3000,
        files: ['./dev/public/index.php', './dev/app/views/*.php'],
        notify: false,
        proxy: "job:80"
      })
    ],
    module: {
        rules: [
          {
            test: /\.tsx?$/,
            use:  ['babel-loader', 'ts-loader'],
            exclude: /node_modules/
          },
          {
            test: /\.(jsx?)$/,
            use: ['babel-loader'],
            exclude: /node_modules/
          },
          {
            test: /\.scss$/,
            use: ExtractTextPlugin.extract({
              fallback: "style-loader",
              use: [
                {
                    loader: 'css-loader',
                    options: {
                        sourceMap: true
                    }
                },
                {
                    loader: 'sass-loader',
                    options: {
                      sourceMap: true
                    }
                }
            ],
            }),
            exclude: /node_modules/
          },
        ]
    },
});