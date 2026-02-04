<?php

use common\models\Configure;
use common\models\Menu;
use frontend\assets\AppAsset;

$config = Configure::getConfig();
AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head><title>
            <?= $this->title ?>
        </title>
        <link rel="shortcut icon" href="<?= Yii::$app->urlManager->baseUrl . $config['favicon'] ?>" type="image/png">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="icon">
        <script type="text/javascript"
                src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/jquery-1.11.2.min.js"></script>
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/bootstrap.min.css">
        <script type="text/javascript" src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/animate.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/app.css?ver=1">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/style.css?ver=1">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/video.css?ver=1">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/custom.css?ver=1">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/styles.css?ver=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/font-awesome.min.css">
        <link rel="Stylesheet" href="<?= Yii::$app->urlManager->baseUrl ?>/theme/css/select2.min.css">
        <script type="text/javascript" src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/app.js?ver=1"></script>
        <script type="text/javascript"
                src="//platform-api.sharethis.com/js/sharethis.js#property=5b0e4dd9cbe75600112c4204&amp;product=inline-share-buttons"></script>
        <script type="text/javascript" src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/select2.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/jwplayer.js"></script>
        <script type="text/javascript">jwplayer.key = "ndWqj2I3yv7HKvYBdlZ0UmdnMkWE5ci2UMV0vid8S44=";</script>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="zTBkskZd"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <!-- Google Tag Manager -->
        <script type="text/javascript">
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-WBNDKX4');
        </script>
        <!-- End Google Tag Manager -->

        <!-- Subiz -->
		<!-- Begin EMC Tracking Code -->
		<script type="text/javascript">
			var _govaq = window._govaq || [];

			_govaq.push(['trackPageView']);
			_govaq.push(['enableLinkTracking']);

			(function () {
				_govaq.push(['setTrackerUrl', 'https://f-emc.ngsp.gov.vn/tracking']);
				_govaq.push(['setSiteId', '8981']);

				var d = document,
					g = d.createElement('script'),
					s = d.getElementsByTagName('script')[0];

				g.type = 'text/javascript';
				g.async = true;
				g.defer = true;
				g.src = 'https://f-emc.ngsp.gov.vn/embed/gov-tracking.min.js';
				s.parentNode.insertBefore(g, s);
			})();
		</script>
		<!-- End EMC Tracking Code -->

        <!-- End Subiz -->
    </head>
    <?php
    $detect = new Mobile_Detect();
    ?>
    <?php Yii::$app->language = 'vi-VN';
    $menu = Menu::getRootMenu('top');
    $menubottom = Menu::getRootMenu('bottom');

    ?>

    <?php $this->beginBody(); ?>
    <body>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WBNDKX4" height="0" width="0"
                style="display: none; visibility: hidden" jkwm5bs7n=""></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="fb-root"></div>

    <header class="header">
        <div id="BodyContent_ctl00_topPanel" class="ecm-panel">
            <div class="header-top" id="header-top">
                <div class="container">
                    <div class="header-top-content">
                        <div class="col-md-4 hidden-xs header-top-phone">
                            <b>Hotline:</b>
                            <span><a style="color: #fff;"
                                     href="tel:<?= $config['contact_phone'] ?> - <?= $config['contact_hotline'] ?>"><?= $config['contact_phone'] ?> - <?= $config['contact_hotline'] ?></a></span>
                        </div>
                        <div class="col-md-4 hidden-md hidden-lg hidden-sm header-top-phone">
                            <b>Hotline:</b>
                            <span><a style="color: #fff;"
                                     href="tel:<?= $config['contact_phone'] ?> - <?= $config['contact_hotline'] ?>"><?= $config['contact_phone'] ?> - <?= $config['contact_hotline'] ?></a></span>
                        </div>
                        <div class="col-md-8 header-top-right">
                            <div class="header-top-menu" style="margin-left: auto; margin-right: 0">
								<a href="https://smarttravel-vr.mobifone.vn/vr-tour/benh-vien-quan-y-7" target="_blank"
									style="text-decoration: none; color: inherit;">
									<i class='fa fa-map-o' style='color:#00820c' aria-hidden="true"></i>
								</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="header-bottom">
                <div class="container">
                    <div class="header-bottom-content">
                        <div class="logo col-md-7 col-xs-12">
                            <a href="/">
                                <span class="slogan hidden-md hidden-lg">
                                    <img src="<?= $config['contact_logo_footer'] ?>"
                                         style="width: 100% !important; margin-top: -7px">
                                </span>
                                <span class="slogan hidden-xs hidden-sm " style="margin-top: -5px">
                                    <img src="<?= $config['contact_logo'] ?>">
                                </span>
                            </a>

                        </div>
                        <div class="search-box col-md-3 col-xs-12">
                            <form action="/tim-kiem.html">
                                <div class="cmsmasters_header_search_form_field">
                                    <button type="submit" class="search-icon">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                    <input id="search-box" type="search" name="finder" value="" placeholder="Tìm kiếm"/>
                                </div>
                            </form>
                        </div>
						<div id="qrcode" class="qr-code col-md-2 d-none d-md-block text-center">
							<img style="width:50%; height:auto" src="<?= Yii::$app->urlManager->baseUrl ?>/images/qrcode.png" />
							<div style="font-size:9px; margin-top: 8px; font-weight: bold;">HƯỚNG DẪN LỐI ĐI</div>
						</div>
                    </div>
                </div>

                <div class="menu-primary-point"></div>
                <nav class="menu-primary">
                    <div class="container">

                        <div class="main-menu">
                            <div class="wrapper">
                                <ul class="auto-scale">
                                    <?php foreach ($menu as $menus):/** @var Menu $menus */ ?>
                                        <li class="menu-item" style="padding-left:5px!important;padding-right: 5px!important">
                                            <a style="<?= (!empty($menus->background)) ? "padding-top: 5px;" : "" ?>" <?=($menus->new_tab==1)?"target='_blank'":""?>
                                               href="<?= (!empty($menus->getUrl())) ? $menus->getUrl() : "javascript:void(0)" ?>">
                                                <?php if ($menus->background != null): ?><img
                                                    style="width : 20px; height : 20px"
                                                    src="<?= $menus->background ?>"> <?php endif; ?>
                                                <span style="letter-spacing: -1px; font-size: 14px;font-weight: normal"><?= $menus->name ?></span>
                                            </a>
                                            <?php $menucon = Menu::find()->where(['parent' => $menus->id])->orderBy("ord asc")->all();
                                            if (!empty($menucon)):
                                                ?>
                                                <ul class="sub-menu">
                                                    <?php foreach ($menucon as $menucons):/** @var Menu $menucons */ ?>
                                                        <li class="menu-item">
                                                            <a <?=($menucons->new_tab==1)?"target='_blank'":""?> href="<?= (!empty($menucons->getUrl())) ? $menucons->getUrl() : "javascript:void(0)" ?>">
                                                                <span class="nav_item_wrap">
                                                                    <span class="nav_title"><?= $menucons->background ?><?= $menucons->name ?>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <?php $menucon2 = Menu::find()->where(['parent' => $menucons->id])->all();
                                                            if (!empty($menucon2)):
                                                                ?>
                                                                <ul class="sub-menu">
                                                                    <?php foreach ($menucon2 as $menucon2s):/** @var Menu $menucon2s */ ?>
                                                                        <li class="menu-item"><a
                                                                                <?=($menucon2s->new_tab==1)?"target='_blank'":""?>
                                                                                    href="<?= (!empty($menucon2s->getUrl())) ? $menucon2s->getUrl() : "javascript:void(0)" ?>">
                                                                            <span class="nav_item_wrap">
                                                                                <span class="nav_title"><?= $menucon2s->name ?>
                                                                                </span>
                                                                            </span>
                                                                            </a>
                                                                            <ul class="sub-menu">

                                                                            </ul>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="mobile-menu"></div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    
    <main>
        <div class="page-108-content">
            <?= $content ?>
        </div>
    </main>
    <footer class="footer">
        <style>
            #BodyContent_ctl00_bottomPanel {
                display: flex;
                justify-content: center;     /* Căn giữa theo chiều ngang */
                align-items: center;         /* Căn giữa theo chiều dọc nếu có chiều cao cố định */
                gap: 16px;                   /* Khoảng cách giữa các ảnh */
                flex-wrap: wrap;             /* Cho phép xuống dòng nếu quá dài */
                padding: 12px 0;
            }
            #BodyContent_ctl00_bottomPanel img {
                max-height: 150px;
                object-fit: contain;
            }
        </style>
        <div id="BodyContent_ctl00_bottomPanel" class="ecm-panel">
            <?php $lienkets = \common\models\Lienket::findAll(['active' => 1]);
            if (!empty($lienkets)): ?>
                <?php foreach ($lienkets as $value): ?>
                    <a href="<?= $value->lienket ?>" target="_blank">
                        <img src="<?= $value->hinhanh ?>"></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <section class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="row">
                        <address class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 footer-address">
                            ©2022 <?= $config['contact_cname'] ?><br>
                            Địa chỉ: <?= $config['contact_address'] ?><br>
                            E-mail: <?= $config['contact_email'] ?><br>
                            Điện thoại: <?= $config['contact_phone'] ?>
                        </address>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 footer-socical">
                            <div class="title-box">
                                Kết nối với chúng tôi qua
                            </div>
                            <div class="sharethis-inline-share-buttons"></div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 footer-fanpage">
                            <div class="fb-page"
                                 data-href="https://www.facebook.com/B%E1%BB%87nh-Vi%E1%BB%87n-Qu%C3%A2n-Y-7-117312396794372"
                                 data-tabs="timeline" data-width="310" data-height="70"
                                 data-small-header="false" data-adapt-container-width="true"
                                 data-hide-cover="false" data-show-facepile="true">
                                <blockquote
                                        cite="https://www.facebook.com/B%E1%BB%87nh-Vi%E1%BB%87n-Qu%C3%A2n-Y-7-117312396794372"
                                        class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/B%E1%BB%87nh-Vi%E1%BB%87n-Qu%C3%A2n-Y-7-117312396794372">Bệnh
                                        Viện Quân Y 7</a></blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div style="background-color: #4c4c4c; color: #fff;">
            <div class="container">
                <div class="d-flex justify-content-between" style="padding: 15px 0; font-size: 12px">
                    <span>
                        Được phát triển bởi Techber Việt Nam © 2022. All Rights Reserved
                    </span>
                    <span>
                        <a style="color: #fff" href="https://techber.vn/">Thông tin Công ty chúng tôi</a>
                    </span>

                    <span>
                        <a style="color: #fff" href="tel:098 763 99 88">Liên hệ với chúng tôi</a>
                    </span>
                </div>
            </div>


        </div>
    </footer>

    <div id="back-to-top" style="padding: 10px;bottom: 83px; right: 28px;z-index: 99999">
        <a href="javascript:void(0)">
            <i class="fa fa-chevron-up" style="display: flex;justify-content: center;" aria-hidden="true"></i>
        </a>
    </div>

    <script type="text/javascript"
            src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/text-overflow.js?ver=1"></script>
    <script type="text/javascript" src="<?= Yii::$app->urlManager->baseUrl ?>/theme/js/custom.js?ver=1"></script>

    <style>
        /* Set up the position for both icons */
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            margin: 5px;
            z-index: 9999;
        }

        .chat-icon img {
            width: 50px; /* Icon size */
            height: 50px;
            border-radius: 50%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); /* Adds shadow to icons */
            cursor: pointer;
        }

        /* Facebook Messenger Icon */

        /* Zalo Icon */

        .chat-popup {
            position: absolute;
            bottom: 60px; /* điều chỉnh khoảng cách với icon */
            left: -41px;
            line-height: 16px;
            transform: translateX(-50%);
            background-color: #fff;
            color: #333;
            padding: 10px 12px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            z-index: 999;
            width: max-content;
            max-width: 220px;
            font-size: 14px;
        }

        .chat-popup-text {
            position: relative;
        }

        .chat-popup-close {
            position: absolute;
            top: 2px;
            right: 6px;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #999;
        }

        .chat-popup-close:hover {
            color: #333;
        }

        .chat-popup::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 8px;
            border-style: solid;
            border-color: #fff transparent transparent transparent;
        }
        .hotline-button {
            display: inline-flex;
            align-items: center;
            background-color: #d00000;
            color: white;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            font-family: sans-serif;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: background 0.3s ease;
        }

        .hotline-button:hover {
            background-color: #b00000;
        }

        .hotline-icon {
            background-color: #fff;
            color: #d00000;
            border-radius: 50%;
            padding: 6px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hotline-icon i {
            font-size: 16px;
        }
    </style>
	
		<div class="chat-icon facebook" style="bottom: 190px;" id="fb-messenger">
			<a href="https://m.me/61575569645599" target="_blank">
				<img src="data:image/png;base64,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"/>
			</a>
			<div class="chat-popup" style="bottom: 66px;" id="zalo-popup">
				  <span class="chat-popup-text">
					Bạn cần hỗ trợ? <br> Liên hệ với chúng tôi ngay.
					<button class="chat-popup-close"
							onclick="document.getElementById('zalo-popup').style.display='none'">&times;</button>
				  </span>
			</div>
		</div>

		<!-- Zalo Icon -->
		<div class="chat-icon zalo" style="bottom: 130px;" id="zalo">
			<a href="https://zalo.me/<?=str_replace(" ","",$config['contact_hotline'])?>" target="_blank">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAmcAAAJnCAMAAADlbAQjAAAAt1BMVEX///8Cj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MCj+MRluUSluUhneYwo+gwpOgxpOg/qupAqupBq+pPsetQsuteuO1fuO1guO1uvu5uv+5wv+99xfB+xvB/xvGMzPKNzfKPzfKc0/Od0/Of1PSr2vWs2vWv2/a64Pe84fe+4vfK5/jL6PjO6fnZ7vrb7/re8Pvp9fvq9vvt9/z3+/35/P38/f4l/B1xAAAAEHRSTlMAECAwQFBgcICQoLDA0ODwVOCoyAAAG4hJREFUeNrtnWtDWscWQEEQkDchVkolWqlEK5VqtaGS//+7bkxuElQeM+fM3jNnZq3PvZF7WOzXPE6pBAAAACBAdRM8FsjHQbVaazQa7S/0+rvpPf9HX/7bWrV6wIMDs6jVaLTanX52Ou1Wo1GtlnmW8JbKF79y6bVJuC++VXi08C2C1VwL9ka3GnVc0jHssNHu9nXothuHxLb0FKsdtfv6tI9qyJZKI3noRbF12Q5pSyMPY/VWtx8CvVadwBZpvd9o98Oi3aA/iC2OhebYD9eIa7HUY7VWrx8yvVaNeq3oyfKo0y8CnSNSaFEphx7I3oQ11qqKly2Drch2hrU6GbRQknX6RQXVkAzVIBbJUK0AhX+7Hw8d2oIgOWz2Y6N1yNcaWL486vZjpHdE/iRfkj8TotLs9eOm12QN1DdRh7L1oMZX7bEqa/T6qUCl5otqs58WLdbaPSTMTj89SJ/KHWaj20+TboPuk7KMQi0iy5r91GliGpbpmEZLINpitlHs/7QxDcswDcswDajLbE2jI8Ayes+CTWWxbKdpTG7dzP57uLR7cssagYN1TCwzMI11z5xNZheJzNY9aT1zlP+MMmg95QuzI+Sx4ogyjcJMpUyro40lFVJmFjqUaaRMpmmkTGYcdJlg2Xly3NOABqLkpoFG+wazHSxhbEv9zzCNVSYgpBHMCGkEM0IawQwIae6WmQhmhDRmZszSolgAYGYmSYeNaaxmsuKp1QBwmEmeVvLtAA2ATjuQ+NJ6HQWUSHmrbbnF90/uJGeSO6PoM/nqyZ30mTGS3uEBZrN+ZraJ5c4qs1lPM9ukXrXIOMMfDUozYMDhUDNKM89FWhIL6xVKM+9FWgLdAFOzEIh+Bwc7GsPgKG7N6AAY2dIBpNUNRCtaBc1CItZ1dRpN2k6NRhPNaDuZZyAa8wxgvsE8o+DzDTQDRGN/RjS0IxmkMZ1lYotmEIdoaIZoaAZxiIZmiIZm8JMir6qjWYEo7qo6mhVLtDKaATUamiEamkHUoqEZoqEZRCIarwRGNPabwQ6aaAaItgavnkM0TjbBXupoBhoU4LhdhW8pAoK/xZbLDaIg9M0bZTSLRLSg7xZlGYB5rQa8Fywe2sxnIekxGhMNxmgKVPlmmG4w0YAophu0mhHSDa/pZMdZlNMN9mhAgk0nrWas1OgBQIOAeoFyl68j3qazTA8ACgSzAMWd7XETyN3vrAPEThDrAgf0ANGXaCFsRmMdIH4CGNcyoKVEU+CQ74ASjeIM4ijRmJxRojE5A4c0OBMMGlRZ1gQFvG165HhTWrQYaYAGXvaiccUBww1GGiCBhy1CdZ56gqgfHWYhgMxJ1oRIMidZk8xJ1oRIMidZk8zJqWCII3MyoSVzasDtoGmjtM7JObrUUdnEzW4gMqfGDiH20ILC8Sf20ILGJUKMzkDhVAqjM3imzugMit8KcMsBfKNJEwBFbwVoAuA7guvpnHCCn8idfmIlAH4idm6YlQBYp8FMAzRmGzIbhLjmABRmGwc8V1CYbTDTAIXZBrsb4S1Vwhko0GFECxrUGNGCAl22nUHxAhrhDLYEtDLhDBRoEM5AAYc7awlnoBHQCGegENAIZ6AR0AhnoBDQCGegEdAIZ7CbLuEMNKgRzqAYAY1wBhoBjX1noBDQ2EYLJuTdWMudx2BCzpMCHHICM/IdfeLMJpiR6yxnmecHhuQ5nM6NGmBKgxktKNBjRgsa1JjRggKZzwxzGy3YUGWoAeGONhhqgB3Z9tXWeXCgMNpgqAF2dNmpARoc0gWAAi26AAizE6ALAHvsX5fY4aGBfCfAWgBkwXa7Iy/ahCzYrgnwjh3IguXuIK7XhmzY7Q7imBNko8XwDDQos5EWFKizkRYUsNhWy+lgyM4Ba04QVOJkzQkUEidpEzQSJ2kTNBInaRMUEidpEzQSJ2kTNBInQ1pQSJysbYJG4mRtE/JSY0sQKNBiJy1owE5a0OAwhAMow5OTi2dunXHxk/HJMOyvYPj7x7+f+fjHr/F6tv84iuztLScXN3dP4txdjgdhPv93v//7eY2/PryL07Oux8WAwenNpyc1rk4CfPy//ff5Ff/9EadpFV+LAcNLRcm+cvs+tGD25+cN/Btl+qz7mWoMLp48cBGWZv983syHCD3b974nmb/6/uHJC7chlWnbNItTNB+X640/PXniLhzRPn7eToSp81B/qnHy5I/bUJ77rzs0+/xvfM3AkfoWx+Enj54FU6P9s8uzz39E51lHfa/G7ZNXwphvfNip2ef/4gtoZeVFpxO/mj3dBfHU/97t2effo/Osplye3Xj27Ok0gIc+3KPZ53+i86ypW54NfGsWRED7fZ9nn6NLnF3d8mzs3bOnANYF/trrWXyjjQPV8uzCv2eX/p/5v3s9i6/jPEyrPAsice7V7PPHhCZoEiedbv179hT2kPYbfyc0QetH6tl7PAtpglaN1bMTPPPBtvcLN/AMzxzS0Nx7hmfJetbWPFF3QX2Wqmc9zaMBY/rNVD3bckhA5uSm/3WnAOZniXpW02sDQhjUXuJZSJNaofuoTijPUvWsrXqxhu+O86GPZ55QPSHsd9/209OZ/+f9IVHPKqoXuLz3qtmnAI48/ZGoZzW9NuBrieYzooVwECVVz46Ur6V9f5d0OEvWs7b6RUEXvkJaCKcDkvWsp3/98cCPaWGcE07Vsw17t6vyf3R8pa7apyGe+aTq6e0U78+ubhObaSTtWcPHfaE/UujJydnaTZ9Xe68Fvfr+nz4UMmsm7FmzmG9BeShgr5m0Z+1CXuc+LOTVGil71i/k23ZOi3qdY7qeHei3m/m5K2RxlrRn1QK+1emkmMVZ0p7V9VY3nXFbzOIsac8axXt72LigxVnSnrULN9aw28Z228ezEOio3OfukMFdUYuzpD3rF22scVXY4ixtzw6KNda4LG5xlrZn1UK9dfP0qbjFWdqe1Yo01nivOzkbjkbn02cmo9GgKJ6NvnMc8GDjKGjNBg9qxdloOr9fvWRxfX4csGfHk+l8sXz5kR8X19NRGFvvmgUaa9zoFGfH54vVFpbXk12BbTD+Gv7GQ13PBuPZ1k/8/KHn01FgA7SgPbvQKM6G54+r3czHW77tyc8I+Hg90vJseH6/2s9yPvE74ukWZnymsaw5mht8Z6vH8w3/+OSVn48TBc/MJNvzA/EwQAtYM8vj7FmKs8mj6Ve2nL4ybbBB0MeRsGdmv4oXH3sYhGeVgD27ky7ORo9WX9mLcDXYHFZmkp5NHlcZuPZlWrUYY9pL4eJsuLD9xhbH+zT78t8MpDzLZplH06qFGNOeChdn0yzf2HSfZl9qIhnPRverHMx8tAS1Ioxp38sWZ8cZv7b74z2avUqdjjwbzFf5WE78DmpD9WwgW5xNlpm/sevxaLb7fz1y7tn5cpWbxdCnZ81APbPbpHFj+a9fryRZOPYsdzDzFNJa4Y9pz+zubbSrPgb3K1lGTj0bLV19rmvdKq0dvGeW9/PZXUN7LK3ZeiuQ37Nzhx/sfujLs26ImlmunttdpXG8XIkzcOeZ2xS/1NzS0Qt9OeBWsDjT0Gw1duXZYOH6o2kWaYF7diFYnKlo9mPMltcziUpygmffGAsWZ0MVzdY6zlyeyTQseqKVQ17etFw9t7odVLzT/L6e7sQzqU+rJlo14OVNywHtldU/vlgp4cQzsR/FBM8sB7R3VsXZ9apInsl9Wq2uM2DPLFfPrYqzyapInk0FP95yqOxZaJcFWQ5orYoznVbTlWdj0c93r7zAGdgyuuWA1q44u18VyDPpxniWtGd2x5vs3uI6XRXJM/GOZZywZ3YDWrs3BByviuTZufgnXA6S9czyvbDjYLNmbs+GCh9xnqpnlgNau3dSn6+K5JnKnG+cqGd3gsXZYFkkz3QGMI/imbMd4vazK8lzJ7NVgTwbPOp8yGmKnlm+IcDu3MlwVSTP1DrjYXqeWR5vsjx3cl0kz/Ry/HVynlkOaC0PBauHs1yeKQ76hql5diNZnFlXZ8v5dPz14rrz2ULdM+twtpidf/2w4+l8GVZAC86zM8lzJ5bf3OPsxW6GwXiu65ndBObV5VPHM7seYpCUZ5YDWttXuNp8c5vulhpea3pmI8qmizOsruGYpuTZ4JPguRO7b27Lc7e+8iW7Zxb7NLadMJ+ax+/HlDy7Ezx3YrWyeX/saj0hu2fmWfp8+/9j80W2cTqeXQpubbQaasx3GWy3ey2zZwPjXmXXBbQD8//PyXh2Kri18StLN82XlWiZPTNdctq39fo6hE4gJM8sB7RX1n9g7OqXbSNaZs/mbjQzF22ShmeWx5vu7H9+hg/8fv+/PJL3bODMDtNDefM0PLsSLs5Mu02jkxlTcc8Mg6/JrmvTnd9JeHYmubXRpts8N/rH7qU9Mwu+Zjt6xt47zmA8szzedJnhT5gNJBZm/9hI2jOz4Gv4rpOFs9hYcM8sB7R3Wf7G3OU3Z1xdZ/Rs6PJHYfiv3cfv2a3guROrqYbpN2e88yOjZ2OnPwrDX4WGZ173bV9Kbm20EmPkODxm9Wzq9EdhWJuOIvfM8v6pbC+jmzhOHSNRzxaOC3ejf09uLT2IcyiWx5syvoxu6q7ZtKnUM3pmkuSXrn9l11F7NhBePbf5RdsUfjNBzwautRi4zcNF9OxKdGujVfix6rhGgp6NHKdNw59ZzJ6dym5t/IH7AkXQM6M0ZxXYz53/i9k88/UasffCWxut2k27hmsh59nUdfA1i5Ajec883bNnebzpLvMvbuT+9zyT88zkn565j+dinnm/z/FGfPXcYvBpuXd5IufZwnFv3DdbkZ3G6tmZ9NZGq0y0EAiRcp5ZBp9FGJ55udfd8njTVV/WM8v50cCvZ8fuH4CCZz7eU2G7ej4Q9sz2Mct5du9+CCHwQzOn7NWzO4XV82J6JjDsmrgvHMzx+t6dS/GtjWtcu6+si+XZKBDPOtqajeW3NlqWwSOBfxPP+i/fi6i9AW2osLURz8LwzOP7hC1Xzz/lXRIx2S5me7KMvJnBs6auZ1cKWxuL2wcs4+oDWmue6S6kn2psbSyuZ4u45hoNX569V9naKOyZ5znt0P8PLYtnmhs2lLY2su5kWaBKeVZb80xzgVNpa+OLKYr7g2VjOc8Euhaf65try06aC5xnSlsbswcfZyFScP+ZpRQ+9wWte6a3IGB59vzGyR89dv+c5349W/j+/59pOUDPM8utjQ+ONhO7Pu5kePA4m2fuo6/XfdsvPNMa1KptbXyJyTmUufMIkdEz99Fn7r5uMKbjwzO9rY32dbDVD/pc0DOj6DtzHXw1lgNKpaMQi7MrZ3/YqGq36eHuJT0zib4228yNemOpMW3zhWcqg1rNrY326y42idPwIpeMnhmlOYsdtUb/nsaYVmlQe+unODMup8yH7DNRz6Zu44/rS2yyj2l1BrUXnooz4/bQ+KsbLEU9G7n9Vfi9l+rF+KxUltfsxFdxZpw6jL860xtqM3pmdtj92mk4E7tn76CkO0DzV5yZ94eGFZrp3cKZPbt3+asw+4mJ3Rv6UjP5wYa/4sy8QDO8HcX4pThZPTOLl2aTCM/3IHdeedYKqzg7c/33De91N4mipi8rye6Z4TV+JisYA8/3urdfeSY82DjxsaxpXwyblCkWL0TJ6pnpS4IMekTf76lovPKsFlJx9uB+rc30vTvXrgJELs8MfxUFeO9O/ZVnsoONW/09Z5kmG/tFG5q/bDCHZ6a/ivDfI1Z95Zlow+m7OLN65IsA3oto/KtY7qrfB8bvpZW7nLb82rNexMWZRcf5vHQ4yjkeceDZzPhvbF8vGpm/QVnurTuvNRMcbFjuOXu6u83NzcXF6UmmjvPbz3tzSBvdr7Q8G67y/iwGFq9zl3tvdfuNZ3I7Niyv0nDH7dkwYyxazt4OQce2b0fP41nf5o8t3lbxw2ubBC/37oDmG8/qgWRNx6qdZGoUnycc52s19mA8e1ytND2bWP2h5fV4LQQfn9sF3qXc24QbbzwTazhvn7xyM7CveX4EisVsOp3OF1kcy+lZ3/pvLhfzLx92tri3/phyXcDbdlNsJX385JmH9/Y1jyPyeDbR+5hDOc/etJulUlfmLz349uznWul1kTzrP2p9SsFw1nurmVDDefLkn+/3DQ0L5ZlWQBOszja0m1IrnDcBePbjio5ZkTzr3+t8SLlmc1MbILR1e/gUBKeZWk53nv2WxbORymd8FAxnrzZtf+NA4g+dheHZQ7Z5vjPPfs3imfk+tzyMBDXrVzZ4JrLydBOGZz/uUb4vkmca4XcuqVl/k2YijUAgmv1YMz0ukmcKrYBkE7C5DRBpBE5C8ezp+/OcFskz+cw5Fg1nRxs9O4y2PFt/AcF9kTyTzpwzUc02tgEijcBFMJ5dZttB5tkz4Z7zXlaz12fq5FYEroLx7NbHgk5+z0Q7ZNnibPNqgMyZp9tgPHvIsLM2BM8EP+3yWDictbd4Vo/Ys6eMe7vUPPtj2zNcFLMH2LIaILM16CZIzwZKvcDPbarDHJ5JfdqJtGYbNgVJnUW5CNIzrfWntQPj+z37ra8rmrxm/W2auZ/UnobpmVLTuTY1+HuvZzs2gUmIpqBZZ6tnzie174PR7FNfX7S1AujjPs3+2/UY3YumoNmWKa3MpPYhvLmGnmhrY4O9Gzb+3PkYB267TvFO8yuHWz1zv3f7MhTP3ryMbCjeDLxYov4vc3nmfuvcvYpmm/Zsi71XeBiKZydqfdzmucHHHGnz23jZWQCeD1Q0216eSRzivAqyPNMY2L5c1BlmnGqsZXpHv4vzvg5HOzxzX6BZvqFaLW3mjRGPs+m91QbCnQHtv3cmz3JWnJy5szwTOVwXxGhj25uvs8aIb3cNjJYW2+7f/ZujOvu+qp43pC2nfTV2lGciex1DyJzbbyCa5vm2dpR4bw+r/ZK12XzxcXNVafOhnma7yjOZQ0/+Rdt1A9Gx9frhYri/l9h0JvLDNs3+sXiYOSYci1FfkaOdnoncfuB7t+Oeu7snVidyH8cGTevm9PRh83Djz3dWT3N4XQDLdpdnUtegnTwErNkXWcyz0fJ1tzbYsLX6fttX+ss/G1qA3+17q5l19pwrW7ZjcVP03u0Lf23npcG4aGAW0x43LdeMHw3+ox8h7XU38GemkmkwsekIHqdDbcv6rT2eSV1PNTi987O/8cTwA473nvmYb9uwtfalL6/3BY5fPv4Iav/+9eFd5gc6NLx86vFaPZQ9U9/j2YHcnx6e3WhHtZuxVZDYodp8sissDsbTZyaGw6lffn0m/wOdzPck0MX0uO+Hyh7PpK4N+v6FnJxeXFxcfb3cU3bd/PbmYmy/wDKaLpYbvq1xP1SOJ7PFRtkW1+cjfx+ru08zpTe+rpv3f8YXr7l6c+nsW85O1nCzcDccnU+ni6/MpuejYT98Rs8feTp//sjPcXU0Gnj+QEd7Pav2AYSnGsIXvEMq7Nes1OQpgfBUQ/5NT5ACNQPPyjwmyEnZwDPxV3FC7HRMNCNxQk7qRp4d8KAgFwdGnrk/jQKkTcW1dCBtkjhBOW2SOEEjbZI4QSNtMqoFlbTJqBY00iajWshOzcIzEidkpWzhGZuDICMtG81kXpIICXBo5ZnwcRSIlZ6dZurHUSAOmpaesfYEWahYesbaE2SgY6sZIzTIQN3aszLn68CasrVnjNBAvAt4psJjA0uqGTyjEwBLulk0oxMA8S6ATgBUugA6AdDoAlgTAFsqGT2TeGsFREsnq2Z0AmBBLbNn7A4C4aEGB+zAjkYOzxhtgPBQg9EGaAw1GG2ADQe5PCOggRHtfJrxOgEwoprTM2a1oBDOCGhgQi23Z8xqYS/d/Jqx+AQa4YyABhrhjIAGKuGMgAYa4YyABirhjIAGGuGMgAYq4YyABhrhjIAGKuGMgAYa4YyABirhjMs2QCOcsW0DNnPo2DP2ocEG2q41I6DBBqrOPeOkACiEM44+wVsOBDzj1RXwiqaEZhxOh5f0yiKecdsGvKBREoLVJ/hJV0ozZhuwxqGYZwxrQXSmwWwDXlMR9KzU4PnCV44kNSuVaQVAcqbBi9NhnVpJGFoBkG0CaAVApQmgFYBvNEoK0AqkTres4RmrAqlTLanAjse0aeloxgahtOmVlTxjiMboTIcWT5vRGZkTBLPmgaJnZM5kqZdUIXOSNcmcEEXWJHOSNcmcIEZLXzMyZ4JZs+zBM9Y5k+Ow5AUuQkiLph/NSmUueUyJbtmTZ6UKDz8hKiVvcONGOjRKHmG4kQptn5ox3GCkwXAD3FEteYbjTxRnKnBwOH46/jWjRKM4o0SDKIozpmgUZ0zRwAmtUDRjoTNmuuVgPCtV6AWi7QEqpYBgF3es1EpBwbg2To5KgUEvQA9ALwCZ6JSD86x0QC9AD8DuWrCnWgqSGt8MrSYHoKDgreZPuFE0HprhakbTSauJaGBBN2jNWOlkooFoEI9mLKkz0WCMBvFohmhFp1EqCIzRGJwhGsSiGaKhGdseYQedcrE8Y2EAzRANYtEM0dAM0SAezRANzRAN4tEM0dAM0SAezRANzRAN4tEM0dCMRXV4ph2HZogWNs1SNCAamqnANXxoxpmBhKmVSogGaGYNB4iDo1ctlRANpDWrlKKEiW1Y09mDUqSUOZ3CdJZBGvMM2k5wS70UOYd0AwF0ALVS9FS6fM+e6VZKCUDb6bvRLJfSgG6ADoBuIHJqpYRgbYA1AIo0SrOI4CU9lGZM0piaRVSkkTtVc2allChlBhyKObNcSpcauZOcSe4kZ9J3gjlH5RLQd0rnzEMk+9oOtHFBkDbB7Dt1QpoYdfSiHaAB0IabESRoIBYhTZwuwYyQxjSDkBZFMKsiFCGNysxzSGOWRpvJLK0gCwDMzAw44BaOnAsAB0hktuLJUeIc9T+rmeYrnvQDmet/hhlWyZN+gJRJ8iRlxpQ86TytukxSZtbkyTkVc5qkzOxUKdMMCzNWmSjT5AuzGqKwQCBfmCEJDQHlf4FM4/Dd1vIfy2g9aTIxDcsA07AM07AM07AMHJmW/JSjd4RlzNOYl0VELdXVKFaYlElyhb3NBjMfLUFi6bPJYTlPhVo9nfTZpSzzyWEah/BaJEz/c47YgxpzDIIaoSytoBZppdZtEMoCoxJd+9mjwSR/yudLJrIBTzpqcajWrjHFCF61ot8K2alTlBHVpNMlkqGafE1GuixgW9As0rCj22RQVtxhR70Y2zo6DUYYRc+goYe1L4GMbBkHB7VAh7i9Vo2yP7YU2uoG5lidZBltXAtjuNZpEsdir9eqjZbPJNprN6rUY6kEtsNGu+dDsUPCWIqRrdlWS5REscT7A2Hb2s3GIfU+fI9ttS+6dZ0myWajRgyDzYVb9bDRaOcQrttuN774RRkGpvn0S4h7dm6fdd3n/6TxLFeV/AhOzHsBVgEAAABAIfkfR81Y1ywmEeIAAAAASUVORK5CYII="/>
			</a>
		</div>
		<div class="chat-icon hotline" style="" id="fb-messenger">
			<a href="tel:<?=str_replace(" ","",$config['contact_hotline'])?>" class="hotline-button">
				<div class="hotline-icon">
					<i class="fa fa-phone"></i>
				</div>
				<span class="hotline-text">GỌI CẤP CỨU KHẨN CẤP</span>
			</a>
		</div>
    </body>
    <?php $this->endBody(); ?>
    </html>
<?php $this->endPage() ?>