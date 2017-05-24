@extends("layouts.admin")

@section("_js")
<script>
$(function(){
    $(".to_page").click(function(){
        var href = $(this).attr("href");
        location.href = href;
    });
});
</script>
@endsection

@section("main_content")
    <div class="page-heading">
        <h3>
            Blog List
        </h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">BLog</a>
            </li>
            <li class="active"> Blog List</li>
        </ul>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        博客列表
                    </header>
                    <div class="panel-body" style="display: block;">
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th class="hidden-phone">Summary</th>
                                <th>Created</th>
                                <th>Auther</th>
                                <th>Handler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogList as $i)
                            <tr>
                                <td>
                                    <a href="#">
                                        {{$i->title}}
                                    </a>
                                </td>
                                <td class="hidden-phone">{{$i->summary}}</td>
                                <td>{{$i->created_at}}</td>
                                <td><span class="label label-warning label-mini">jetBean</span></td>
                                <td>
                                    <span class="blog_delete to_page btn btn-danger btn-xs" href="/Admin/Blog/delete?id={{$i->id}}">Delete</span>
                                    <span class="blog_edit to_page btn btn-info btn-xs" href="/Admin/Blog/add?id={{$i->id}}">Edit</span>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div  class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    {!! $blogList->render() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection