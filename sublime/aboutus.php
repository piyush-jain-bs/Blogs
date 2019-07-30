<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- External css link -->
<link rel="stylesheet" href="styles/header.css">

<!-- Bootstrap link -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- font awsom link -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

 <!-- Font family link -->
<link href="https://fonts.googleapis.com/css?family=Anton|Cinzel&display=swap" rel="stylesheet">

<!-- head_links.php links -->
<?php include 'head_links.php'?>

</head>

<body> 

<!-- For webView -->
<div class="container-fluid p-0">
    <?php include 'header.php'?> 
    <img class="fonts" style="width:100%;height:400px;" src="assets/about1.jpg">
</div> 

<!-- content -->
<div class="container">
    <div class="row mr-0">
        <div class="col-md-12 fonts">
            <h3 class="p-3" style="text-align: center;">Who We Are</h3>
            <p class="justify">BigStep Technologies is a full service software development company. We’ve worked with startups and enterprises across the globe to rapidly evolve ideas to products.</p>
            <p class="justify">Our product engineering expertize spans over various domains like web applications development, hybrid & native mobile applications development, real-time applications, microservices, cloud technologies, UX designing, etc. We work on the latest technologies, and this combined with the design-led, innovation-driven capabilities of our team ensures that we deliver great value to our customers.</p>
        </div>
    </div>

    <h3 class="fonts pt-3 pb-4" style="text-align: center;">Our Strengths</h3>
    <div class="row mb-3">

        <div class="col-md-6 mb-3">
            <div class="card polaroid1">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="pt-2 pb-2"><img class="card-img-top img-responsive" src="assets/l1.png" alt="Card image"></div>
                        <div style="font-size: 20px;" class="pt-4 pl-2 fonts">Quality Deliverables</div>
                    </div>
                    <p class="card-text justify p-3">Our focus and attention to detail enables us to create highest quality products, and applications that are successful.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card polaroid1">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="pt-2 pb-2"><img class="card-img-top img-responsive" src="assets/l2.png" alt="Card image"></div>
                        <div style="font-size: 20px;" class="pt-3 pl-2 fonts">Expertise</div>
                    </div>
                    <p class="card-text justify p-3">We love doing what we do and have deep domain knowledge to build cutting edge solutions.</p>
                </div>
            </div>
        </div> 

    </div>
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card polaroid1">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="pt-2 pb-2"><img class="card-img-top img-responsive" src="assets/l3.png" alt="Card image"></div>
                        <div style="font-size: 20px;" class="pt-3 pl-2 fonts">Innovation</div>
                    </div>
                    <p class="card-text justify p-3">Our ability to create innovative solutions to complex problems adds value to our developments.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card polaroid1">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="pt-2 pb-2 pl-1"><img class="card-img-top img-responsive" src="assets/l4.png" alt="Card image"></div>
                        <div style="font-size: 20px;" class="pt-4 pl-3 fonts">Customer Oriented Approach</div>
                    </div>
                    <p class="card-text justify pt-1 px-3">We believe in creating valuable relationships. We're dedicated to customer success, creating value and serving the interests of our customers.</p>
                </div>
            </div>
        </div> 
    </div>
</div>

<!-- FOOTER -->
<?php include 'footer.html'?> 
 
<!-- JavaScript file -->
<script>
    function closed() {
    	document.getElementById("mynav").style.width = "0px";
    }
    function opened() {
    	document.getElementById("mynav").style.width = "80%";
   	}
</script>

</body>
</html>