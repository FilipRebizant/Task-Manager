const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const webpack = require('webpack');

module.exports = {
    mode: 'development',
    entry: { app: './src/index.js'},

    devtool: 'inline-source-map',

    resolve: {
        extensions: ['.js', '.jsx']
    },
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                loader: 'babel-loader'
            }
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
        contentBase: ['./dist'],
        inline: true,
        hot: true,
        writeToDisk: true
    },
    plugins: [
        // new CleanWebpackPlugin(),
        new HtmlWebpackPlugin({
            title: 'Task-Manager',
            template: './src/index.html'
        }),
        new webpack.HotModuleReplacementPlugin()
    ],
    externals: {
    //     // global app config object
        config: JSON.stringify({
            apiUrl: 'http://localhost'
        })
    },

    output: {
        filename: 'public/bundle.js',
        path: path.resolve(__dirname, 'dist')
    }
}