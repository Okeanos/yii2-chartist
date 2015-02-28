<?php
use okeanos\chartist\Chartist;
use View;
use yii\helpers\Json;
use yii\web\JsExpression;

/* @var $this View */
$this->title = 'Examples';
?>
    <h1>Line Chart Examples</h1>
    <h2>Simple Line Chart</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        'series' => [
            [12, 9, 7, 8, 5],
            [2, 1, 3.5, 7, 3],
            [1, 3, 4, 5, 6]
        ]
    ])),
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Line Scatter Diagram With Responsive Settings</h2>
<?php $this->registerJs('var times = function(n) {
  return Array.apply(null, new Array(n));
};

var lineScatterData = times(52).map(Math.random).reduce(function(data, rnd, index) {
  data.labels.push(index + 1);
  data.series.forEach(function(series) {
    series.push(Math.random() * 100)
  });

  return data;
}, {
  labels: [],
  series: times(4).map(function() { return new Array() })
});

var lineScatterOptions = {
  showLine: false,
  axisX: {
    labelInterpolationFnc: function(value, index) {
      return index % 13 === 0 ? \'W\' + value : null;
    }
  }
};

var lineScatterResponsive = [
  [\'screen and (min-width: 640px)\', {
    axisX: {
      labelInterpolationFnc: function(value, index) {
        return index % 4 === 0 ? \'W\' + value : null;
      }
    }
  }]
];', View::POS_READY); ?>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => 'lineScatterData',
    'chartOptions' => [
        'options' => 'lineScatterOptions',
        'responsiveOptions' => 'lineScatterResponsive',
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Line Chart With Tooltips</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['1', '2', '3', '4', '5', '6'],
        'series' => [
            [
                'name' => 'Fibonacci sequence',
                'data' => [1, 2, 3, 5, 8, 13]
            ],
            [
                'name' => 'Golden section',
                'data' => [1, 1.618, 2.618, 4.236, 6.854, 11.09]
            ]
        ]
    ])),
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistLineTooltip',
    ]
]);
?>
<?php $this->registerJs('var $chart = $(\'#chartistLineTooltip\');
var $toolTip = $chart.append(\'<div class="tooltip"></div>\').find(\'.tooltip\').hide();

$chart.on(\'mouseenter\', \'.ct-point\', function() {
  var $point = $(this),
    value = $point.attr(\'ct:value\'),
    seriesName = $point.parent().attr(\'ct:series-name\');
  $toolTip.html(seriesName + \'<br>\' + value).show();
});

$chart.on(\'mouseleave\', \'.ct-point\', function() {
  $toolTip.hide();
});

$chart.on(\'mousemove\', function(event) {
  $toolTip.css({
    left: (event.offsetX || event.originalEvent.layerX) - $toolTip.width() / 2 - 10,
    top: (event.offsetY || event.originalEvent.layerY) - $toolTip.height() - 40
  });
});', View::POS_READY); ?>
    <h2>Line Chart With Area</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
        'series' => [
            [5, 9, 7, 8, 5, 3, 5, 4]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'low' => 0,
            'showArea' => true
        ]
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Bi-Polar Line Chart With Area Only</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
        'series' => [
            [1, 2, 3, 1, -2, 0, 1, 0],
            [-2, -1, -2, -1, -2.5, -1, -2, -1],
            [0, 0, 0, 1, 2, 2.5, 2, 1],
            [2.5, 2, 1, 0.5, 1, 0.5, -1, -2.5]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'high' => 3,
            'low' => -3,
            'showArea' => true,
            'showLine' => false,
            'showPoint' => false,
            'fullWidth' => true,
            'axisX' => [
                'showLabel' => false,
                'showGrid' => false
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Using Events To Replace Graphics</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['1', '2', '3', '4', '5'],
        'series' => [
            [12, 9, 7, 8, 5]
        ]
    ])),
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistLineEvents',
    ]
]);
?>
<?php $this->registerJs('// Listening for draw events that get emitted by the Chartist chart
chartistLineEvents.on(\'draw\', function(data) {
  // If the draw event was triggered from drawing a point on the line chart
  if(data.type === \'point\') {
    // We are creating a new path SVG element that draws a triangle around the point coordinates
    var triangle = new Chartist.Svg(\'path\', {
      d: [\'M\',
        data.x,
        data.y - 15,
        \'L\',
        data.x - 15,
        data.y + 8,
        \'L\',
        data.x + 15,
        data.y + 8,
        \'z\'].join(\' \'),
      style: \'fill-opacity: 1\'
    }, \'ct-area\');

    // With data.element we get the Chartist SVG wrapper and we can replace the original point drawn by Chartist with our newly created triangle
    data.element.replace(triangle);
  }
});', View::POS_READY); ?>
    <h2>Advanced SMIL Animations</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        'series' => [
            [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
            [4, 5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
            [5, 3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
            [3, 4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'low' => 0,
        ]
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistLineSMILE',
    ]
]);
?>
<?php $this->registerJs('// Let\'s put a sequence number aside so we can use it in the event callbacks
var seq = 0,
  delays = 80,
  durations = 500;

// Once the chart is fully created we reset the sequence
chartistLineSMILE.on(\'created\', function() {
    seq = 0;
});

// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
chartistLineSMILE.on(\'draw\', function(data) {
    seq++;

    if(data.type === \'line\') {
        // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
        data.element.animate({
      opacity: {
            // The delay when we like to start the animation
            begin: seq * delays + 1000,
        // Duration of the animation
        dur: durations,
        // The value where the animation should start
        from: 0,
        // The value where it should end
        to: 1
      }
    });
  } else if(data.type === \'label\' && data.axis === \'x\') {
        data.element.animate({
      y: {
            begin: seq * delays,
        dur: durations,
        from: data.y + 100,
        to: data.y,
        // We can specify an easing function from Chartist.Svg.Easing
        easing: \'easeOutQuart\'
      }
    });
  } else if(data.type === \'label\' && data.axis === \'y\') {
        data.element.animate({
      x: {
            begin: seq * delays,
        dur: durations,
        from: data.x - 100,
        to: data.x,
        easing: \'easeOutQuart\'
      }
    });
  } else if(data.type === \'point\') {
        data.element.animate({
      x1: {
            begin: seq * delays,
        dur: durations,
        from: data.x - 10,
        to: data.x,
        easing: \'easeOutQuart\'
      },
      x2: {
            begin: seq * delays,
        dur: durations,
        from: data.x - 10,
        to: data.x,
        easing: \'easeOutQuart\'
      },
      opacity: {
            begin: seq * delays,
        dur: durations,
        from: 0,
        to: 1,
        easing: \'easeOutQuart\'
      }
    });
  } else if(data.type === \'grid\') {
        // Using data.axis we get x or y which we can use to construct our animation definition objects
        var pos1Animation = {
            begin: seq * delays,
      dur: durations,
      from: data[data.axis + \'1\'] - 30,
      to: data[data.axis + \'1\'],
      easing: \'easeOutQuart\'
    };

    var pos2Animation = {
            begin: seq * delays,
      dur: durations,
      from: data[data.axis + \'2\'] - 100,
      to: data[data.axis + \'2\'],
      easing: \'easeOutQuart\'
    };

    var animations = {};
    animations[data.axis + \'1\'] = pos1Animation;
    animations[data.axis + \'2\'] = pos2Animation;
    animations[\'opacity\'] = {
            begin: seq * delays,
      dur: durations,
      from: 0,
      to: 1,
      easing: \'easeOutQuart\'
    };

    data.element.animate(animations);
  }
});

// For the sake of the example we update the chart every time it\'s created with a delay of 10 seconds
chartistLineSMILE.on(\'created\', function() {
    if(window.__exampleAnimateTimeout) {
        clearTimeout(window.__exampleAnimateTimeout);
        window.__exampleAnimateTimeout = null;
    }
    window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
});', View::POS_READY); ?>
    <h2>SVG Path Animation</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        'series' => [
            [1, 5, 2, 5, 4, 3],
            [2, 3, 4, 8, 1, 2],
            [5, 4, 3, 2, 1, 0.5]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'low' => 0,
            'showArea' => true,
            'showPoint' => false,
            'fullWidth' => true
        ]
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistLineSVGPath',
    ]
]);
?>
<?php $this->registerJs('chartistLineSVGPath.on(\'draw\', function(data) {
  if(data.type === \'line\' || data.type === \'area\') {
    data.element.animate({
      d: {
        begin: 2000 * data.index,
        dur: 2000,
        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
        to: data.path.clone().stringify(),
        easing: Chartist.Svg.Easing.easeOutQuint
      }
    });
  }
});', View::POS_READY); ?>
    <h2>Line Interpolation / Smoothing</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => [1, 2, 3, 4, 5],
        'series' => [
            [1, 5, 10, 0, 1, 2],
            [10, 15, 0, 1, 2, 3]
        ]
    ])),
    'chartOptions' => [
        'options' => [
// Remove this configuration to see that chart rendered with cardinal spline interpolation
            // Sometimes, on large jumps in data values, it's better to use simple smoothing.
            'lineSmooth' => new JsExpression('Chartist.Interpolation.simple(' . Json::encode(['divisor' => 2]) . ')'),
            'fullWidth' => true,
            'low' => 0,
        ]
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h1>Bar Chart Examples</h1>
    <h2>Bi-Polar Bar Chart</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10'],
        'series' => [
            [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'high' => 10,
            'low' => -10,
            'axisX' => [
                'labelInterpolationFnc' => new JsExpression('function(value, index) {
        return index % 2 === 0 ? value : null;
    }')
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Overlapping Bars on Mobile</h2>
<?= Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mai',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
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
            [
                'screen and (max-width: 640px)',
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
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]); ?>
    <h2>Add Peak Circles Using The Draw Events</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10'],
        'series' => [
            [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'high' => 10,
            'low' => -10,
            'axisX' => [
                'labelInterpolationFnc' => new JsExpression('function(value, index) { return index % 2 === 0 ? value : null; }')
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistBarCircles',
    ]
]);
?>
<?php $this->registerJs('chartistBarCircles.on(\'draw\', function(data) {
// If this draw event is of type bar we can use the data to create additional content
if(data.type === \'bar\') {
// We use the group element of the current series to append a simple circle with the bar peek coordinates and a circle radius that is depending on the value
    data.group.append(new Chartist.Svg(\'circle\', {
        cx: data.x2,
        cy: data.y2,
        r: Math.abs(data.value) * 2 + 5
    }, \'ct-slice\'));
}
});', View::POS_READY); ?>
    <h2>Multi-Line Labels</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => [
            'First quarter of the year',
            'Second quarter of the year',
            'Third quarter of the year',
            'Fourth quarter of the year'
        ],
        'series' => [
            [60000, 40000, 80000, 70000],
            [40000, 30000, 70000, 65000],
            [8000, 3000, 10000, 6000]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'seriesBarDistance' => 10,
            'axisX' => [
                'offset' => 60
            ],
            'axisY' => [
                'labelInterpolationFnc' => new JsExpression('function(value) { return value + \' CHF\' }'),
                'scaleMinSpace' => 15
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Stacked Bar Chart</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Q1', 'Q2', 'Q3', 'Q4'],
        'series' => [
            [800000, 1200000, 1400000, 1300000],
            [200000, 400000, 500000, 300000],
            [100000, 200000, 400000, 600000]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'stackBars' => true,
            'axisY' => [
                'labelInterpolationFnc' => new JsExpression('function(value) { return (value / 1000) + \'k\'; }'),
                'scaleMinSpace' => 15
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistBarStacked'
    ]
]);
?>
<?php $this->registerJs('chartistBarStacked.on(\'draw\', function(data) {
if(data.type === \'bar\') {
    data.element.attr({
        style: \'stroke-width: 30px\'
    });
}
});', View::POS_READY); ?>
    <h2>Horizontal Bar Chart</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        'series' => [
            [5, 4, 3, 7, 5, 10, 3],
            [3, 2, 9, 5, 4, 6, 4]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'seriesBarDistance' => 10,
            'reverseData' => true,
            'horizontalBars' => true,
            'axisY' => [
                'offset' => 70
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Extreme Responsive Configuration</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'],
        'series' => [
            [5, 4, 3, 7],
            [3, 2, 9, 5],
            [1, 5, 8, 4],
            [2, 3, 4, 6],
            [4, 1, 2, 1]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'stackBars' => true,
            'axisX' => [
                'labelInterpolationFnc' => new JsExpression('function(value) { return value.split(/\s+/).map(function(word) { return word[0]; }).join(\'\'); }')
            ],
            'axisY' => [
                'offset' => 20
            ]
        ],
        'responsiveOptions' => [
            // Options override for media > 400px
            [
                'screen and (min-width: 400px)',
                [
                    'reverseData' => true,
                    'horizontalBars' => true,
                    'axisX' => [
                        'labelInterpolationFnc' => new JsExpression('Chartist.noop')
                    ],
                    'axisY' => [
                        'offset' => 60
                    ]
                ]
            ],
            // Options override for media > 800px
            [
                'screen and (min-width: 800px)',
                [
                    'stackBars' => false,
                    'seriesBarDistance' => 10
                ]
            ],
            // Options override for media > 1000px
            [
                'screen and (min-width: 1000px)',
                [
                    'reverseData' => false,
                    'horizontalBars' => false,
                    'seriesBarDistance' => 15

                ]
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h1>Pie Chart Examples</h1>
    <h2>Simple Pie Chart</h2>
<?php $this->registerJs('var sum = function(a, b) { return a + b };', View::POS_READY); ?>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'series' => [5, 3, 4]
    ])),
    'chartOptions' => [
        'options' => [
            'labelInterpolationFnc' => new JsExpression('function(value) { return Math.round(value / data.series.reduce(sum) * 100) + \'%\'; }')
        ]
    ],
    'widgetOptions' => [
        'type' => 'Pie',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Pie Chart With Custom Labels</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Bananas', 'Apples', 'Grapes'],
        'series' => [20, 15, 40]
    ])),
    'chartOptions' => [
        'options' => [
            'labelInterpolationFnc' => new JsExpression('function(value) { value[0]; }')
        ],
        'responsiveOptions' => [
            [
                'screen and (min-width: 640px)',
                [
                    'chartPadding' => 30,
                    'labelOffset' => 100,
                    'labelDirection' => 'explode',
                    'labelInterpolationFnc' => new JsExpression('function(value) { return value; }')
                ]
            ],
            [
                'screen and (min-width: 1024px)',
                [
                    'labelOffset' => 80,
                    'chartPadding' => 20
                ]
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Pie',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Gauge Chart</h2>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'series' => [20, 10, 30, 40]
    ])),
    'chartOptions' => [
        'options' => [
            'donut' => true,
            'donutWidth' => 60,
            'startAngle' => 270,
            'total' => 200,
            'showLabel' => false
        ]
    ],
    'widgetOptions' => [
        'type' => 'Pie',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h1>Using Plugins</h1>
    <h2>Point Label Plugin</h2>
<?php $this->registerJsFile('url/to/plugin.js'); ?>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['M', 'T', 'W', 'T', 'F'],
        'series' => [
            [12, 9, 7, 8, 5]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'plugins' => [
                new JsExpression('Chartist.plugins.ctPointLabels({ textAnchor: \'middle\' })')
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Line',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
    ]
]);
?>
    <h2>Sketchy Plugin</h2>
<?php $this->registerJsFile('url/to/plugin.js'); ?>
<?=
Chartist::widget([
    'tagName' => 'div',
    'data' => new JsExpression(Json::encode([
        'labels' => ['Q1', 'Q2', 'Q3', 'Q4'],
        'series' => [
            [800000, 1200000, 1400000, 1300000],
            [200000, 400000, 500000, 300000],
            [100000, 200000, 400000, 600000]
        ]
    ])),
    'chartOptions' => [
        'options' => [
            'plugins' => [
                new JsExpression('Chartist.plugins.ctSketchy({
                overrides: {
                    grid: {
                      baseFrequency: 0.2,
                      scale: 5,
                      numOctaves: 1
                    },
                    bar: {
                      baseFrequency: 0.02,
                      scale: 10
                    },
                    label: false
                    }
                })')
            ],
            'stackBars' => true,
            'axisY' => [
                'labelInterpolationFnc' => new JsExpression('function(value) { return (value / 1000) + \'k\'; }')
            ]
        ]
    ],
    'widgetOptions' => [
        'type' => 'Bar',
    ],
    'htmlOptions' => [
        'class' => 'ct-chart ct-golden-section',
        'id' => 'chartistPluginSketchy'
    ]
]);
?>
<?php $this->registerJs('chartistPluginSketchy.on(\'draw\', function(data) {
  if(data.type === \'bar\') {
    data.element.attr({
      style: \'stroke-width: 30px\'
    });
  }
});', View::POS_READY); ?>