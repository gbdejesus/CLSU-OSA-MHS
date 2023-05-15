const path = require('path');

module.exports = {
    output: {
        filename: 'my-first-webpack.bundle.js',
    },
    module: {
        loaders: [{ test: /\.txt$/, use: 'raw-loader' }],
    },
};
