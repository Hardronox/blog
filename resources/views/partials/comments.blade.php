<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

\madand\underscore\UnderscoreAsset::register($this);
\conquer\momentjs\MomentjsAsset::register($this);

$this->registerJsFile('@web/js/comments.js', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset']]);

?>
<ul class="media-list">
    <div id="blog_view_comment_content" data-id="<?= $id ?>" data-type="<?= $type ?>">
        <script type="text/template" id="pageContent">
            <li class="media">
                <div id="m<%- comments.id %>">
                    <div class="media-left">
                        <% if (comments.commentAuthor.avatar !== "NULL") { %>
                        <img width="100px" height="100px" src="/images/avatar/thumb/<%= comments.commentAuthor.avatar %>"/>
                        <% } else { %>
                        <img width="100px" height="100px" src="/images/avatar/thumb/_no-image" />
                        <% } %>
                    </div>
                    <div class="media-body">
                        <a href=""><h5><%= comments.commentAuthor.firstname %> <%= comments.commentAuthor.lastname %></h5></a>
                        <p><%= comments.comment_text %></p>
                        <p><%= date %>
                        <?php if(Yii::$app->user->isGuest) {?>
                            <a class="a-hover pull-right">
                                <span class="thumbs icon_wrap fa fa-thumbs-up likes"><%= likes %></span>
                            </a>
                        <?php } else {?>
                            <a class="comment_button" data-id="<%= comments.id %>" data-name="<%= comments.commentAuthor.firstname %>" onclick="answer(this)"><?=Yii::t('app','Answer')?> </a>

                            <a class="a-hover pull-right" onclick="like(this);" data-type="Comment" data-post="<%- comments.id %>">
                                <span class="thumbs icon_wrap fa fa-thumbs-up likes"> <%= likes %></span>
                            </a>
                        <?php }?>
                        </p>
                    </div>
                </div>
            </li>
        </script>
    </div>
</ul>
