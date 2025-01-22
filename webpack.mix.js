const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/cart.js', 'public/js')
    .js('resources/js/firebase.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .setPublicPath('public');

// يمكنك إضافة المزيد من التكوينات إذا كنت بحاجة.
