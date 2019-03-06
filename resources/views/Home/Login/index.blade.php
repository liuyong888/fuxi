@extends("Home.HomePublic.Public")
@section("title","首页")
@section("main")

			<div role="main" class="main">

				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">Pages</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h2>登录</h2>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">								
								<div class="col-sm-6">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>登录</h4>
											<form action="/login" id="" method="post">
											@if(session('error'))
											<b style="color:red">{{session('error')}}</b>
											@endif
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>邮箱地址</label>
															<input type="text" name="email" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<a class="pull-right" href="/forget_pwd">(忘记密码?)</a>
															<label>密码</label>
															<input type="password" name="password" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<span class="remember-box checkbox">
															<label for="rememberme">
																<input type="checkbox" id="rememberme" name="rememberme">Remember Me
															</label>
														</span>
													</div>
													<div class="col-md-6">
														{{csrf_field()}}
														<input type="submit" value="Login" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>
@endsection			