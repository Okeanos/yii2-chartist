yii2-chartist
=============
A Yii2 extension for [chartist.js](http://gionkunz.github.io/chartist-js/index.html).

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

```php
use okeanos\chartist\Chartist;

echo Chartist::widget([
	'tagName' => 'div', // HTML-container for the chart, optional parameter
	'data' => [
		'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		'series' => [ 
			[5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
            [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
        ]
	],
	'chartOptions' => [
		'options' => [
			'seriesBarDistance' => 15
		],
		'responsiveOptions' => [
			[	'screen and (min-width: 641px) and (max-width: 1024px)',
				[
					'seriesBarDistance' => 10,
					'axisX' => [
						'labelInterpolationFnc' => new JsExpression('function (value) { return value; }'),
					]
				]
			],
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
		'useClass' => 'chartist-chart' // optional parameter, needs to be included in the htmlOptions class string as well if set!
	],
	'htmlOptions' => [
		'class' => 'chartist-chart ct-chart ct-golden-section', // ct-chart for CSS references; size of the charting area needs to be assigned as well
		// ...
	]
]);
```

## License

**yii2-chartist** is released under the BSD 3-Clause License. See the bundled `LICENSE` for details.