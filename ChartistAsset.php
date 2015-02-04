<?php
/**
 * @package okeanos\chartist
 * @author Nikolas Grottendieck <github@nikolasgrottendieck.com>
 * @copyright Copyright &copy; Nikolas Grottendieck
 * @license BSD-3-Clause
 * @version 1.0
 */

namespace okeanos\chartist;

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

    public $sourcePath = '@bower/chartist/dist/';

    public $css = [
        'chartist.min.css'
    ];

    public $js = [
        'chartist.min.js'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (YII_ENV_DEV || YII_DEBUG) {
            $this->js = ['chartist.js'];
        }
    }

}