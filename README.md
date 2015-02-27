yii2-chartist
=============
A Yii2 extension for [Chartist.js](http://gionkunz.github.io/chartist-js/index.html).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require --prefer-dist okeanos/yii2-chartist "*"
```

 or
```
 "okeanos/yii2-chartist": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

You can use the ```htmlOptions``` to manually set an ID and subsequently used that to refer to the specific Chartist.js instance. Check the examples in `examples.php` to see how the [Chartist.js examples](http://gionkunz.github.io/chartist-js/examples.html) work with this extension.

### Source

```php
<?php
use okeanos\chartist\Chartist;
use yii\helpers\Json;
use yii\web\JsExpression;
?>
<?= Chartist::widget([
	'tagName' => 'div',
	'data' => new JsExpression(Json::encode([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
            'series' => [
                [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
            ]
        ])),
	'chartOptions' => [
		'options' => [
			'seriesBarDistance' => 15
		],
		'responsiveOptions' => [
			[	'screen and (max-width: 640px)',
				[
					'seriesBarDistance' => 5,
					'axisX' => [
						'labelInterpolationFnc' => new JsExpression('function (value) { return value[0]; }'),
					]
				]
			]			
		]
	],
	'widgetOptions' => [
		'type' => 'Bar', // Bar, Line, or Pie, i.e. the chart types supported by Chartist.js
		'useClass' => 'chartist-chart' // optional parameter, needs to be included in the htmlOptions class string as well if set! Forces the widget to use this class name as reference point for Chartist.js instead of an id
	],
	'htmlOptions' => [
		'class' => 'chartist-chart ct-chart ct-golden-section', // ct-chart for CSS references; size of the charting area needs to be assigned as well
		//...
	]
]); ?>
```

### Output

```html
<div id="w0" class="ct-chart ct-golden-section"><!-- <svg /> --></div>
<!-- ... -->
<script type="text/javascript">jQuery(document).ready(function () {
var w0 = new Chartist.Bar("#w0",
	{
		"labels": ["Jan","Feb","Mar","Apr","Mai","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
		"series": [[5,4,3,7,5,10,3,4,8,10,6,8],[3,2,9,5,4,6,4,6,7,8,7,4]]
	},
	{
		"seriesBarDistance":15
	},
	[
		[
			"screen and (max-width: 640px)",
			{
				"seriesBarDistance":5,
				"axisX": {
					"labelInterpolationFnc": function (value) { return value[0]; }
				}
			}
		]
	]);
});
</script>
```

## Liense

**yii2-chartist** is released under the BSD 3-Clause License. See the bundled `LICENSE` for details.
