<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Enzo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ url('') }}/html/assets/images/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('') }}/html/assets/images/favicon/favicon.png" type="image/x-icon">
    <title>Permohonan</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/datatables.css">

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('') }}/html/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/responsive.css">
  </head>
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search In Enzo {{ url('') }}/html" name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading{{ url('') }}/html.</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{ url('') }}/html/assets/images/logo/login.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>

          <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">


                <li class="profile-nav onhover-dropdown p-0 me-0">
                <div class="d-flex profile-media"><img class="b-r-50" src="{{ url('') }}/html/assets/images/dashboard/profile.jpg" alt="">
                  <div class="flex-grow-1"><span>My Account</span>
                    <p class="mb-0 font-roboto">detail <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="{{route('profile.show')}}"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="{{ route('profile.changepassword')}}"><i data-feather="file-text"></i><span>Change Password</span></a></li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link" style="color: inherit; padding: 0; border: none;">
                            <i data-feather="log-in"></i> <span>Log Out</span>
                        </button>
                    </form>
                </li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{ url('') }}/html/assets/images/logo/logo.png" alt=""></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="fa fa-cog status_toggle middle sidebar-toggle"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ url('') }}/html/assets/images/logo/logo-icon1.png" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ url('') }}/html/assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>

                  <li class="sidebar-main-title">
                    <h6 class="lan-1">General </h6>
                  </li>
                  <li class="menu-box">
                    <ul>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{route('home')}}"><i data-feather="home"> </i><span>Dashboard</span></a></li>
                        <li class="sidebar-list">  <a class="sidebar-link sidebar-title link-nav" href="{{route('permohonan.index')}}"><i data-feather="file-text"> </i><span>Permohonan</span></a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
            @yield('isi')
            <footer class="footer">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6 p-0 footer-left">
                      <p class="mb-0">Copyright © 2023 Enzo. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 p-0 footer-right">
                      <ul class="color-varient">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>
                      <p class="mb-0 ms-3">Hand-crafted & made with <i class="fa fa-heart font-danger"></i></p>
                    </div>
                  </div>
                </div>
              </footer>
            </div>
          </div>
          <!-- latest jquery-->
          <script src="{{ url('') }}/html/assets/js/jquery-3.6.0.min.js"></script>
          <!-- Bootstrap js-->
          <script src="{{ url('') }}/html/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
          <!-- feather icon js-->
          <script src="{{ url('') }}/html/assets/js/icons/feather-icon/feather.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/icons/feather-icon/feather-icon.js"></script>
          <!-- scrollbar js-->
          <script src="{{ url('') }}/html/assets/js/scrollbar/simplebar.js"></script>
          <script src="{{ url('') }}/html/assets/js/scrollbar/custom.js"></script>
          <!-- Sidebar jquery-->
          <script src="{{ url('') }}/html/assets/js/config.js"></script>
          <!-- Plugins JS start-->
          <script src="{{ url('') }}/html/assets/js/sidebar-menu.js"></script>
          <script src="{{ url('') }}/html/assets/js/chart/chartist/chartist.js"></script>
          <script src="{{ url('') }}/html/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
          <script src="{{ url('') }}/html/assets/js/chart/knob/knob.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/chart/knob/knob-chart.js"></script>
          <script src="{{ url('') }}/html/assets/js/chart/apex-chart/apex-chart.js"></script>
          <script src="{{ url('') }}/html/assets/js/chart/apex-chart/stock-prices.js"></script>
          <script src="{{ url('') }}/html/assets/js/prism/prism.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/clipboard/clipboard.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/custom-card/custom-card.js"></script>
          <script src="{{ url('') }}/html/assets/js/notify/bootstrap-notify.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/dashboard/default.js"></script>
          <script src="{{ url('') }}/html/assets/js/notify/index.js"></script>
          <script src="{{ url('') }}/html/assets/js/slick-slider/slick.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/slick-slider/slick-theme.js"></script>
          <script src="{{ url('') }}/html/assets/js/typeahead/handlebars.js"></script>
          <script src="{{ url('') }}/html/assets/js/typeahead/typeahead.bundle.js"></script>
          <script src="{{ url('') }}/html/assets/js/typeahead/typeahead.custom.js"></script>
          <script src="{{ url('') }}/html/assets/js/typeahead-search/handlebars.js"></script>
          <script src="{{ url('') }}/html/assets/js/typeahead-search/typeahead-custom.js"></script>
          <script src="{{ url('') }}/html/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
          <script src="{{ url('') }}/html/assets/js/datatable/datatables/datatable.custom.js"></script>

          <!-- Plugins JS Ends-->
          <!-- Theme js-->
          <script src="{{ url('') }}/html/assets/js/script.js"></script>
          <script src="{{ url('') }}/html/assets/js/theme-customizer/customizer.js"></script>
          <script>
             $(document).ready(function() {
                var table = $('#applicationTable').DataTable();

                $('#searchBtn').on('click', function() {
                    var name = $('#searchName').val().toLowerCase();
                    var aplikasiNomor = $('#searchAplikasiNomor').val().toLowerCase();
                    var startDate = $('#searchStartDate').val();
                    var endDate = $('#searchEndDate').val();
                    var branch = $('#searchBranch').val().toLowerCase();

                    // Reset the search
                    table.columns().search('');

                    // Apply custom search
                    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                        var data = this.data();
                        var match = true;

                        // Check each condition
                        if (name && !data[0].toLowerCase().includes(name)) match = false; // Nama Pemohon
                        if (aplikasiNomor && !data[1].toLowerCase().includes(aplikasiNomor)) match = false; // Nomor Aplikasi
                        if (branch && !data[4].toLowerCase().includes(branch)) match = false; // Cabang

                        // Date filtering
                        var date = new Date(data[3]); // Tanggal Aplikasi
                        if (startDate && date < new Date(startDate)) match = false; // Check start date
                        if (endDate && date > new Date(endDate)) match = false; // Check end date

                        // Show or hide the row based on the match result
                        if (match) {
                            $(this.node()).show(); // Use jQuery to show the row
                        } else {
                            $(this.node()).hide(); // Use jQuery to hide the row
                        }
                    });

                    table.draw();
                });



                // Clear search fields
                $('#clearBtn').on('click', function() {
                    $('#searchName').val('');
                    $('#searchAplikasiNomor').val(''); // Reset searchAplikasiNomor
                    $('#searchStartDate').val('');
                    $('#searchEndDate').val('');
                    $('#searchBranch').val('');
                    table
                        .search('')
                        .columns().search('')
                        .draw();
                });
            });
          </script>
        </body>
      </html>
