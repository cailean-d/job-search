const merge = require('webpack-merge');
const webpack = require('webpack');
const common = require('./webpack.config.js');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = merge(common, {
    devtool: 'inline-source-map',
    output: {
      filename: 'javascript/[name].bundle.js',
      path: path.resolve(__dirname, 'public')
    },
    watchOptions: {
      aggregateTimeout: 300,
      poll: 1000
    },
    plugins: [
      new CleanWebpackPlugin(['public/javascript', 'public/stylesheet']),
      new ExtractTextPlugin("stylesheet/[name].bundle.css"),
      new BrowserSyncPlugin({
        host: 'localhost',
        port: 3000,
		    notify: false,
        files: ['./index.html'],
        server: {
          baseDir: "./",
          index: "index.html"
        }
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