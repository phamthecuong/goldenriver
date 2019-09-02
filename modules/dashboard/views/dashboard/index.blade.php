<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>
@extends('layouts.admin.main')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="widget style1 navy-bg">
                <div class="row vertical-align">
                    <div class="col-3">
                        <i class="fas fa-save fa-3x"></i>
                    </div>
                    <div class="col-9 text-right">
                        <h3>Danh mục</h3>
                        <h2 class="font-bold">{{ \Modules\cms\models\Category::getInstant()->statisticCategory() }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget style1 navy-bg">
                <div class="row vertical-align">
                    <div class="col-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <div class="col-9 text-right">
                        <h3>Thành viên</h3>
                        <h2 class="font-bold">{{ \Modules\core\models\User::getInstance()->statisticUsers() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="widget style1 navy-bg">
                <div class="row vertical-align">
                    <div class="col-3">
                        <i class="fa fa-rss fa-3x"></i>
                    </div>
                    <div class="col-9 text-right">
                        <h3>Bài đã viết</h3>
                        <h2 class="font-bold">{{ \Modules\cms\models\Post::getInstance()->statisticPost() }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget style1 navy-bg">
                <div class="row vertical-align">
                    <div class="col-3">
                        <i class="fas fa-vote-yea fa-3x"></i>
                    </div>
                    <div class="col-9 text-right">
                        <h3>Bài đã đăng</h3>
                        <h2 class="font-bold">{{ \Modules\cms\models\Post::getInstance()->statisticPublicPost() }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget style1 navy-bg">
                <div class="row vertical-align">
                    <div class="col-3">
                        <i class="fas fa-chess-queen fa-3x"></i>
                    </div>
                    <div class="col-9 text-right">
                        <h3>Bài nổi bật</h3>
                        <h2 class="font-bold">{{ \Modules\cms\models\Post::getInstance()->statisticFeaturePost() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

