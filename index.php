<?php
if(!isset($_SESSION))
    session_start();

if(isset($_SESSION['loggedUser'])) {
    header("Location: painel.php");
}

include("login/Config.php");
include("login/Register.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trabalho de Estatística</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/toastr/toastr.min.css">
    </head>
    <body>
	<p id="resultdb"></p>				
        <div class="top-content">        	
            <div class="inner-bg">
                <div class="container">                	
                     <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Keystroke Boladão</h1>
                            <div class="description">
                            	<p>
									Trabalho destinado à disciplina de Estatística
									Aplicada do curso de Ciência da Computação da Universidade Federal de Sergipe.
								</p>
                            </div>
                        </div>
                    </div> 
		<!-- Login -->
					<div class="row">
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Faça Login</h3>
	                            		<p>Entre com o usuário e senha:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="ola.php" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Usuário</label>
				                        	<input type="text" name="username" placeholder="Usuário"
												   class="form-username form-control" id="form-username" required>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Senha</label>
				                        	<input type="password" name="password" placeholder="Senha" minlength=5 maxlength="5"
												   class="form-password form-control" 
												    id="form-password" onkeydown="registerKey(event)" required>
											<input type="hidden" id="attempt" name="attempt" value="0">
				                        </div>
				                        <button type="submit" name="login" class="btn btn-login">Entrar</button>
				                    </form>
			                    </div>
		                    </div>
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
         <!-- Register -->
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Regristre-se</h3>
										<p>Registre-se antes de fazer login:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom" style="PADDING: 25px 25px 90px 25px !IMPORTANT;">
				                    <form role="form" action="" method="post" class="registration-form">
										<div class="form-group">
											<label class="sr-only" for="form-register-username">Usuário</label>
											<input type="text" name="username" placeholder="Usuário"
												   class="form-username form-control" id="form-register-username" required>
										</div>
										<div class="form-group">
											<label class="sr-only" for="form-register-password">Senha</label>
											<input type="password" name="password" placeholder="Senha" minlength=5 maxlength="5"
												   class="form-password form-control" id="form-register-password" required>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" style="font-size: 85% !important; 
												padding: .2em .4em .3em !important;">
													<select name="sex" id="sex" class="select">
														<option value="homem" selected> Homem </option>
														<option value="mulher">Mulher</option>
													</select>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<button type="submit" name="register" class="btn">Registrar</button>
										</div>
				                    </form>
			                    </div>
                        	</div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
					<div class="col-sm-12">
						<div class="footer-border"></div>
						<p>Arianne, Jusley, Lawrence, Micael. <br>Universidade Federal de Sergipe - UFS.</p>
					</div>
        		</div>
        	</div>
        </footer>

        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/toastr/toastr.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>