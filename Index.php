  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/css/mdb.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <a class="navbar-brand" href="#">CC-CHECKER</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  </nav>
  </head>

  <body

  	<br>
    <div class="row col-md-12">
      <div class="card col-sm-8 ml-5" style="background-color: #e3f2fd;">
        <h5 class="card-body h6">Test CCN</h5>
        <div class="card-body">
          <div class="md-form">
           <div class="col-md-12">
            <textarea type="text" placeholder="657372005xxxxxxx|2|2024|346"style="text-align: center;" id="lista" class="md-textarea form-control" rows="2"></textarea>
          </div>
        </div>
        <center>
         <button class="btn btn-primary" style="width: 200px; outline: none;" id="testar" onclick="enviar()" >Start</button>
         <button class="btn btn-danger" style="width: 200px; outline: none;">Stop</button>
       </center>
     </div>
   </div>

   <div class="card col-sm-2 ml-5 mt-2" style="background-color: #e3f2fd;">
    <h5 class="card-body h6 text-center"> :: Information ::</h5>
    <div class="card-body">
    	<span>Status :</span><span class="badge badge-secondary">Waiting for the command.</span>
      <div class="md-form">
       <span>Approved:</span>&nbsp<span id="cLive" class="badge badge-success mx-auto">0</span>
       <span>Disapproved:</span>&nbsp<span id="cDie" class="badge badge-danger mx-auto"> 0</span>
       <span>Tested:</span>&nbsp&nbsp<span id="total" class="badge badge-info mx-auto">0</span>
       <span>Uploaded:</span>&nbsp<span id="carregadas" class="badge badge-dark mx-auto">0</span>
     </div>
   </div>
  </div>
  </div>
  <br>



  <div class="col-md-12">
  <div class="card">
    <div style="position: absolute;
    top: 0;
    right: 0;">
    <button id="mostra" class="btn btn-primary text-body mt-2 font-weight-bold">SHOW/HIDE</button>
  </div>
  <div class="card-body" style="background-color: #e3f2fd;">
    <h6 style="font-weight: bold;" class="card-title">Approved - <span  id="cLive2" class="badge badge-success">0</span></h6>
    <div id="bode"><span id=".aprovadas" class="aprovadas"></span>
    </div>
  </div>
  </div>
  </div>
  <br>
  <div class="col-md-12">
  <div class="card">
  	<div style="position: absolute;
    top: 0;
    right: 0;">
    <button id="mostra2" class="btn btn-primary mt-2 font-weight-bold">SHOW/HIDE</button>
  </div>
  <div class="card-body" style="background-color: #e3f2fd;">
    <h6 style="font-weight: bold;" class="card-title">Disapproved - <span id="cDie2" class="badge badge-danger">0</span></h6>
    <div id="bode2"><span id=".reprovadas" class="reprovadas"></span>
    </div>
  </div>
  </div>
  </div>



  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){


    $("#bode").hide();
    $("#esconde").show();

    $('#mostra').click(function(){
     $("#bode").slideToggle();
   });

  });

  </script>

  <script type="text/javascript">

  $(document).ready(function(){


    $("#bode2").hide();
    $("#esconde2").show();

    $('#mostra2').click(function(){
     $("#bode2").slideToggle();
   });

  });

  </script>

  <script title="ajax do checker">
  function enviar() {
    var linha = $("#lista").val();
    var linhaenviar = linha.split("\n");
    var total = linhaenviar.length;
    var ap = 0;
    var rp = 0;
    linhaenviar.forEach(function(value, index) {
      setTimeout(
        function() {
          $.ajax({
            url: 'api.php?lista=' + value,
            type: 'GET',
            async: true,
            success: function(resultado) {
              if (resultado.match("#Aprovada")) {
                removelinha();
                ap++;
                aprovadas(resultado + "");
              }else {
                removelinha();
                rp++;
                reprovadas(resultado + "");
              }
              $('#carregadas').html(total);
              var fila = parseInt(ap) + parseInt(rp);
              $('#cLive').html(ap);
              $('#cDie').html(rp);
              $('#total').html(fila);
              $('#cLive2').html(ap);
              $('#cDie2').html(rp);
            }
          });
        }, 500 * index);
    });
  }
  function aprovadas(str) {
    $(".aprovadas").append(str + "<br>");
  }
  function reprovadas(str) {
    $(".reprovadas").append(str + "<br>");
  }
  function removelinha() {
    var lines = $("#lista").val().split('\n');
    lines.splice(0, 1);
    $("#lista").val(lines.join("\n"));
  }
  </script>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
  </body>
  <br>


  <footer class="bg-dark">
  <div class="footer-copyright text-center py-3 text-light font-weight-bold">OWNER :: <a href="#"> IMREDEYES</a>
  </div>
  </footer>

  </html>