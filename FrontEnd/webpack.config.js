const { WebpackPluginServe: Serve } = require('webpack-plugin-serve');
const path = require('path');
const options = {
    host: '127.0.0.1',
    port: '7000',
    static: {
        glob: [path.join(__dirname, '/build')],
        options: { onlyDirectories: true }
    }
};
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CleanWebpackPlugin = require('clean-webpack-plugin');

const devMode = process.env.NODE_ENV !== 'production';

module.exports = {
    entry: [
        './src/js/index.js',
        './src/sass/app.scss',
        'webpack-plugin-serve/client'
    ],
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: 'js/main.js'
    },
    devtool: 'source-map',
    module: {
        rules: [{
            test: /\.jsx?$/,
            loader: 'babel-loader',
            exclude: [/node_modules/]
        },
        {
            test: /\.scss$/,
            use: [
                devMode ? 'style-loader' : MiniCssExtractPlugin.loader,
                {
                    loader: 'css-loader'
                },

                {
                    loader: 'sass-loader'
                }
            ]}
        ]
    },
    plugins: [
        new CleanWebpackPlugin(['build/*','public/js']),
        new MiniCssExtractPlugin({filename: "css/[name].css"}),
        new Serve(options),
    ],
    watch: true
};