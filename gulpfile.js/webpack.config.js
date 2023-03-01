const path = require("path");
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
// const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const MinifyPlugin = require('babel-minify-webpack-plugin');

module.exports = {
    // mode: process.env.NODE_ENV || "development",
    mode: "production",
    entry: './src/index.js',
    output: {
        path: path.resolve(__dirname, "./assets"),
        filename: "scripts.js",
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: "babel-loader",
            },
        ],
    },
    devtool: "source-map",
    plugins: [
        new MinifyPlugin({}, {comments: false}),
        // new UglifyJsPlugin({
        //     sourceMap: true,
        //     cache: true,
        //     uglifyOptions: {
        //         warnings: true,
        //         output: {
        //             comments: false,
        //         },
        //     }
        // }),
        // new BundleAnalyzerPlugin()
    ],

};
