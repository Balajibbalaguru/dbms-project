<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .header {
            background-image: url('path/to/your/header-image.jpg');
            background-size: cover;
            background-position: center;
            color: black;
            padding: 100px 0;
            text-align: center;
        }
        .header h1 {
            font-size: 4em;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 1.5em;
        }
        .content-section {
            padding: 50px 0;
        }
        .content-section h2 {
            margin-bottom: 30px;
            font-size: 2.5em;
            text-align: center;
        }
        .mission-section, .values-section {
            background-color: #f8f9fa;
            padding: 50px 0;
        }
        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }
        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .team-member h4 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .team-member p {
            color: #777;
        }
        .mission-values {
            text-align: center;
        }
        .mission-values h3 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .mission-values p {
            font-size: 1.2em;
            color: black;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-2 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./assets/logo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Den
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php"><i class="fas fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
// Assuming this data could be pulled from a database
$company_info = [
    "name" => "E-Shop",
    "description" => "Welcome to E-Shop, your number one source for all things. We're dedicated to giving you the very best products, with a focus on dependability, customer service, and uniqueness. Founded in 2023 by Thanga Vel, E-Shop has come a long way from its beginnings in Nagercoil. When Thanga Vel first started out, his passion for  eco-friendly cleaning products drove them to quit day job, do tons of research, etc. so that E-Shop can offer you the world's most advanced gadgets. We now serve customers all over India, and are thrilled that we're able to turn our passion into our own website. We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us. Sincerely, Thanga Vel."
];

$team_members = [
    [
        "name" => "Thanga Vel",
        "position" => "CEO & Founder",
        "image" => "path/to/john_doe.jpg",
        "description" => "John Doe is the driving force behind E-Shop, ensuring we deliver the best products to our customers."
    ],
    [
        "name" => "Bala Chandran",
        "position" => "Chief Marketing Officer",
        "image" => "path/to/jane_smith.jpg",
        "description" => "Jane Smith leads our marketing efforts, bringing creativity and strategy to the team."
    ],
    // Add more team members as needed
];

$mission = "Our mission is to provide high-quality, innovative products that improve the lives of our customers. We aim to achieve this through constant innovation, exceptional customer service, and a commitment to sustainability.";

$values = [
    "Customer Focus" => "We always put our customers first and strive to exceed their expectations.",
    "Integrity" => "We operate with honesty and transparency in all our dealings.",
    "Innovation" => "We are constantly innovating to bring the best products to the market.",
    "Sustainability" => "We are committed to sustainability and reducing our environmental footprint."
];
?>

<div class="header">
    <div class="container ">
        <h1 class="text-black">About Us</h1>
        <p><?php echo $company_info['description']; ?></p>
    </div>
</div>

<div class="content-section mission-section">
    <div class="container">
        <div class="mission-values">
            <h2>Our Mission</h2>
            <p><?php echo $mission; ?></p>
        </div>
    </div>
</div>

<div class="content-section values-section">
    <div class="container">
        <div class="mission-values">
            <h2>Our Values</h2>
            <?php foreach ($values as $value => $description): ?>
                <h3><?php echo $value; ?></h3>
                <p><?php echo $description; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="content-section">
    <div class="container">
        <h2>Meet Our Team</h2>
        <div class="row">
            <?php foreach ($team_members as $member): ?>
                <div class="col-md-4 team-member">
                    <img src="<?php echo $member['image']; ?>" alt="<?php echo $member['name']; ?>" class="img-fluid">
                    <h4><?php echo $member['name']; ?></h4>
                    <p><strong><?php echo $member['position']; ?></strong></p>
                    <p><?php echo $member['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<?php include('./layouts/footer.php'); ?>

