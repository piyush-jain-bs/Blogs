<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Bootstrap link -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- font awsom link -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

 <!-- Font family link -->
<link href="https://fonts.googleapis.com/css?family=Anton|Cinzel&display=swap" rel="stylesheet">

<!-- External css link -->
<link rel="stylesheet" href="styles/header.css">

<!-- head_links.php links -->
<?php include 'head_links.php'?>

</head>
<body>
<!-- For webView -->
<div class="container-fluid p-0">

    <?php include 'header.php'?>
<!-- <div class="row">  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 mobile_size web_size" src="assets/cl.jpg" alt="First slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100 mobile_size web_size" src="assets/cl1.jpg" alt="Second slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100 mobile_size web_size" src="assets/cl4.png" alt="Third slide">
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<h2 class="mt-4" style="text-align: center;font-family: cinzel">What are People saying About us?</h2>

<!-- content -->
<div class="row mx-auto mb-5">
	
  <div class="col-md-4 mt-4">
    <div class="card border-info polaroid">
      <img class="card-img-top" src="assets/person.png" alt="Card image" style="width:100%;height:100%">
      <div class="card-body">
        <p class="card-text justify">We leverage our expertise in software engineering, innovative design and cloud to build remarkable web and mobile applications. We work with startups and enterprises to rapidly evolve ideas to products.</p>
      </div>
    </div>
  </div>

  <div class="col-md-4 mt-4">
    <div class="card border-info polaroid">
      <img class="card-img-top" src="assets/person.png" alt="Card image" style="width:100%;height:100%">
      <div class="card-body">
        <p class="card-text justify">We leverage our expertise in software engineering, innovative design and cloud to build remarkable web and mobile applications. We work with startups and enterprises to rapidly evolve ideas to products.</p>
      </div>
    </div>
  </div>

  <div class="col-md-4 mt-4">
    <div class="card border-info polaroid">
      <img class="card-img-top" src="assets/person.png" alt="Card image" style="width:100%;height:100%">  
      <div class="card-body">
        <p class="card-text justify">We leverage our expertise in software engineering, innovative design and cloud to build remarkable web and mobile applications. We work with startups and enterprises to rapidly evolve ideas to products.</p>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.html'?>

</div>

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