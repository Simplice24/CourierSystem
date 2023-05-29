<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'assets/vendors/mdi/css/materialdesignicons.min.css',
        'assets/vendors/css/vendor.bundle.base.css',
    ];
    public $scss=[
        'src/scss/abstracts/_functions.scss',
        'src/scss/abstracts/_include-media.scss',
        'src/scss/abstracts/_mixins.scss',
        'src/scss/abstracts/_variables.scss',
        'src/scss/base/_base.scss',
        'src/scss/base/_helpers.scss',
        'src/scss/base/_typography.scss',
        'src/scss/components/_buttons.scss',
        'src/scss/components/_forms.scss',
        'src/scss/layout/_cta.scss',
        'src/scss/layout/_features.scss',
        'src/scss/layout/_footer.scss',
        'src/scss/layout/_header.scss',
        'src/scss/layout/_hero.scss',
        'src/scss/layout/_main.scss',
        'src/scss/layout/_pricing.scss',
        'src/scss/_normalize.scss',
        'src/scss/style.scss',
    ];
    public $js = [
        'js/chart.js',
        'js/dashboard.js',
        'js/off-canvas.js',
        'src/js/main.js',
        'dist/js/main.min.js'
    ];
    public $vendors = [
        'chart.js/Chart.min.js',
        'css/vendor.bundle.base.css',
        'js/bootstrap.min.js.map',
        'js/vendor.bundle.base.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
