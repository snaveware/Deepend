<form id="login-form">
	<p>
		<span id="close" style="position:relative;top:0;left:90%;font-size:30px;color:
		var(--base-text-color-2);cursor:pointer;">&times;</span>
		<center><img src="<?= base_url()?>/assets/images/deepend-logo-border-sm.png" alt=""></center>
	</p>
	<div class="error-1"id="login-errors"></div>
	<div class="input-section">
		<p class="form-p">
			<label for="email"><i style="color:var(--base-link-color-2);margin-right:10px;font-size:20px;" 
			class="fa fa-user"></i></label>

			<input type="email"name="email"id="email-input"class="input-1"
			placeholder="janedoe@gmail.com" required >
		</p>
	</div>
	<div class="input-section">
		<p class="form-p">	
			<label for="password"><i style="color:var(--base-link-color-2);margin-right:10px;font-size:20px;" 
			class="fa fa-lock"></i></label>

			<input type="password"name="password" id="password-input" class="input-1"
			placeholder="Password" required>
		</p>
	</div>
	<div class="submit-section">
		<table>
			<tr>
				<td><input style="margin:5px;" 
				type="checkbox"name="keep"value="false"id="keep"></td>

				<td><small>keep me logged in</small></td>
			</tr>
		</table>
		<input type="submit"name="login"value="Login" class="full-btn">
	</div>
	<div class="form-redirects">
		<small>Signup <a href="<?= base_url()?>/join">here</a></small>
	</div>
</form>