	   <div class="container">
			
			<!-- Contact -->
			<section id="contact" class="section mb-4">

				<!--Section heading-->
		        <div class="divider-new">
		            <h2 class="h2-responsive wow fadeIn">Contact</h2>
		        </div>
				<!--Section sescription-->

				<div class="row wow fadeIn" data-wow-delay="0.4s">

					<!--First column-->
					<div class="col-md-6 mb-r">
							<?php
								if(!isset($_SESSION['send_status'])) {
									$_SESSION['send_status'] = "";
								}
								if($_SESSION['send_status']<>"") { ?>
								<div class="alert alert-info alert-dismissible fade show" role="alert">
								  <?php echo $_SESSION['send_status']; $_SESSION['send_status']=""; ?>
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>							
								</div>
							<?php } ?>
						<form class="contact-form" autocomplete="off" method="POST" action="../contact/email.php">

							<?php $_SESSION['status'] = 'NS';  ?>
							<!--First row-->
							<div class="row">
								<!--First column-->
								<div class="col-md-6">
									<div class="md-form">
										<div class="md-form">
											<input type="text" id="name" name="name" class="form-control" value="" required>
											<label for="name" class="">Your name</label>
										</div>
									</div>
								</div>

								<!--Second column-->
								<div class="col-md-6">
									<div class="md-form">
										<div class="md-form">
											<input type="email" id="email" name="email" class="form-control" required>
											<label for="email" class="">Your email</label>
										</div>
									</div>
								</div>
							</div>
							<!--/.First row-->

							<!--Second row-->
							<div class="row">
								<div class="col-md-12">
									<div class="md-form">
										<input type="text" id="subject" name="subject" class="form-control" required>
										<label for="subject" class="">Subject</label>
									</div>
								</div>
							</div>
							<!--/Second row-->

							<!--Third row-->
							<div class="row">
								<!--First column-->
								<div class="col-md-12">

									<div class="md-form">
										<textarea type="text" id="msg" name="message" class="md-textarea" required></textarea>
										<label for="msg">Your message</label>
									</div>

								</div>
							</div>
							<!--/.Third row-->

						<div class="text-center center-on-small-only">
							<button type="submit" class="btn btn-unique">Send  <i class="fa fa-paper-plane-o ml-1"></i></a>
						</div>
					</div>
					<!--.First column-->
				  </form>

                <!--Second column-->
                <div class="col-md-6">
                	<img src="../assets/images/page_images/contact-email.jpg" alt="Contact" class="img-fluid">
                </div>
                <!--/Second column-->

				</div>
			</section>
			<!--/Section: Contact v.2-->

		</div>
		<!-- /.Second container -->
