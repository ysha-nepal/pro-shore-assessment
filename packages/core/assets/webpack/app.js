module.exports = run
function run(mix,glob){
    const commonJs = glob.sync('packages/**/assets/common/js/app.js',{});
    const adminJs = glob.sync('packages/**/assets/admin/js/app.js',{});
    const resourceAdminJs = glob.sync('resources/assets/admin/js/app.js',{});

    mix.js(commonJs.concat(adminJs).concat(resourceAdminJs),'public/js/admin/app.min.js')

    const websiteJs = glob.sync('packages/**/assets/website/js/app.js',{});
    const resourceWebsiteJs = glob.sync('resources/assets/website/js/app.js',{});

    mix.js(commonJs.concat(websiteJs).concat(resourceWebsiteJs),'public/js/website/app.min.js');

    const commonCss = glob.sync('packages/**/assets/common/css/*',{});

    const adminCss = glob.sync('packages/**/assets/admin/css/*',{});
    const resourceAdminCss = glob.sync('resources/assets/admin/css/*',{});

    mix.combine(commonCss.concat(adminCss).concat(resourceAdminCss),'public/css/admin/app.min.css')

    const websiteCss = glob.sync('packages/**/assets/website/css/*',{});
    const resourceWebsiteCss = glob.sync('resources/assets/website/css/*',{});

    mix.combine(commonCss.concat(websiteCss).concat(resourceWebsiteCss),'public/css/website/app.min.css')

    mix.copy('packages/core/assets/common/fonts','public/css/fonts');
    mix.copy('packages/core/assets/common/flags','public/css/flags');
    mix.copy('packages/core/assets/ckeditor','public/js/ckeditor');
    mix.copy('packages/**/assets/website/images/*','public/images/');
}
run.run = run
