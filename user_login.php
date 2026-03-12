<?php

//user_login.php

include 'database_connection.php';

include 'function.php';

if(is_user_login())
{
	header('location:issue_book_details.php');
}

$message = '';

if(isset($_POST["login_button"]))
{
	$formdata = array();

	if(empty($_POST["user_email_address"]))
	{
		$message .= '<li>Email Address is required</li>';
	}
	else
	{
		if(!filter_var($_POST["user_email_address"], FILTER_VALIDATE_EMAIL))
		{
			$message .= '<li>Invalid Email Address</li>';
		}
		else
		{
			$formdata['user_email_address'] = trim($_POST['user_email_address']);
		}
	}

	if(empty($_POST['user_password']))
	{
		$message .= '<li>Password is required</li>';
	}	
	else
	{
		$formdata['user_password'] = trim($_POST['user_password']);
	}

	if($message == '')
	{
		$data = array(
			':user_email_address'		=>	$formdata['user_email_address']
		);

		$query = "
		SELECT * FROM lms_user 
        WHERE user_email_address = :user_email_address
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		if($statement->rowCount() > 0)
		{
			foreach($statement->fetchAll() as $row)
			{
				if($row['user_status'] == 'Enable')
				{
					if($row['user_password'] == $formdata['user_password'])
					{
						$_SESSION['user_id'] = $row['user_unique_id'];
						header('location:issue_book_details.php');
					}
					else
					{
						$message = '<li>Wrong Password</li>';
					}
				}
				else
				{
					$message = '<li>Your Account has been disabled</li>';	
				}
			}
		}
		else
		{
			$message = '<li>Wrong Email Address</li>';
		}
	}
}

include 'header.php';

?>


<!-- extra part -->
<!-- <div class="d-flex align-items-center justify-content-center" style="height:700px;">
    <div class="col-md-6">
        <?php 

		if($message != '')
		{
			echo '<div class="alert alert-danger"><ul>'.$message.'</ul></div>';
		}

		?>
        <div class="card">
            <div class="card-header">User Login</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="text" name="user_email_address" id="user_email_address" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <input type="submit" name="login_button" class="btn btn-primary" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-3">
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-5 text-center">User Login</h1>
                        <form method="POST" class="needs-validation" novalidate="" autocomplete="on">
                            <?php 
                                if(isset($error)){
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                }
                            ?>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                <input id="user_email_address" type="email" class="form-control"
                                    name="user_email_address" placeholder="Please Enter Email Address"
                                    value="<?= isset($email) ? $email : '' ?>" required autofocus>
                                <?php 
                                        if(isset($input_errors['email'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['email'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                    <!-- <a href="forgot.html" class="float-end">
											Forgot Password?
										</a> -->
                                </div>
                                <input id="user_password" type="password" name="user_password" class="form-control"
                                    placeholder="Please Enter Password" required>
                                <?php 
                                        if(isset($input_errors['password'])){
                                            echo '<span style="display: block;color: red; margin-top: 10px;">'.$input_errors['password'].'</span>';
                                        }
                                    ?>
                            </div>

                            <div class="d-flex align-items-center">

                                <button type="submit" class="btn btn-dark ms-auto" name="login_button" value="Login">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-4 mb-3 border-0">
                        <div class="text-center">
                            Don't have an account? <a href="user_registration.php" class="text-dark">Create One</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<?php 

include 'footer.php';

?>