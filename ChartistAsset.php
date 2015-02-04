<?php
/**
 * @package Okeanos\chartist
 * @author Nikolas Grottendieck <github@nikolasgrottendieck.com>
 * @copyright Copyright &copy; Nikolas Grottendieck
 * @license BSD-3-Clause
 * @version 1.0
 */

namespace Okeanos\chartist;

use yii;
use yii\web\AssetBundle;

/**
 * Asset Manager for Chartist
 *
 * @author Nikolas Grottendieck <github@nikolasgrottendieck.com>
 * @since  1.0
 */
class ChartistAsset extends AssetBundle
{

    public $css = [
        '@bower/dist/chartist.min.css'
    ];

    public $js = [
        '@bower/dist/chartist.min.js'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (YII_ENV_DEV || YII_DEBUG) {
            $this->js = ['@bower/dist/chartist.js'];
        }
    }

}