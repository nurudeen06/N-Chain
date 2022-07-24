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
                        <h2 class="card-title text-center mb-0 flex-grow-1">WALLET DEPOSIT</h2>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                        	<form method="post" action="coin_deposit.php">
                            <div>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                    	<label>Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" name="amount" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                    	<label>Currency</label>
                                        <div class="input-group">
                                            <select class="form-control" name="currency">
                                            	<option value="bitcoin" selected>BITCOIN (BTC)</option>
												<option value="litecoin">LITECOIN (LTC)</option>     
												<option value="bitcoincash">BITCOIN CASH (BCH)</option>
												<option value="dogecoin">DOGECOIN (DOGE)</option>      
											</select>
                                        </div>
                                        <ul>
                                        	<li>Minimum: : $<?php echo number_format($min_deposit,2) ?> USD</li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                            <div>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                    	<button type="submit" name="deposit" class="btn btn-success" >Deposit</button>
                                    </div>
                                    
                                </div>
                            </div>
                            </form>
                            
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


 <!-- Modal -->
<div class="modal fade" id="toast" tabindex="-1" aria-labelledby="toast" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="toast">IMPORTANT NOTICE!</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        You are required to send the exact amount that will be displayed in the next page.
Don't include transaction fee in this amount.
<br>

If you send any other amount greater or less than the amount generated, payment system will ignore it!
      </div>

      <div class="modal-footer">
       
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-primary">CONTINUE</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->




<script type='text/javascript'>
    $(window).on('load', function() {
        $('#toast').modal('show');
    });
</script>

<?php 
include 'footer.php';
?>