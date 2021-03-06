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
        .cate-edit,.cate-remove{
            cursor: pointer;
            margin-right: 10px;
            float: right;
        }
        
    </style>
@endsection
@section("_js")
    <script src="/js/zeroclipboard/jquery.zeroclipboard.js"></script>
    <script src="/js/masonry.pkgd.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            $('.grid').masonry({
                // options
                itemSelector: '.grid-item',
                columnWidth: 200,
                gutter: 10
            });

            $(".cate-edit").click(function(){
                var data = { 
                    _id: $(this).parent().data('id'),
                    _name:$(this).parent().data('name'),
                    _img_id:$(this).parent().data('imgid')
                };

                $("#editCate input[name=name]").val(data._name);
                $("#editCate input[name=img_id]").val(data._img_id);
                $("#editCate input[name=id]").val(data._id);
                $("#editCate input[name=img]").attr("value","");
                $("#editCate").modal("show");
            
            });

            $(".cate-remove").click(function(){
                var data = { id: $(this).parent().data('id')};
                var handleUrl = "/admin/cate/dropCate";
                var _pItem = $(this).parents(".cate_item"); 
                $.post(handleUrl,data,function(res){
                    if(res && res.sta){
                        alert("删除成功");
                        location.href = location.href;
                    }
                })
            });

            $("#addCate").click(function(){
                $("#myModal").modal("show");
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
                    <a id="addCate" class="btn btn-sm btn-info">添加分类</a>
                </div>
                <br>
                <div class="images grid">
                    @foreach($list as $i)
                        <div class="image_item grid-item cate_item">
                            <div class="img">
                                <img src="{{$i->rela_path}}" alt="">
                            </div>
                            <div class="handle" data-id="{{$i->id}}" data-name="{{$i->name}}" data-imgid="{{$i->img_id}}">
                                <span>{{$i->name}}</span>
                                <span class="btn btn-danger btn-xs cate-remove"><i class="fa fa-trash-o"></i></span>
                                <span class="btn btn-info btn-xs cate-edit"><i class="fa fa-edit"></i></span>
                                
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
                    <form role="form" method="POST" action="/Admin/Cate/addCate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">分类名</label>
                            <input type="text" name="name">
                            <input type="hidden" name="id" value=0>
                        </div>
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
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editCate" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Form Tittle</h4>
                </div>
                <div class="modal-body"> 
                    <form role="form" method="POST" action="/Admin/Cate/addCate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">分类名</label>
                            <input type="text" name="name">
                            <input type="hidden" name="id" value=0>
                        </div>
                        <div class="form-group">
                            <label for="">分类图片id</label>
                            <input type="text" name="img_id">
                        </div>                        
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