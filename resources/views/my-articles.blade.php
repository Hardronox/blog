@extends('layouts.app')

@section('pageTitle', 'My Articles')

@section('content')
    <script type="text/javascript">

    </script>
    {!!Html::script('js/profile.js')!!}
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="col-md-10 col-md-offset-1">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>№</th>
                        <th style="min-width: 60%;">Title</th>
                        <th class="tbl_align">Description</th>
                        <th class="tbl_align">Views</th>
                        <th class="tbl_width tbl_align">Date</th>
                        <th class="tbl_align">Status</th>
                        <th class="tbl_align">Actions</th>
                    </tr>
                    <?php foreach ($blogs as $key => $blog):?>
                    <tr>
                        <th><?=$key+1?></th>
                        <td><a href="blog/view"><?=$blog['title']?></a></td>
                        <td style="max-width: 500px; word-wrap: break-word;"><?=$blog['description']?></td>
                        <td class="tbl_align"><?=$blog['views']?></td>
                        <td class="tbl_align"><?=$blog['created_at']?></td>
                        <td class="tbl_align">
                            <?php
                                if ($blog['status']==\App\Models\Blog::STATUS_PUBLISHED) echo 'Published';
                                else echo 'Draft';
                            ?>
                        </td>
                        <td class="active tbl_align">
                            <div class="btn-group-vertical">
                                <a href="/article/status/<?=$blog['id']?>" class="btn btn-info">Change Status</a>
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

@endsection
