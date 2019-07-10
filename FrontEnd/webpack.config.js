const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const webpack = require('webpack');

const jsEntryPath = path.resolve(__dirname, 'src', 'index.js');
const htmlEntryPath = path.resolve(__dirname, 'src', 'index.html');
const buildPath = path.resolve(__dirname, 'dist', 'index.js');

module.exports = {
    mode: 'development',
    entry: {
        app: './src/index.js'
        // jsEntryPath,
        // htmlEntryPath
    },
    output: {
        filename: 'js/app.js',
        path: path.resolve(__dirname, 'dist')
    },

    devtool: 'inline-source-map',

    resolve: {
        extensions: ['.js', '.jsx']
    },
    module: {

        rules: [
            {
                test: /\.jsx?$/,
                loader: 'babel-loader'
            },
            // {
            //     test: /\.html$/,
            //     loader: 'file?name=[name].[ext]'
            // }
        ]
    },

    devServer: {
        port: 8000,
        host: '0.0.0.0',
        watchOptions: {
            aggregateTimeout: 500,
            poll: true
        },
        historyApiFallback: true,
        contentBase: path.join(__dirname, 'dist'),
        inline: true,
        hot: true,
        noInfo: false,
        public: ''
        // writeToDisk: true
    },
    plugins: [
        // new CleanWebpackPlugin(),
        new HtmlWebpackPlugin({
            title: 'Task-Manager',
            template: './src/index.html'
        }),
        new webpack.HotModuleReplacementPlugin()
    ],

    // Global variables
    externals: {
    //     // global app config object
        config: JSON.stringify({
            apiUrl: 'http://localhost'
        })
    }
};