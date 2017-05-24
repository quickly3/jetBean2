@extends("layouts.admin")

@section("_css")
    <link rel="stylesheet" type="text/css" href="/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-fileupload.min.css" />

    <link rel="stylesheet" type="text/css" href="/js/jquery-tags-input/jquery.tagsinput.css" />
@endsection

@section("_js")
    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/js/bootstrap-fileupload.min.js"></script>
    <script src="/js/jquery-tags-input/jquery.tagsinput.js"></script>
    <script src="/js/tagsinput-init.js"></script>

    <script>

        $(".form_datetime-component").datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            initialDate:new Date(),
            todayBtn:"linked",
            autoclose:true,
        });
        var _date  = new Date();

        var initDate = _date.getFullYear()+"-"+(_date.getMonth()+1)+"-"+_date.getDate()+" "+_date.getHours()+":"+_date.getMinutes();


        var inputDate = $.trim($(".form_datetime-component").find("input").val());

        var _initDate = inputDate?inputDate:initDate;


        $(".form_datetime-component").find("input").val(_initDate);


        $("#addCate").click(function(){
            var input_tpl ='<input id="new_cate" class="form-control" type="text" >';
            if( $("#new_cate").length == 0){
                $(this).after(input_tpl);
                $("#new_cate").focus();
            }

        });

        $(".blog_right").on("keydown","#new_cate", function(e){
            var handleUrl = "/Admin/Blog/addCate";
            if(e.keyCode == 13){
                var _cate = $("#new_cate").val();
                var data = {
                    _cate:_cate 
                }
                
                $.get(handleUrl,data,function(res){
                    var tpl = "<option value='"+res.data.id+"'>"+res.data.name+"</option>"
                    if(res && res.sta >0 ){
                        $("select[name=category]").append(tpl);
                        $("#new_cate").remove();
                    }
                });

                return false;    
            }
        })

        $(".blog_right").on("blur","#new_cate", function(){
            $("#new_cate").remove();
        })

        $("select[name=category]").change(function(){
            var _id = $(this).val();
            
            if(_id == 0){
                $("input[name=cate_img]").val(0);
                $("#upload_img").attr("src","");    
                return false;
            }

            var data = {
                id:_id
            };
            
            var handleUrl = "/Admin/cate/cateImg";
            $.get(handleUrl,data,function(res){
                if(res && res.sta >0 ){
                    if(res.data.img_id >0){
                        $("input[name=cate_img]").val(res.data.img_id);
                        $("#upload_img").attr("src",res.data.rela_path);                        
                    }else{
                        $("input[name=cate_img]").val(0);
                        $("#upload_img").attr("src","");      
                    }
                }
            });            
        });

        $("input[name=main_img]").change(function(){
            $("input[name=cate_img]").val(0);
        });

    </script>

@endsection



@section("main_content")
<!-- page heading start-->
<div class="page-heading">
    <h3>
        Blog Add
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Blog</a>
        </li>
        <li class="active"> Blog {{$header}} </li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper" ng-app="myApp">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="form">
                        <form action="\Admin\Blog\{{$handleUrl}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-10 blog_left">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="" class="">Title</label>
                                            <input class="form-control" type="text" name="title" value="{{$blogInfo->title or ''}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="">Created_at</label>
                                            <div class="input-group date form_datetime-component">
                                                <input type="text" name="created_at" class="form-control" readonly="" size="16" value="{{$blogInfo->created_at or ''}}">
                                            <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary date-set"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="" class="">Summary</label>
                                    <input class="form-control" type="text" name="summary" value="{{$blogInfo->summary or ''}}">
                                    <br>
                                    <textarea class="form-control ckeditor" name="content" rows="6">{{$blogInfo->content or ''}}</textarea>
                                </div>
                                <div class="col-sm-2 blog_right">
                                    <label for="" class="">Image</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img id = "upload_img" src="{{$blogInfo->img or ''}}" alt="" />
                                            <input type="hidden" name="cate_img" value="">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                           <span class="btn btn-default btn-file">
                                           <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                           <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                           <input type="file" name="main_img" class="default" />
                                           </span>
                                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>
                                    </br>
                                    <label for="" class="">Category</label>
                                    <select name="category" class="form-control m-bot15">
                                        <option value="0">未分类</option>
                                        @foreach($categories as $i)
                                            <option value="{{$i->id}}" @if( $i->id == ($blogInfo?$blogInfo->category:0)) selected @endif >{{$i->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="addCate" class="btn btn-info btn-xs">添加分类</span>
                                    </br>
                                    <label for="" class="">Tags</label>
                                    <div class="tags">
                                        <input id="tags_2" name="tags" type="text" class="tags" value="{{$blogInfo->tags or ''}}" />
                                    </div>
                                    </br>
                                    <input type="submit" class="btn btn-success">
                                </div>

                            </div>
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
@endsection