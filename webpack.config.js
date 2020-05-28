/**
 *   Webpack v4
 1. npm --version
 2. npm init -y
 3. npm install webpack webpack-cli --save-dev
 4. npm install babel-core babel-loader babel-preset-env --save-dev
 5. nano .babelrc
 {
     "presets": [
        "env"
      ]
 }
 6. npm install extract-text-webpack-plugin@next --save-dev
 7. npm install style-loader css-loader --save-dev
 8. npm install node-sass sass-loader --save-dev
 9. npm install postcss-loader autoprefixer --save-dev
 10. npm install resolve-url-loader --save-dev
 11. npm install file-loader --save-dev
 12. npm install assets-webpack-plugin --save-dev
 13. npm install webpack-dev-server --save-dev
 *
 */
const THEME_NAME = 'Yana';


let entries = {
    index: './index.js',
    questionPage: './questionPage.js',
    course: './course.js',
    test: './test.js',
    experts: './experts.js',
    account: './account.js',
    page404: './page404.js',
    signIn: './signIn.js',
};

let pugs = {
    index: {
        title: "index title"
    },
    questionPage: {
        questionPage: "questionPage title"
    },
    course: {
        course: "course title"
    },
    test: {
        test: "test title"
    },
    experts: {
        experts: "experts title"
    },
    account: {
        account: "account title"
    },
    page404: {
        page404: "page404 title"
    },
    signIn: {
        signIn: "signIn title"
    },

};

const NODE_ENV = process.env.NODE_ENV;
const DEV_MODE = NODE_ENV == 0;
// const WP = (NODE_ENV == 2)? true : false;
const WP = NODE_ENV === "wp-production";
if (!WP) {

    // entries['masha'] = './masha.js';
    // entries['index'] = './index.js';
    //
    // pugs['masha'] = {
    //     title: "masha title"
    // };
    // pugs['index'] = {
    //     title: "test title"
    // };
}


const HtmlWebpackPlugin = require('html-webpack-plugin');
const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const AssetsPlugin = require('assets-webpack-plugin');
const autoprefixer = require('autoprefixer');
const rimraf = require('rimraf');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
    context: path.resolve(__dirname, 'assets/templates'),
    entry: entries,

    output: {
        path: path.resolve(__dirname, 'src'),
        publicPath: '/src/',
        filename: 'js/[name]' + (DEV_MODE ? '.js' : '.min.js'),
        chunkFilename: 'js/[name]' + (DEV_MODE ? '.js' : '.min.js'),
        library: '[name]',
    },
    optimization: {
        runtimeChunk: {name: 'common'},
        splitChunks: {
            cacheGroups: {
                default: false,
                commons: {
                    test: /\.(js|scss)$/,
                    chunks: 'all',
                    minChunks: 2,
                    name: 'common',
                    enforce: true,
                },
            },
        },
    },
    devtool: DEV_MODE ? 'source-map' : false,
    devServer: {
        overlay: {
            warnings: true,
            errors: true
        }
    },
    module: {
        rules: [
            {
                test: /\.pug$/,
                loader: 'pug-loader',
                options: {
                    pretty: true
                }
            },
            {
                test: /\.js$/,
                exclude: /node_modules\/(?!(dom7|ssr-window|swiper)\/).*/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['@babel/preset-env'],
                        plugins: [
                            '@babel/plugin-proposal-object-rest-spread',
                            '@babel/plugin-transform-arrow-functions']
                    }
                }
            }, {
                test: /\.css$/,
                use: [
                    {
                        loader: 'style-loader'
                    }, {
                        loader: 'css-loader',
                        options: {
                            minimize: true
                        }
                    }, {
                        loader: 'postcss-loader',
                        options: {
                            plugins: [
                                autoprefixer({
                                    browsers: ['ie >= 10', 'last 3 version']
                                })
                            ],
                            sourceMap: true
                        }
                    }, {
                        loader: 'resolve-url-loader'
                    }
                ]
            }, {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract(
                    {
                        fallback: 'style-loader',
                        use: [
                            {
                                loader: 'css-loader',
                                options: {
                                    minimize: !DEV_MODE,
                                }
                            }, {
                                loader: 'postcss-loader',
                                options: {
                                    plugins: [
                                        autoprefixer({
                                            browsers: ['ie >= 10', 'last 3 version']
                                        })
                                    ],
                                    sourceMap: true
                                }
                            }, {
                                loader: 'resolve-url-loader'
                            }, {
                                loader: 'sass-loader',
                                options: {
                                    sourceMap: true
                                }
                            }
                        ]
                    })
            },
            // Image Loader
            {
                test: /\.(jpg|png|svg|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: './icons/',
                            name: '[name].[ext]',
                            publicPath: WP ? `/wp-content/themes/${THEME_NAME}/src/icons/` : '/src/icons/'

                        }
                    }
                ]
            },
            // Font Loader
            {
                test: /\.(eot|ttf|woff|woff2)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: './fonts/',
                            name: '[name].[ext]',
                            publicPath: WP ? `/wp-content/themes/${THEME_NAME}/src/fonts/` : '/src/fonts/'
                        }
                    }
                ]
            },
            // Font Loader
            {
                test: /\.(mp4)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: './video/',
                            name: '[name].[ext]',
                            publicPath: WP ? `/wp-content/themes/${THEME_NAME}/src/video/` : '/src/video/'
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        {
            apply: (compiler) => {
                if (!DEV_MODE) {
                    rimraf.sync(compiler.options.output.path);
                }
            }
        },
        new ExtractTextPlugin({
            filename: 'css/[name]' + (DEV_MODE ? '.css' : '.min.css'),
            disable: false,
            allChunks: true
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
        new BrowserSyncPlugin(
            // BrowserSync options
            {
                // browse to http://localhost:3000/ during development
                host: 'localhost',
                port: 3000,
                // proxy the Webpack Dev Server endpoint
                // (which should be serving on http://localhost:3100/)
                // through BrowserSync
                proxy: 'http://localhost:8080/'
            },
            // plugin options
            {
                // prevent BrowserSync from reloading the page
                // and let Webpack Dev Server take care of this
                reload: false
            }
        )
    ]
};

if (WP) {
    module.exports.plugins.push(
        new AssetsPlugin({
            filename: 'assets.json',
            path: path.resolve(__dirname, 'src')
        })
    );
}

initHtmlPugs();

function initHtmlPugs() {

    for (let page in pugs) {
        module.exports.plugins.push(new HtmlWebpackPlugin({
            title: pugs[page].title,
            filename: `${page}.html`,
            chunks: [page, 'common'],
            template: path.resolve(__dirname, 'assets/templates') + `/${page}.pug`,
        }));
    }
}