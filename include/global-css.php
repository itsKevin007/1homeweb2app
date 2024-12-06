<?php
if (!defined('WEB_ROOT')) {
	header('Location: ../index.php');
	exit;
}
?>
	<!-- Favicons-->
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Appdent is a app landing page. Where include 6+ landing page template.">
        <meta name="author" content="WowThemez">
       
        
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_ROOT; ?>img/icons/onehome.png">
		
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/font-awesome.min.css">
        <!-- Elegant Font Icons CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/elegant-font-icons.css">
        <!-- Elegant Line Icons CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/elegant-line-icons.css">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/bootstrap.min.css">
        <!-- animate CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/animate.min.css">
		<!-- Venobox CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/venobox.css">
		<!-- OWL-Carousel CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/owl.carousel.css">
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/main.css">
		<!-- <link rel="stylesheet" href="css/color.css"> -->
		<!-- Responsive CSS -->
        <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/responsive.css">

        <script src="<?php echo WEB_ROOT; ?>js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css'><link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/flipdown/flipdown.css">
        <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/style.css"> -->

        <style>
           
            /* Modal container */
            .modal {
                display: none; 
                position: fixed; 
                z-index: 1000; 
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto; 
                background-color: rgba(0, 0, 0, 0.5); 
            }

            /* Modal content box */
            .modal-content {
                background-color: white;
                margin: 10% auto;
                padding: 20px;
                border-style: double !important;
                border-color: #022c5c !important;
                width: 100%;
                max-width: 1100px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                border-radius: 10px;
            }

            .borders{
                border-style: double;
                border: 2px solid #022c5c;
                border-color: #022c5c !important;
            }

            /* Modal header styling */
            .modal-header {
                display: flex;
                padding-bottom: 10px;
            }

            /* Image styling for header */
            .modal-header img {
                max-width: 30%;
                float: left !important;
            }

            .modal-header h2 {
                color: #022c5c;
                float: right !important;
                text-align: center;
            }

            /* Close button */
            .close {
                color: #000000;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            /* Button styling */
            .open-modal-btn {
                background-color: #0066cc;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .open-modal-btn:hover {
                background-color: #0055a3;
            }

            /* Form inside modal-body */
            .modal-body {
                padding: 20px;
            }

            .modal-body hr{
                border: 1px dotted #000;
            }

            .modal-body label{
                color: #000;
                font-weight: bold;
            }

            .modal-body h3 {
                color: #000;
                margin-bottom: 10px;
            }

            .form-group label {
                display: block;
                color: #000;
                font-weight: bold;
            }

            .acc-holder{
                text-align: center !important;
                font-size: 12px;
                text-transform: uppercase;
            }

            /* Targeting input fields directly */
            .form-group input {
                width: 100%;
                padding: 12px;
                border: 1px solid #000; /* Increase border thickness */
                border-radius: 5px;
                font-size: 12px; /* Slightly increase font size for better readability */
                color: #000 !important; /* Set text color to black for contrast */
                background-color: #fff; /* Ensure background is white for contrast */
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for 3D effect */
                transition: border-color 0.3s ease; /* Smooth transition for border color */
            }

            /* Specific styles for text input */
            .form-group input[type="text"] {
                border: 1px solid #000; /* Ensure border is set */
            }

            /* Specific styles for text input */
            .form-group input[type="date"] {
                padding: 3px;
            }

            /* Specific styles for text input */
            .form-group input[type="radio"] {

                box-shadow: none !important;
            }

            /* Specific styles for text input */
            .form-group input[type="email"] {
                border: 1px solid #000; /* Ensure border is set */
            }

            /* Specific styles for text input */
            .form-group input[type="email"] {
                border: 1px solid #000; /* Ensure border is set */
            }

            .form-group select {
                border: 1px solid #000; /* Apply a similar border as the email input */
                padding: 5px; /* Padding for alignment */
                background-color: #fff; /* Ensure background is white */
                border-radius: 4px; /* Optional: Rounded corners for a cleaner look */
                font-size: 16px; /* Font size reduced to 12px */
                color: #000 !important; /* Ensure text color is black */
                min-width: 180px; /* Prevent shrinking below 180px */
                width: 100%; /* Set a width to make sure the container stays consistent */
            }

            /* Focus effect */
            .form-group input:focus {
                border-color: #0066cc; /* Change border color on focus for visibility */
                outline: none; /* Remove default outline */
                box-shadow: 0 0 5px rgba(0, 102, 204, 0.5); /* Add shadow on focus */
            }

            /* Focus effect specifically for text input */
            .form-group input[type="text"]:focus {
                border-color: #0066cc; /* Change border color on focus for visibility */
                outline: none; /* Remove default outline */
                box-shadow: 0 0 5px rgba(0, 102, 204, 0.5); /* Add shadow on focus */
            }


            input[type="text"],
            input[type="email"],
            textarea {
                padding: 10px;
                margin-bottom: 20px;
                border: none;
                border-radius: 5px;
                background: rgba(255, 255, 255, 0.2);
                color: #fff;
                resize: none;
            }

            .radio-group {
                display: flex;
                justify-content: space-around;
                margin-bottom: 20px;
            }

            input[type="radio"] {
                margin-right: 5px;
            }

            .close-btn-header {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            @import url('https://fonts.googleapis.com/css2?family=DSEG7+Classic:wght@700&display=swap');

            .countdown {
                text-align: center;
                padding: 5%;
            }

            #timer {
                display: flex;
                justify-content: space-evenly;
                margin-top: 5%;
                gap: 10px; /* Control the spacing between the countdown units */
            }

            #timer div {
                font-size: 2rem;
                text-align: center;
                color: white; /* White text color for the labels */
                font-family: 'DSEG7 Classic', sans-serif; /* Use the digital clock font */
            }

            #timer span {
                display: block;
                font-size: 3rem; /* Larger font size for the numbers */
                font-weight: bold;
                color: #ffffff; /* White font for the countdown */
                font-family: 'DSEG7 Classic', sans-serif; /* Digital clock font */
                background-color: #151515; /* Dark background for the countdown boxes */
                padding: 15px 20px; /* Add padding inside the boxes */
                border-radius: 10px; /* Rounded corners for a modern digital look */
                box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5); /* Optional shadow for depth */
            }

            @font-face {
            font-family: 'jumper';
            src: url('fonts/jumper.ttf') format('truetype');
            }

            .jumper {
                font-family: 'jumper', sans-serif;
            }
            
            #typewriter {
            font-size: 4em; /* Adjust the size for h2 equivalent */
            font-weight: bold;
            }

            @media (max-width: 600px) {
                #typewriter {
                font-size: 3em; /* Adjust the size for h2 equivalent */
                }
                
                #typewriter::before {
                display: block;
                }


            }
   
        </style>

    
