'use strict'

const path = require('path')
const autoprefixer = require('autoprefixer')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const miniCssExtractPlugin = require('mini-css-extract-plugin')
const { PurgeCSSPlugin } = require("purgecss-webpack-plugin");
const glob = require('glob-all')

module.exports = {
    mode: 'development',
    entry: './src/js/main.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist')
    },
    devServer: {
        static: path.resolve(__dirname, 'dist'),
        port: 8080,
        hot: true
    },
    plugins: [
        //new HtmlWebpackPlugin({ template: '.' }),
        new miniCssExtractPlugin(),
        new PurgeCSSPlugin({
            paths: glob.sync([
                `${path.join(__dirname, 'Templates')}/**/*`,
                `${path.join(__dirname, 'Services')}/**/*`,
                `${path.join(__dirname, 'views')}/**/*`,
                `${path.join(__dirname, 'header.php')}`,
                `${path.join(__dirname, 'archive.php')}`,
                `${path.join(__dirname, 'index.php')}`,
                `${path.join(__dirname, 'singular.php')}`,
                `${path.join(__dirname, 'footer.php')}`,
            ],  { nodir: true }),
        }),
    ],
    module: {
        rules: [
            {
                test: /\.(scss)$/,
                use: [
                    {
                        // Adds CSS to the DOM by injecting a `<style>` tag
                        loader: miniCssExtractPlugin.loader
                    },
                    {
                        // Interprets `@import` and `url()` like `import/require()` and will resolve them
                        loader: 'css-loader'
                    },
                    {
                        // Loader for webpack to process CSS with PostCSS
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: [
                                    autoprefixer
                                ]
                            }
                        }
                    },
                    {
                        // Loads a SASS/SCSS file and compiles it to CSS
                        loader: 'sass-loader'
                    }
                ]
            }
        ]
    }
}
