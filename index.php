<?php

include 'database_connection.php';
include 'function.php';

if(is_user_login())
{
	header('location:issue_book_details.php');
}

include 'header.php';


?>
<div id="carouselExampleFade" class="carousel slide carousel-fade mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="upload/l.jpg" class="d-block w-100 pb-3 " alt="..." height="400px">
        </div>
        <div class="carousel-item">
            <img src="upload/l10.jpg" class="d-block w-100 pb-3 " alt="..." height="400px">
        </div>
        <div class="carousel-item">
            <img src="upload/l6.jpg" class="d-block w-100 pb-3 " alt="..." height="400px">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<div class="row align-items-md-stretch">
    <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Admin Login</h2>
            <p></p>
            <a href="admin_login.php" class="btn btn-outline-light">Admin Login</a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
            <h2>User Login</h2>
            <p></p>
            <a href="user_login.php" class="btn btn-outline-secondary">User Login</a>
            <a href="user_registration.php" class="btn btn-outline-primary">User Sign Up</a>
        </div>
    </div>

</div>

<?php

include 'footer.php';

?>