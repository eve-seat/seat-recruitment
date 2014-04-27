<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WCS. | Recruitment</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Custom Theme CSS -->
    <link href="css/recruitment.css" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">
                    <i class="fa fa-check"></i>  <span class="light">WCS.</span> Recruitment
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#apply">Apply</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <section class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">[WCS.]</h1>
                        <h5 class="intro-text">The Warp Core Stabalizers<br><small>A premier South African EVE Online Corporation</small></h5>
                        <div class="page-scroll">
                            <a href="#about" class="btn btn-circle">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About WCS.</h2>
                <p>The Warp Core Stabilizers is primarily a Nullsec PVP corporation but we do love to carebear now and then for those expensive faction and officer mods we cherish so much. WCS consists of mainly South African players with a mixture of EU (Timezone) players that are all focused on having a good time. Currently living and operating out of Nullsec (Sov Space) within our alliance and enjoying every minute of it.</p>

                <p> With regular PVP roams, opportunity to take part in some of EVE's largest battles, ship replacement programmes, vast and rich space to exploit and many other South African members, why would you <b>not</b> want to join? </p>
            </div>
        </div>
    </section>

    <section id="apply" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Where do I sign the paperwork?!</h2>
                    <p>If you have a good sense of humor, some pvp experience (or the willingness to learn), close to 15 million skillpoints (chat to a recruiter if you dont and maybe we can make an exception) and a set of full API keys and the ability to use voice communications programmes such as Teamspeak 3 &amp; Mumble, press this button now!</p>
                    <a href="{{ URL::to('apply') }}" class="btn btn-default btn-lg">Apply to join WCS.</a>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact US</h2>
                <p>Feel free to mail us, join our public channel or get hold of a reqruiter for more information!</p>
                <p>Public Channel: <b>WCS-Pub</b> ingame</p>
            </div>
        </div>
    </section>

    <!-- Core JavaScript Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/recruitment.js"></script>

</body>

</html>
