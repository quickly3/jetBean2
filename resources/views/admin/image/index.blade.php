@extends("layouts.admin")

@section("_css")
<style>
    .image_item{
        border: 1px #aaa solid;
        width:200px;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 10px;
        /*margin:0 0px 5px 2px;*/
    }
    .image_item .handle{
        text-align: left;
        padding: 5px 0 5px 20px;
    }
    .image_item img{
        margin-top:5px;
        width:180px;
    }
    .copy-url:hover{
        cursor: pointer;
    }

</style>
@endsection
@section("_js")
<script src="/js/zeroclipboard/jquery.zeroclipboard.js"></script>
<script src="/js/masonry.pkgd.min.js"></script>
<script>
$(function(){
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 200,
        gutter: 10
    });

    $("body")
        .on("copy", ".copy-url", function(e) {
            e.clipboardData.clearData();
            e.clipboardData.setData("text/plain", $(this).data("path"));
            e.preventDefault();
    });
});
</script>
@endsection


@section("main_content")
<!-- page heading start-->
<div class="page-heading">
    <h3>
        Image List
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Resource</a>
        </li>
        <li class="active">Image</li>
    </ul>
</div>
<!-- page heading end-->
<div class="wrapper">
    <section class="panel">
    <div class="wrapper" >
        <div class="handle">
        <a href="#myModal" data-toggle="modal" class="btn btn-sm btn-info">添加图片</a>
        </div>
        <br>
        <div class="images grid">
            @foreach($list as $i)
            <div class="image_item grid-item">
                <div class="img">
                    <img src="{{$i->rela_path}}" alt="">
                </div>
                <div class="handle">
                    <span class="btn btn-danger btn-xs"><i class="fa fa-copy copy-url" data-path="{{$i->rela_path}}"></i></span>
                    <span>ID:{{$i->id}}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="">
            <div class="dataTables_paginate paging_bootstrap pagination images-page">
            {!! $list->render() !!}
            </div>
        </div>
    </div>
    </section>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Form Tittle</h4>
            </div>
            <div class="modal-body">

                <form role="form" method="POST" action="/Admin/image/upload_img" enctype="multipart/form-data">
                    <div class="form-group">
                        <input name="img" type="file" id="exampleInputFile3">
                        <p class="help-block">点击上传图片</p>
                    </div>  
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection