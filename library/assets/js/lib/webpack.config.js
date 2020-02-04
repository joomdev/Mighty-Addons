// var webpack = require("webpack");

module.exports = {
  entry : "./app.js",
  mode: 'development',
  output : {
    filename: "main.js",
    path: __dirname + '/build'
  },
  module:{
    rules: [
        {
          exclude: /node_modules/,
          loader: 'babel-loader',
          options: {
            presets: [
              '@babel/preset-env',
              '@babel/react',{'plugins': ['@babel/plugin-proposal-class-properties']}
            ]
          }
        },
        {
          test:/\.css$/,
          use:['style-loader','css-loader']
        }
    ]
  }
};
