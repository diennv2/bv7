<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var \common\models\Congviec $model */

?>
<article class="cmsmasters_post_masonry post-85 post type-post status-publish format-image has-post-thumbnail hentry category-advice category-pediatrics post_format-post-format-image shortcode_animated"
         data-category="advice pediatrics">
    <div class="cmsmasters_post_cont">
        <div class="cmsmasters_date_img_wrap">
            <figure class="cmsmasters_img_wrap"><a
                        href="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                        title="Kids’ Health Questions"
                        rel="ilightbox[img_85_62579e898aeb5]"
                        class="cmsmasters_img_link"><img width="860"
                                                         height="430"
                                                         src="<?= Yii::$app->urlManager->baseUrl . $value->image ?>"
                                                         class=" wp-post-image"
                                                         alt="Kids’ Health Questions"
                                                         loading="lazy"
                                                         title="6"
                                                         sizes="(max-width: 860px) 100vw, 860px"></a>
            </figure>
            <span class="cmsmasters_post_date cmsmasters-icon-calendar-3"><abbr
                        class="published" title="November 10, 2015"><span
                            class="cmsmasters_day_mon"><?= $value->posted_date ?></span></abbr><abbr
                        class="dn date updated"
                        title="<?= $value->posted_date ?>"><?= $value->posted_date ?></abbr></span>
        </div>
        <header class="cmsmasters_post_header entry-header"><h4
                    class="cmsmasters_post_title entry-title"><a
                        href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>"><?= $value->title ?></a>
            </h4></header>
        <div class="cmsmasters_post_content entry-content">
            <p><?= $value->brief ?></p>
        </div>
        <a class="cmsmasters_post_read_more"
           href="<?= Yii::$app->urlManager->createUrl(['site/news', 'id' => $value->id, 'url' => $value->url, 'catname' => func::taoduongdan($value->catNew->name)]) ?>">Đọc
            thêm</a>
    </div>
    <footer class="cmsmasters_post_footer entry-meta"><span
                class="cmsmasters_post_author">Đăng bởi <a
                    href="#"
                    title="Posts by cmsmasters" class="vcard author"
                    rel="author"><span class="fn"> <?php $user = \common\models\Admin::findOne(['id' => $value->lang_id]); ?>
                    <?= $user->ten ?></span></a></span>
    </footer>

</article>