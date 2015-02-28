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
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Base Widget for Chartist
 *
 * @author Nikolas Grottendieck <github@nikolasgrottendieck.com>
 * @since  1.0
 */
class Chartist extends Widget
{
    /**
     * @var array Chartist options, split into [['options' => [], 'responsiveOptions' => []], each section will be JSON encoded and used as parameter for the Chart accordingly
     * @see http://gionkunz.github.io/chartist-js/api-documentation.html
     */
    public $chartOptions = [];

    /**
     * @var array Data to be rendered as a chart, the data has to be JSON encoded according to the Chartist documentation before it is passed into the widget
     */
    public $data = '';

    /**
     * @var array HTML attributes or other settings for widget container
     */
    public $htmlOptions = [];

    /**
     * @var string The name of the container element that contains the chart. Defaults to 'div'.
     */
    public $tagName = 'div';

    /**
     * @var array The widget options: type of chart ; whether to force an identifier different than the HTML-id, e.g. in case you want to use a class instead; ['type' => '','useClass' => '']
     */
    public $widgetOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        // checks for the element id
        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->getId();
        }
        // checks if ct-chart is part of the classes
        if(!isset($this->htmlOptions['class']) || false === strpos($this->htmlOptions['class'], 'ct-chart')) {
            $this->htmlOptions['class'] .= 'ct-chart';
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerChart();
        echo Html::tag($this->tagName, '', $this->htmlOptions);
    }

    /**
     * Create the chart, register the JS, etc.
     */
    protected function registerChart()
    {
        ChartistAsset::register($this->view);

        // Select the identifier for this chart
        $identifier = '"' . (isset($this->widgetOptions['useClass']) && is_string($this->widgetOptions['useClass']) ? '.' . $this->widgetOptions['useClass'] : '#' . $this->htmlOptions['id']) . '"';
        // Set empty options and afterwards override if actual settings have been passed as arguments
        $options = Json::encode([]);
        if (isset($this->chartOptions['options']) && !empty($this->chartOptions['options'])) {
            // Check whether a reference to a JS variable has been passed instead of actual options as array
            switch (is_string($this->chartOptions['options'])) {
                case true:
                    $options = $this->chartOptions['options'];
                    break;
                case false:
                    $options = Json::encode($this->chartOptions['options']);
                    break;
            }
        }
        // Set empty options and afterwards override if actual settings have been passed as arguments
        $responsiveOptions = Json::encode([]);
        if (isset($this->chartOptions['responsiveOptions']) && !empty($this->chartOptions['responsiveOptions'])) {
            // Check whether a reference to a JS variable has been passed instead of actual options as array
            switch (is_string($this->chartOptions['responsiveOptions'])) {
                case true:
                    $responsiveOptions = $this->chartOptions['responsiveOptions'];
                    break;
                case false:
                    $responsiveOptions = Json::encode($this->chartOptions['responsiveOptions']);
                    break;
            }
        }

        $this->view->registerJs('var ' . $this->htmlOptions['id'] . ' = new Chartist.' . $this->widgetOptions['type'] . '(' . implode(', ',
                [$identifier, $this->data, $options, $responsiveOptions]) . ');',
            View::POS_READY);
    }
}