<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>POS - Point of Sale and Inventory Management System</title>
    <meta name="description" content="Inventory &amp; Point of Sale System">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Pricing-Centered-badges.css">
    <link rel="stylesheet" href="assets/css/Pricing-Centered-icons.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
            include_once 'functions/authentication.php';
            include_once 'functions/sidebar.php';
        ?>


<div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><span>Sangam Jutta Pasal</span></div>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center p-4">
                                    <h6 class="text-uppercase text-muted card-subtitle">TOTAL</h6>
                                    <h4 class="display-4 fw-bold card-title">Nrs.<?php include_once 'functions/pos-total.php'; ?></h4>
                                </div>
                                <div class="card-footer p-4">
                                    <form class="text-center" method="post">
                                        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="button" data-bs-target="#purchase" data-bs-toggle="modal">Purchase&nbsp;</button></div>
                                    </form>
                                    <div class="card" style="margin-top: 16px;">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Items</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                                <table class="table table-hover table-bordered my-0" id="dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Code</th>
                                                            <th>Product Name</th>
                                                            <th>Size</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php include_once 'functions/pos-history.php'; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <div class="d-flex flex-row" id="content-wrapper">
            <div id="content">
                <!-- 导航栏保持不变 -->
                
                <div class="container">
                    <div class="row">
                        <!-- 左侧栏保持不变 -->
                        
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-primary m-0 fw-bold">Products</p>
                                    <div class="search-box">
                                        <input type="text" id="search-input" class="form-control" placeholder="Search products...">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable-2" role="grid">
                                        <table class="table table-hover table-bordered my-0" id="products-table">
                                            <thead>
                                                <tr>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <th>Size</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody id="products-body">
                                                <?php include_once 'functions/pos-view-products.php'; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 其他modal保持不变 -->

    <script src="assets/js/jquery.min.js"></script>
    <script>
        // 搜索功能
        $(document).ready(function() {
            // 防抖函数，减少请求频率
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // 搜索请求函数
            const searchProducts = debounce(function(searchTerm) {
                $.ajax({
                    url: 'functions/pos-search-products.php',
                    method: 'POST',
                    data: { search: searchTerm },
                    success: function(response) {
                        $('#products-body').html(response);
                    },
                    error: function(xhr) {
                        console.error('Search error:', xhr.statusText);
                    }
                });
            }, 300);

            // 输入事件监听
            $('#search-input').on('input', function() {
                const searchTerm = $(this).val().trim();
                if (searchTerm.length >= 1 || searchTerm === '') {
                    searchProducts(searchTerm);
                }
            });
        });

        // 原有的其他JavaScript代码保持不变 -->
    </script>
</body>
</html>