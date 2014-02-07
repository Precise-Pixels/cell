module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        autoprefixer: {
            single: {
                flatten: true,
                src: 'css/styles.css',
                dest: 'css/styles.css'
            }
        },
        cssmin: {
            minify: {
                src: 'css/styles.css',
                dest: 'build/styles.min.css'
            }
        },
        jshint: {
            all: ['js/*.js'],
            options: {
                camelcase: true,
                curly: true,
                indent: 4,
                noempty: true,
                quotmark: 'single',
                undef: true,
                unused: true,
                trailing: true,
                multistr: true
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/styles.css': 'sass/styles.scss'
                }
            },
            dev: {
                options: {
                    style: 'expanded'
                },
                files: [{
                    expand: true,
                    cwd: 'sass/',
                    src: ['*.scss', '!_*.scss'],
                    dest: 'css/',
                    ext: '.css'
                }]
            }
        },
        uglify: {
            build: {
                src: 'js/*.js',
                dest: 'build/scripts.min.js'
            }
        },
        watch: {
            scripts: {
                files: [
                    'sass/*.scss'
                ],
                tasks: ['sass:dev', 'autoprefixer']
            }
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-autoprefixer');

    // Register tasks
    grunt.registerTask('default', 'List grunt tasks', function() {
        grunt.log.writeln('\n  grunt sass:watch : sass:watch, autoprefix\
                           \n  grunt jshint     : jshint\
                           \n  grunt build      : cssmin, uglify');
    });

    grunt.registerTask('sass:watch', ['watch']);
    grunt.registerTask('build', ['cssmin', 'uglify']);
};