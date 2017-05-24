@extends("layouts.master")
@section("_css")
<!--     <link href="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/styles/shCoreDefault.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom/blog.css"> -->
    <link rel="stylesheet" href="/css/custom/blog.css">

@endsection
@section("_js")
<script src="//cdn.bootcss.com/echarts/3.3.1/echarts.min.js"></script>
<script>
var myChart = echarts.init(document.getElementById('chart'));

var stas = {!! $stas !!};

var _data = [];
var _name = [];
stas.map(function(d,i){
    d.name = d.title;
    d.xAxis = i;
    d.y = 350;
    _data.push(d.view);
    _name.push(d.title);
});

var option = {
    title: {
        x: 'center',
        text: '博客访问前10',
    },
    tooltip: {
        trigger: 'item'
    },
    toolbox: {
        show: true,
        feature: {
            dataView: {show: true, readOnly: false},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
    calculable: true,
    grid: {
        borderWidth: 0,
        y: 80,
        y2: 60
    },
    xAxis: [
        {
            type: 'category',
            show: false,
            data: _name,
        }
    ],
    yAxis: [
        {
            type: 'value',
            show: false
        }
    ],
    series: [
        {
            name: '博客访问量前10',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: function(params) {
                        // build a color map as your need.
                        var colorList = [
                          '#C1232B','#B5C334','#FCCE10','#E87C25','#27727B',
                           '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                           '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0'
                        ];
                        return colorList[params.dataIndex]
                    },
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{b}\n{c}'
                    }
                }
            },
            data: _data
        }
    ]
};
myChart.setOption(option);
</script>
<!-- <script src="/js/custom/blog.js"></script> -->
@endsection
@section("rightSide")
    <div class="row">
        <div class="nine columns blog_header">

            <h1>博客相关统计</h1>
            <a class="color" href="/blog.html">返回博客首页</a>
        </div>
    </div>
    <div class="row">
        <div class="main-content">    
        <div id="chart" style="width: 1197px;height:378px;">
        </div>
        </div>
    </div>


@endsection