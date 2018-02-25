const path = require('path');
const webpack = require('webpack');
const merge = require('webpack-merge');
const common = require('./webpack.config.js');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = merge(common, {
    output: {
        filename: 'js/[name].bundle.js',
        path: path.resolve(__dirname, 'prod/public')
    },
    plugins: [
        new CleanWebpackPlugin(['prod']),
        new ExtractTextPlugin("css/[name].bundle.css"),
        new webpack.optimize.AggressiveMergingPlugin(),
        new UglifyJsPlugin({
            sourceMap: false,
            parallel: true,
            uglifyOptions: {
                warnings: false,
                output: {
                    comments: false,
                },
                compress: {
                    drop_console: true,
                }
            }
        }),
        new webpack.DefinePlugin({
            'process.env': {
              'NODE_ENV': JSON.stringify('production')
            }
        }),
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
                        sourceMap: false
                    }
                },
                {
                    loader: 'postcss-loader',
                    options: {
                        plugins: [
                            autoprefixer({
                                browsers:['ie >= 8', 'last 4 version'],
                                cascade: false
                            }),
                            cssnano({
                              preset: 'default',
                            })
                        ],
                        sourceMap: false
                    }
                },
                {
                    loader: 'sass-loader',
                    options: {
                      sourceMap: false
                    }
                }
            ],
            }),
            exclude: /node_modules/
          },
        ]
    },
});