const mix = require('laravel-mix');
const lodash = require("lodash");
const folder = {
    src: "resources/", // source files
    dist: "public/", // build files
    dist_assets: "public/assets/" //build assets files
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

var third_party_assets = {
    css_js: [
        {"name": "jquery", "assets": ["./node_modules/jquery/dist/jquery.min.js"]},
        {"name": "bootstrap", "assets": ["./node_modules/bootstrap/dist/js/bootstrap.bundle.js"]},
        {"name": "metismenu", "assets": ["./node_modules/metismenu/dist/metisMenu.js"]},
        {"name": "simplebar", "assets": ["./node_modules/simplebar/dist/simplebar.js"]},
        {"name": "node-waves", "assets": ["./node_modules/node-waves/dist/waves.js"]},
        {"name": "waypoints", "assets": ["./node_modules/waypoints/lib/jquery.waypoints.min.js"]},
        {"name": "jquery-counterup", "assets": ["./node_modules/jquery.counterup/jquery.counterup.min.js"]},
        {"name": "magnific-popup", "assets": ["./node_modules/magnific-popup/dist/jquery.magnific-popup.min.js", "./node_modules/magnific-popup/dist/magnific-popup.css"]},
        {"name": "select2", "assets": ["./node_modules/select2/dist/js/select2.min.js", "./node_modules/select2/dist/css/select2.min.css"]},
        {"name": "sweetalert2", "assets": ["./node_modules/sweetalert2/dist/sweetalert2.min.js", "./node_modules/sweetalert2/dist/sweetalert2.min.css"]},
        {"name": "chart-js", "assets": ["./node_modules/chart.js/dist/Chart.bundle.min.js"]},
        {
            "name": "datatables", "assets": ["./node_modules/datatables.net/js/jquery.dataTables.min.js",
                "./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js",
                "./node_modules/datatables.net-responsive/js/dataTables.responsive.min.js",
                "./node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js",
                "./node_modules/datatables.net-buttons/js/dataTables.buttons.min.js",
                "./node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.html5.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.flash.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.print.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.colVis.min.js",
                "./node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js",
                "./node_modules/datatables.net-select/js/dataTables.select.min.js",
                "./node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css",
                "./node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css",
                "./node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css",
                "./node_modules/datatables.net-select-bs4/css/select.bootstrap4.css"]
        },
        {"name": "pdfmake", "assets": ["./node_modules/pdfmake/build/pdfmake.min.js", "./node_modules/pdfmake/build/vfs_fonts.js"]},
        {"name": "jszip", "assets": ["./node_modules/jszip/dist/jszip.min.js"]}
        // {"name": "summernote", "assets": ["./node_modules/summernote/dist/summernote-bs4.min.js", "./node_modules/summernote/dist/summernote-bs4.css"]},

    ]
};

//copying third party assets
lodash(third_party_assets).forEach(function (assets, type) {
    if (type == "css_js") {
        lodash(assets).forEach(function (plugin) {
            var name = plugin['name'],
                assetlist = plugin['assets'],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset) {
                var ass = asset.split(',');
                for (let i = 0; i < ass.length; ++i) {
                    if(ass[i].substr(ass[i].length - 3)  == ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                };
            });
            if(js.length > 0){
                mix.combine(js, folder.dist_assets + "/libs/" + name + "/" + name + ".min.js");
            }
            if(css.length > 0){
                mix.combine(css, folder.dist_assets + "/libs/" + name + "/" + name + ".min.css");
            }
        });
    }
});

// mix.copyDirectory("./node_modules/leaflet/dist/images", folder.dist_assets + "/libs/leaflet/images");
// mix.copyDirectory("./node_modules/summernote/dist/font", folder.dist_assets + "/libs/summernote/font");

// copy all fonts
var out = folder.dist + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

// copy all images
var out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images", out);

mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
mix.sass('resources/scss/bootstrap-dark.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap-dark.css");
mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/icons.css");
mix.sass('resources/scss/app-rtl.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app-rtl.css");
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app.css");
mix.sass('resources/scss/app-dark.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app-dark.css");

//copying demo pages related assets
var app_pages_assets = {
    js: [
        folder.src + "js/pages/datatables.init.js",
        folder.src + "js/pages/datatables.faculty.index.js",
        folder.src + "js/pages/delete.faculty.index.js",
        folder.src + "js/pages/sweetalert.index.js",
        folder.src + "js/pages/datatables.programmes.index.js",
        folder.src + "js/pages/delete.programme.index.js",
        folder.src + "js/pages/datatables.academic-years.index.js",
        folder.src + "js/pages/delete.academic-year.index.js",
        folder.src + "js/pages/datatables.application.registrations.index.js",
        folder.src + "js/pages/delete.application.registrations.index.js",
        folder.src + "js/pages/datatables.students.all.index.js",
        folder.src + "js/pages/datatables.students.pending.index.js",
        folder.src + "js/pages/datatables.students.list.index.js",
        folder.src + "js/pages/lightbox.init.js",
        folder.src + "js/pages/action.enroll.index.js",
        folder.src + "js/pages/chartjs.init.js",
    ]
};

var out = folder.dist_assets + "js/";
lodash(app_pages_assets).forEach(function (assets, type) {
    for (let i = 0; i < assets.length; ++i) {
        mix.js(assets[i], out + "pages");
    };
});

mix.combine('resources/js/app.js', folder.dist_assets + "js/app.min.js");
