$(function(){

    // 代码着色插件配置
    SyntaxHighlighter.autoloader(
            ['js','jscript','javascript','//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushJScript.min.js'],
            ['css','//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushCss.min.js'],
            ['xml','html','//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushXml.min.js'],
            ['sql','//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushSql.min.js'],
            ['php','//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushPhp.min.js'],
            ['python','py','//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushPython.min.js']
        ); 
    SyntaxHighlighter.all();

    
    $(".random-blog-item").click(function(){
        var _url = $(this).children("a").attr("href");
        window.location.href = _url;
    });

    
    var pageBar = function(){
        var currPage,total,totalPage,perPage;
        var $pageObj = $(".blog-paging");

        if($pageObj.length == 0) return false;
        currPage = parseInt($pageObj.attr("data-curr"));
        total = parseInt($pageObj.attr("data-total"));
        perPage = parseInt($pageObj.attr("data-perpage"));
        totalPage = parseInt(Math.ceil(total / perPage));

        var handleUrl = "/blog.html";


        function parse_url(_url){ //定义函数 
            var pattern = /(\w+)=(\w+)/ig;//定义正则表达式 
            var parames = {};//定义数组 
            _url.replace(pattern, function(a, b, c){parames[b] = c;}); 
            return parames;//返回这个数组. 
        } 

        var parse = parse_url(location.href);

        if(parse.cate){
            handleUrl = "/blog.html"+"?cate="+parse.cate;
        }
        
        if(parse.tag){
            handleUrl = "/blog.html"+"?tag="+parse.tag;   
        }

        var firstTag = '<a class="background-color firstTag" href="<%handleUrl%>">First</a>';
        var lastTag = '<a class="background-color lastTag" href="<%handleUrl%>">Last</a>';
        var previous = '<a class="background-color previousTag" href="javascript:;">...</a>';
        var next = '<a class="background-color nextTag" href="javascript:;">...</a>';;
        var pageBtn = '<a class="background-color pageBtn" href="<%handleUrl%>"><%pageNo%></a>';
        var pageStep = 3;

        var _init = function(){
            genPageBar();
        }

        var genPageBar = function(){
            var barHtml = "";
            $pageObj.children().remove();
            var tmp_str = "";

            barHtml+=firstTag.replace("<%handleUrl%>",handleUrl+"?page=1");

            if(currPage >= 3){
                barHtml+=previous;
            }

            tmp_str = pageBtn;
            if(currPage - 1 > 0){
                tmp_str = pageBtn;
                barHtml+=tmp_str.replace("<%handleUrl%>",handleUrl+"?page="+parseInt(currPage - 1))
                    .replace("<%pageNo%>",currPage - 1);
            }

            tmp_str = pageBtn;
            barHtml+=tmp_str.replace("<%handleUrl%>",handleUrl+"?page="+parseInt(currPage))
                .replace("<%pageNo%>",currPage);

            if(currPage + 1 <= totalPage){
                tmp_str = pageBtn;
                barHtml+=tmp_str.replace("<%handleUrl%>",handleUrl+"?page="+parseInt(currPage + 1))
                    .replace("<%pageNo%>",currPage + 1);
            }

            if(totalPage - currPage >= 2){

                barHtml+=next;
            }

            barHtml+=lastTag.replace("<%handleUrl%>",handleUrl+"?page="+totalPage);

            $pageObj.append(barHtml);
        }

        return {
            _init:_init
        }

    }

    var tagCloud = function(){
        var tagSize = ['tag-normal','tag-medium','tag-bigger',"tag-biggest"];
        var tagStyle = ['color','tag-bold'];

        var $obj = $(".tag-list").find("a");
        $obj.each(function(d){
            var s = Math.floor(Math.random()*4);
            var s2 = Math.floor(Math.random()*2);
            var s3 = Math.floor(Math.random()*2);
            $(this).addClass(tagSize[s]);
            $(this).addClass(tagStyle[s2]);
            $(this).addClass(tagStyle[s3]);

        });
    }



    tagCloud();
    pageBar()._init();
});