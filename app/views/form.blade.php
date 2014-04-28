<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WCS. | A South African Eve Online Corporation</title>
    <meta name="Keywords" content="eve, south african, corporation">
    <meta name="Description" content="WCS. Is a South African EVE Online Corporation with both Afrikaans and English Speaking members." />

    <!-- Bootstrap Core CSS -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Custom Theme CSS -->
    <link href="{{ URL::asset('css/recruitment.css') }}" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}">
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
                            <h2>Apply Now</h2>
                            <p>
                                {{ Form::open(array('class' => 'form-horizontal', 'id' => 'key-form')) }}
                                    <fieldset>

                                    <!-- Prepended text-->
                                    <div class="form-group">
                                      <label class="col-md-4 control-label" for="prependedtext">Key ID</label>
                                      <div class="col-md-4">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                          {{ Form::text('keyID', null, array('id' => 'keyID', 'class' => 'form-control', 'placeholder' => 'Key ID'), 'required', 'autofocus') }}
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Prepended text-->
                                    <div class="form-group">
                                      <label class="col-md-4 control-label" for="prependedtext">Verification Code</label>
                                      <div class="col-md-4">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-magic"></i></span>
                                          {{ Form::text('vCode', null, array('id' => 'vCode', 'class' => ' form-control', 'placeholder' => 'vCode'), 'required') }}
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="form-group">
                                      <label class="col-md-4 control-label" for="singlebutton"></label>
                                      <div class="col-md-4">
                                        <button id="check-key" name="singlebutton" class="btn btn-default btn-block btn-lg">Check My Key</button>
                                        <hr>
                                        <a href="https://support.eveonline.com/api/Key/CreatePredefined/268435455" class="btn btn-default btn-block btn-sm pull-right" target="_blank">Create New API Key</a>
                                      </div>
                                    </div>

                                    </fieldset>
                                {{ Form::close() }}
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="application-form" class="container content-section">
        <div class="row">
            <div id="result"></div>
        </div>
    </section>

    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact US</h2>
                <p>Feel free to mail us, join our public channel or get hold of a reqruiter for more information!</p>
                <p>Public Channel: <a onclick="CCPEVE.joinChannel('WCS-Pub')">WCS-Pub</a> ingame</p>
            </div>
        </div>
    </section>

    <!-- Core JavaScript Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset('js/recruitment.js') }}"></script>

    <!-- key post handler -->
    <script type="text/javascript">
        // variable to hold request
        var request;
        // bind to the submit event of our form
        $("#key-form").submit(function(event){

            $('html, body').animate({
                scrollTop: $("#application-form").offset().top
            }, 2000);

            // abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);
            // let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");
            // serialize the data in the form
            var serializedData = $form.serialize();

            // let's disable the inputs for the duration of the ajax request
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            // Show the results box and a loader
            $("div#result").html("<h3><i class='fa fa-cog fa-spin'></i> Loading details from key...</h3>");
            $("div#result-box").fadeIn("slow");

            // fire off the request to /form.php
            request = $.ajax({
                url: "{{ URL::to('apply') }}",
                type: "post",
                data: serializedData
            });

            // callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                $("div#result").html(response);
            });

            // callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // log the error to the console
                console.error(
                    "The following error occured: " + textStatus, errorThrown
                );
            });

            // callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // reenable the inputs
                $inputs.prop("disabled", false);
            });

            // prevent default posting of form
            event.preventDefault();
        });
    </script>

</body>

</html>
