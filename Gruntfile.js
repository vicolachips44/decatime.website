module.exports = function(grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    banner: '',
    cssmin: {
      options: {
        report: 'min',
        root: 'public',
        target: 'public',
        banner: ''
      },
      build: {
        files: {
          'public/_static/style.min.css': [
            'public/vendor/bootstrap/dist/css/bootstrap.css',
            'public/vendor/bootstrap/dist/css/bootstrap-theme.css',
            'public/vendor/font-awesome/css/font-awesome.css',
            'public/css/bootstrap-override.css',
            'public/css/main.css'
          ]
        }
      }
    },
    requirejs: {
      compile: {
        options: {
          baseUrl: 'public/js',
          mainConfigFile: 'public/js/require_config.js',
          out: 'public/_static/app.min.js',
          preserveLicenseComments: false,
          include: ['../vendor/requirejs/require', 'require_config.js']
        }
      }
    },
    copy: {
      main: {
        files: [{
          expand: true,
          flatten: true,
          src: ['public/vendor/bootstrap/dist/fonts/*', 'public/vendor/font-awesome/fonts/*'],
          dest: 'public/fonts'
        }]
      }
    },
    watch: {
      options: {
        livereload: true
      },
      scripts: {
        files: [
          'src/Org/Decatime/views/**',
          'public/js/**',
          'public/css/**'
        ]
      }
    }
  });

  grunt.registerTask('default', ['requirejs', 'cssmin', 'copy']);
};
