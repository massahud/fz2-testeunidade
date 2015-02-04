module.exports = function (config) {
    config.set({
        basePath: '../',
        files: [
            {pattern: 'public/js/jquery.min.js', watched: false, served: true, included: true},
            {pattern: 'js-test/lib/**/*.js', watched: false, served: true, included: true},
            'public/js/**/*.js',
            'js-test/unit/**/*.js',
            {pattern: 'js-test/fixtures/**/*.html', watched: true, served: true, included: false},
            {pattern: 'js-test/fixtures/**/*.json', watched: true, served: true, included: false},
            {pattern: 'js-test/fixtures/**/*.txt', watched: true, served: true, included: false},

        ],
        autoWatch: true,
        frameworks: ['jasmine'],
        browsers: ['Chrome', 'Firefox'],
        plugins: [
            'karma-chrome-launcher',
            'karma-firefox-launcher',
            'karma-jasmine',
            'karma-junit-reporter'
        ],
        reporters: ['progress','junit'],
        junitReporter: {
            outputFile: 'js-test/test-results.xml',
            suite: '' 
        }

    }); 
};