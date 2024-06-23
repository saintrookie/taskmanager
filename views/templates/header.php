<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo is_null($title) ? 'Dashboard' : $title; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_DIR;?>/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<body class="app">
  <div id="loader">
      <div class="spinner"></div>
  </div>

  <script>
      window.addEventListener('load', function load() {
          const loader = document.getElementById('loader');
          setTimeout(function () {
              loader.classList.add('fadeOut');
          }, 300);
      });
  </script>
  <div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
          <div class="peers ai-c fxw-nw">
              <div class="peer peer-greed">
                <a class="sidebar-link td-n" href="<?php echo BASE_URL;?>">
                    <div class="peers ai-c fxw-nw">
                      <div class="peer">
                          <div class="logo">
                            <img src="<?php echo BASE_DIR;?>/images/logo.png" alt="">
                          </div>
                      </div>
                      <div class="peer peer-greed">
                          <h5 class="lh-1 mB-0 logo-text">The Task Manager</h5>
                      </div>
                    </div>
                </a>
              </div>
              <div class="peer">
                <div class="mobile-toggle sidebar-toggle">
                    <a href="" class="td-n">
                    <i class="fa fa-arrow-circle-left"></i>
                    </a>
                </div>
              </div>
          </div>
        </div>

        <!-- ### $Sidebar Menu ### -->
        <ul class="sidebar-menu scrollable pos-r">
          <li class="nav-item mT-30 actived">
              <a class="sidebar-link" href="<?php echo BASE_URL;?>">
              <span class="icon-holder">
                  <i class="color-primary fa fa-home"></i>
              </span>
              <span class="title">Task List</span>
              </a>
          </li>
        </ul>

    </div>
  </div>
  
  <div class="page-container">
  <div class="header navbar">
    <div class="header-container">
      <ul class="nav-left">
        <li>
          <a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);">
            <i class="fa fa-bars"></i>
          </a>
        </li>
      </ul>
      <ul class="nav-right">
        <li class="dropdown">
          <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-bs-toggle="dropdown">
            <div class="peer mR-10">
              <img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/lego/7.jpg" alt="">
            </div>
            <div class="peer">
              <span class="fsz-sm c-grey-900">Admin</span>
            </div>
          </a>

        </li>
      </ul>
    </div>
  </div>
  <main class="main-content bgc-grey-100">
  
