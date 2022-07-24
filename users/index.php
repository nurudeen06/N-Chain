<?php 
include 'header.php';
?>


<div class="page-content">
    <div class="container-fluid">
<?php 
	if ($msg != "") {
		echo customAlert("success", $msg);
	}
	if ($err != "") {
		echo customAlert("error", $err);
	}

	$sql = "SELECT * FROM users WHERE referral = '$username' ";
	  $result = mysqli_query($link,$sql);
	  if(mysqli_num_rows($result) > 0){
		
      $total = mysqli_num_rows($result);
		
	  }else{
		$total = 0  ;
	  }

 ?>

 <div class="row h-100">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                                    <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                                    <div class="flex-grow-1 text-truncate">
                                                        Your free trial expired in <b>17</b> days.
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <a href="pages-pricing.html" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                                    </div>
                                                </div>

                                                <div class="row align-items-end">
                                                    <div class="col-sm-8">
                                                        <div class="p-3">
                                                            <p class="fs-16 lh-base">Upgrade your plan from a <span class="fw-semibold">Free trial</span>, to ‘Premium Plan’ <i class="mdi mdi-arrow-right"></i></p>
                                                            <div class="mt-3">
                                                                <a href="pages-pricing.html" class="btn btn-success">Upgrade Account!</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="px-3">
                                                            <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-body-->
                                        </div>
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="swiper cryptoSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-18"><i class="mdi mdi-dots-horizontal"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Details</a>
                                                <a class="dropdown-item" href="#">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="../public/assets/images/svg/crypto-icons/btc.svg" class="bg-light rounded-circle p-1 avatar-xs img-fluid" alt="">
                                        <h6 class="ms-2 mb-0 fs-14">Bitcoin</h6>
                                    </div>
                                    <div class="row align-items-end g-0">
                                        <div class="col-6">
                                            <h5 class="mb-1 mt-4">$1,523,647</h5>
                                            <p class="text-success fs-13 fw-medium mb-0">+13.11%<span class="text-muted ms-2 fs-10 text-uppercase">(btc)</span></p>
                                        </div><!-- end col -->
                                        
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end -->

                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-18"><i class="mdi mdi-dots-horizontal"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Details</a>
                                                <a class="dropdown-item" href="#">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="../public/assets/images/svg/crypto-icons/ltc.svg" class="bg-light rounded-circle p-1 avatar-xs img-fluid" alt="">
                                        <h6 class="ms-2 mb-0 fs-14">Litecoin</h6>
                                    </div>
                                    <div class="row align-items-end g-0">
                                        <div class="col-6">
                                            <h5 class="mb-1 mt-4">$2,145,687</h5>
                                            <p class="text-success fs-13 fw-medium mb-0">+15.08%<span class="text-muted ms-2 fs-10 text-uppercase">(ltc)</span></p>
                                        </div><!-- end col -->
                                        
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end -->

                 
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-18"><i class="mdi mdi-dots-horizontal"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Details</a>
                                                <a class="dropdown-item" href="#">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="../public/assets/images/svg/crypto-icons/doge.svg" class="bg-light rounded-circle p-1 avatar-xs img-fluid" alt="">
                                        <h6 class="ms-2 mb-0 fs-14">Doge</h6>
                                    </div>
                                    <div class="row align-items-end g-0">
                                        <div class="col-6">
                                            <h5 class="mb-1 mt-4">$1,820,045</h5>
                                            <p class="text-danger fs-13 fw-medium mb-0">-09.21%<span class="text-muted ms-2 fs-10 text-uppercase">(bnb)</span></p>
                                        </div><!-- end col -->
                                       
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end -->

                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-18"><i class="mdi mdi-dots-horizontal"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Details</a>
                                                <a class="dropdown-item" href="#">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="../public/assets/images/svg/crypto-icons/dash.svg" class="bg-light rounded-circle p-1 avatar-xs img-fluid" alt="">
                                        <h6 class="ms-2 mb-0 fs-14">BITCOIN CASH</h6>
                                    </div>
                                    <div class="row align-items-end g-0">
                                        <div class="col-6">
                                            <h5 class="mb-1 mt-4">$9,458,153</h5>
                                            <p class="text-success fs-13 fw-medium mb-0">+12.07%<span class="text-muted ms-2 fs-10 text-uppercase">(dash)</span></p>
                                        </div><!-- end col -->
                                        
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end -->

                    </div><!-- end swiper wrapper -->
                </div><!-- end swiper -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xxl-6 col-lg-12">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Recent Activity</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Week<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body p-0">
                        <div data-simplebar style="height: 390px;">
                            <div class="p-3">
                                <h6 class="text-muted text-uppercase mb-3 fs-11">25 Dec 2021</h6>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="arrow-down-circle" class="icon-dual-success icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Bought Bitcoin</h6>
                                        <p class="text-muted fs-12 mb-0">
                                            <i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i> Visa Debit Card ***6
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-success">+0.04025745<span class="text-uppercase ms-1">Btc</span></h6>
                                        <p class="text-muted fs-13 mb-0">+878.52 USD</p>
                                    </div>
                                </div><!-- end -->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="send" class="icon-dual-warning icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Sent Eathereum</h6>
                                        <p class="text-muted fs-12 mb-0">
                                            <i class="mdi mdi-circle-medium text-warning fs-15 align-middle"></i> Sofia Cunha
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-muted">-0.09025182<span class="text-uppercase ms-1">Eth</span></h6>
                                        <p class="text-muted fs-13 mb-0">-659.35 USD</p>
                                    </div>
                                </div><!-- end -->

                                <h6 class="text-muted text-uppercase mb-3 mt-4 fs-11">24 Dec 2021</h6>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="arrow-up-circle" class="icon-dual-danger icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Sell Dash</h6>
                                        <p class="text-muted fs-12 mb-0">
                                            <i class="mdi mdi-circle-medium text-danger fs-15 align-middle"></i> www.cryptomarket.com
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-danger">-98.6025422<span class="text-uppercase ms-1">Dash</span></h6>
                                        <p class="text-muted fs-13 mb-0">-1508.98 USD</p>
                                    </div>
                                </div><!-- end -->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="arrow-up-circle" class="icon-dual-danger icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Sell Dogecoin</h6>
                                        <p class="text-muted fs-12 mb-0">
                                        	<i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i> www.coinmarket.com
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-danger">-1058.08025142<span class="text-uppercase ms-1">Doge</span></h6>
                                        <p class="text-muted fs-13 mb-0">-89.36 USD</p>
                                    </div>
                                </div><!-- end -->
                                <div class="d-flex align-items-center mt-3">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="arrow-up-circle" class="icon-dual-success icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Bought Litecoin</h6>
                                        <p class="text-muted fs-12 mb-0">
                                            <i class="mdi mdi-circle-medium text-warning fs-15 align-middle"></i> Payment via Wallet
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-success">+0.07225912<span class="text-uppercase ms-1">Ltc</span></h6>
                                        <p class="text-muted fs-13 mb-0">+759.45 USD</p>
                                    </div>
                                </div><!-- end -->

                                <h6 class="text-muted text-uppercase mb-3 mt-4 fs-11">20 Dec 2021</h6>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="send" class="icon-dual-warning icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Sent Eathereum</h6>
                                        <p class="text-muted fs-12 mb-0">
                                            <i class="mdi mdi-circle-medium text-warning fs-15 align-middle"></i> Sofia Cunha
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-muted">-0.09025182<span class="text-uppercase ms-1">Eth</span></h6>
                                        <p class="text-muted fs-13 mb-0">-659.35 USD</p>
                                    </div>
                                </div><!-- end -->

                                <div class="d-flex align-items-center mt-3">
                                    <div class="avatar-xs flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-circle">
                                            <i data-feather="arrow-down-circle" class="icon-dual-success icon-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">Bought Bitcoin</h6>
                                        <p class="text-muted fs-12 mb-0">
                                      		<i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i> Visa Debit Card ***6
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1 text-success">+0.04025745<span class="text-uppercase ms-1">Btc</span></h6>
                                        <p class="text-muted fs-13 mb-0">+878.52 USD</p>
                                    </div>
                                </div><!-- end -->

                                <div class="mt-3 text-center">
                                    <a href="javascript:void(0);" class="text-muted text-decoration-underline">Load More</a>
                                </div>

                            </div>

                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
         </div>
    </div>
    <!-- container-fluid -->
</div><!-- End Page-content -->

<script type="text/javascript">
	function myRef() {
		 var copyText = document.getElementById("myInpu");

		copyText.select();

		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		document.execCommand("copy");

		alert("Copied: " + copyText.value);


	}
</script>

<?php 
include 'footer.php';
?>