@extends("layouts.master")
@section("_css")
    <link href="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/styles/shCoreDefault.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom/blog.css">
    

@endsection
@section("_js")

<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shCore.js"></script>
<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shAutoloader.min.js"></script>
<script src="/js/custom/blog.js"></script>
@endsection
@section("rightSide")

    <div class="row">

        <div class="nine columns blog_header">

            <h1>Blog</h1>
            @if($curr_cate)<span>当前分类：{{$curr_cate->name}}</span>@endif
            @if($curr_tag)<span>当前标签：{{$curr_tag->name}}</span>@endif
            <a class="color" href="/blog.html">全部</a>
            <a class="color" target="__BLANK" href="/Home/Blog/statistics">博客统计</a>
        </div>

        <div class="three columns">

            <a href="#" title="Go Back" class="back-button to-left-icon-b">Neque porro</a>

        </div>

    </div><!-- Site Heading Title ENDS -->

    <div class="row">

        <div class="main-content three columns blog-list">
            @foreach($blogList as $i)
            <div class="random-blog-item blog-list-item">
                <img src="{{$i->img}}" alt="random blog post" class="random-blog-img">
                @if($curr_cate)
                <a href="/blog.html?id={{$i->id}}&cate={{$curr_cate->id}}" title="random blog post" class="random-blog-title">{{$i->title}}</a>
                @elseif($curr_tag)
                <a href="/blog.html?id={{$i->id}}&tag={{$curr_tag->id}}" title="random blog post" class="random-blog-title">{{$i->title}}</a>
                @else
                <a href="/blog.html?id={{$i->id}}" title="random blog post" class="random-blog-title">{{$i->title}}</a>
                @endif

                <div class="random-blog-descr">{{$i->summary}}</div>
                <div class="random-blog-item-bg background-color"></div>
            </div>
            @endforeach


            <div class="blog-paging" data-curr="{{$blogList->currentPage()}}"
                                     data-total="{{$blogList->total()}}"
                                     data-perPage="{{$blogList->perPage ()}}">
                <a class="background-color" href="#">First</a>
                <a class="background-color" href="#">...</a>

                <a class="background-color" href="#">6</a>
                <a class="background-color" href="#">7</a>
                <a class="background-color" href="#">8</a>

                <a class="background-color" href="#">...</a>
                <a class="background-color" href="#">Last</a>
            </div>

        </div>

        <div class="six columns">

            <div class="background-color blog-post-title">

                <a href="blog.html" class="blog-post-link">{{$blogInfo->title}}</a>

                <div class="team-member-icons connection-w deactive"></div>

                <div class="blog-post-date">{{ $blogInfo->created_at }}</div>

            </div>

            <div class="post-img-zone" title="{{$blogInfo->title}}">
                <img src="{{$blogInfo->img}}" alt="blog post img" class="blog-post-img"/>
            </div>
            <div>
                <div class="view-cnt">
                    <span><i class="fa fa-eye"></i> {{$blogInfo->view}}</span> 
                </div>
                <h4>{{$blogInfo->summary}}</h4><br><br>
            </div>
            
            <div class="bt">
                {!! $blogInfo->content !!}
            </div>
        </div>

        <div class="three columns">

            <div class="title grid">Categories <span class="blog_cnt">博客总数:{{$blogCnt}}</span></div>

            <ul class="blog-categories">
                @foreach($categories as $i)
                <li>
                    <div class="blog-cat-anim background-color"></div>
                    <a href="blog.html?cate={{$i->id}}" title="blog category">{{$i->name}}<span class="cate_cnt">({{$i->cnt}})</span></a>
                    
                </li>
                    
                
                @endforeach
            </ul>

            <div class="blog-posts-tab">

                <div class="comments-nav background-color margin-tb-10">

                    <div id="popular-blogs" class="comment-title deactive">Popular</div>
                    <div id="recent-blogs" class="comment-title">Recent</div>

                </div>

                <div class="popular-blogs">
                    @foreach($popular as $i)
                    <div class="random-blog-item">
                        <img src="{{$i->img}}" alt="random blog post" class="random-blog-img">
                        <a href="/blog.html?id={{$i->id}}" title="random blog post" class="random-blog-title">{{$i->title}}</a>

                        <div class="random-blog-descr">{{$i->summary}}</div>
                        <div class="random-blog-item-bg background-color"></div>
                    </div>
                    @endforeach
                </div>

                <div class="recent-blogs">
                    @foreach($recent as $i)
                    <div class="random-blog-item">
                        <img src="{{$i->img}}" alt="random blog post" class="random-blog-img">
                        <a href="/blog.html?id={{$i->id}}" title="random blog post" class="random-blog-title">{{$i->title}}</a>

                        <div class="random-blog-descr">{{$i->summary}}</div>
                        <div class="random-blog-item-bg background-color"></div>
                    </div>
                    @endforeach
                </div>

                <div class="clear"></div>

            </div>

            <div class="title tag-cloud">Tag Cloud</div>

            <div class="tag-list margin-tb-10">
                @foreach($tags as $i)
                <a href="/blog.html?tag={{$i->id}}" title="{{$i->name}}" >{{$i->name}}</a>
                @endforeach
            </div>

        </div>

    </div>

@endsection