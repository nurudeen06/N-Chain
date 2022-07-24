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

 ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h2 class="card-title text-center mb-0 flex-grow-1">WITHDRAW BALANCE</h2>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                        	<form method="post" action="deposit.php">
                            <div>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                    	<label>Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" aria-label="Amount (USDT)" placeholder="Amount (USDT)">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <label>Wallet Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">-</span>
                                            <input type="text" class="form-control" placeholder="(USDT) TRC-20" aria-label="">
        
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <ul>
                                    <li>Minimum: $20.00 USDT</li>
                                    <li>Fee: $1.00 USDT</li>
                                </ul>
                            </div>
                            <!-- <br> -->
                            <div>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                    	<button type="submit" name="deposit" class="btn btn-success" >Withdraw</button>
                                    </div>
                                    
                                </div>
                            </div>
                            </form>
                            <p>Once you have submitted your withdrawal request, you will receive a confirmation email that notify you about the success of your withdrawal. Withdrawals are credited within 45 minutes. It is subject to change depending on the TRC20 network.</p>
                        </div>
                        

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
                    <!--end row-->

    </div>
    <!-- container-fluid -->
</div><!-- End Page-content -->




<script type='text/javascript'>
    $(window).on('load', function() {
        $('#toast').modal('show');
    });
</script>

<?php 
include 'footer.php';
?>