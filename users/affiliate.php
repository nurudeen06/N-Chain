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
        <div class="row">
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                   
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                               
                                    <div class="row">
                                    	<center><h3>AFFILIATE PROGRAM</h3></center>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Share Your Affiliate Link</label>
                                                <input type="text" readonly="" id="myInpu" onclick="myRef()" class="form-control" value="<?php echo $siteurl ?>?ref=<?php echo $username ?>">
                                            </div>
                                        </div>
                                        <!--end col-->


                                        
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2">
                                                <button type="submit" onclick="myRef()" name="update" class="btn btn-primary">Copy Link</button>
              
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-lg-12 mt-4">
                                        	<div class="hstack gap-2 p-3 border rounded">
                                        		<h4><?php echo $total ?></h4>
                                        		<span >Total Referred</span >
                                        	</div>
                                        </div>
                                        <div class="col-sm-12 mb-md-0 mb-3" <?php echo $total == 0 ? "hidden" : "" ?> >
												<div class="p-4 border rounded">
													<h5 ng-controller="MyRngCtrl" class="fs-22 text-black font-w600 mb-1">$<?php echo number_format($ref_bonus,2) ?></h5>
														<span class="fs-18">Total Earned</span>
												</div>
											</div>
                                        <section <?php echo $total != 0 ? "hidden" : "" ?> class="no-padding-top no-padding-bottom col-sm-12 mb-md-0 mb-3">
											<p class='lead'><em>You do not have any active downlines.</em></p>
 								        </section>

                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                     
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