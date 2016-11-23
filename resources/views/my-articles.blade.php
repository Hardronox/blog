@extends('layouts.app')

@section('pageTitle', 'My Articles')

@section('content')
    {!!Html::script('js/my-articles.js')!!}
    {!!Html::script('js/profile.js')!!}
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" width="100%">
                        <tr>
                            <th>№</th>
                            <th >Title</th>
                            <th class="tbl_align">Description</th>
                            <th class="tbl_align">Views</th>
                            <th class="tbl_align">Date</th>
                            <th class="tbl_align">Status</th>
                            <th class="tbl_align">Actions</th>
                        </tr>
                        <?php foreach ($blogs as $key => $blog):?>
                        <tr id="tr<?=$blog['id']?>">
                            <th class="col-md-1"><?=$key+1?></th>
                            <td class="col-md-2"><a href="blog/view/<?=$blog['id']?>"><?=$blog['title']?></a></td>
                            <td class="col-md-4"><?=$blog['description']?></td>
                            <td class="col-md-1 tbl_align"><?=$blog['views']?></td>
                            <td class="col-md-1 tbl_align"><?=$blog['created_at']?></td>
                            <td class="col-md-1 tbl_align status"><?=$blog['status']?></td>
                            <td class="col-md-2 active tbl_align">
                                <div class="btn-group-vertical">
                                    <button  class="btn btn-info" data-id="<?=$blog['id']?>" onclick="status(this);">Change Status</button>
                                    <a href="/article/edit/<?=$blog['id']?>" class="btn btn-warning">Edit</a>
                                    <a href="/article/delete/<?=$blog['id']?>" class="btn btn-danger delete">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
