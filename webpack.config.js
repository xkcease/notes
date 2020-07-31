const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const webpack = require('webpack');


module.exports = {
    mode: 'development',
    entry: {
        login: './src/login.js',
        register: './src/pages/register/register.js',
        retrieve: './src/pages/retrieve/retrieve.js',
        board: './src/pages/board/board.js',
        take: './src/pages/take/take.js',
        look: './src/pages/look/look.js',
    },
    output:{
        filename: '[name].js',
        path: path.resolve(__dirname, 'dist'),
    },
    module: {
        rules: [
            {
                test: /\.vue$/, 
                use: 'vue-loader'
            },
            {
                test: /\.css$/, 
                use: [
                    {loader: 'style-loader'},
                    {loader: 'css-loader'}
                ]
            },
            {
                test: /\.(eot|woff|woff2|ttf|png|jpg|gif|svg)$/,
                use: {
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        publicPath: '/notes/dist'
                    }
                }
            },
        ],
    },
    plugins: [
        new VueLoaderPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'windows.jQuery': 'jquery'
        }),
    ],
    devtool: 'inline-source-map',
    devServer: {
        inline: true,
        port: 8083,
        openPage: './src/login.html',
        //contentBase: 'dist',
        hot: true,
        proxy: {
            '/api': {
                target: 'http://localhost:8083',
                changeOrigin: true,
                secure: false,
                // pathRewrite: {
                //     '^/api': '/'
                // }
            },
            
        }
    },
};

