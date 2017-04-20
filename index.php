<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Guemil Project · Test Results</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="http://www.guemil.info/wp-content/themes/guemil/images/favicon.png" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,900' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
$json = file_get_contents('data.json');
$json_data = json_decode($json,true);
?>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12">
<header>
<h1><a href="http://www.guemil.info">Guemil Project</a></h1>
<button type="button" class="btn btn-sm btn-default" id="all">All results</button>
<button type="button" class="btn btn-sm btn-success" id="best">Only best results</button>
<button type="button" class="btn btn-sm btn-info" id="second">Only second best results</button>
<button type="button" class="btn btn-sm btn-warning" id="average">Only average results</button>
<button type="button" class="btn btn-sm btn-danger" id="low">Only low results</button>
</header>
</div><!--/col-sm-12-->

<?php for ($a = 0; $a < $all = count($json_data['test']['pictogramas']); $a++) {?>
<?php $q1=0; $q2=0; $q3=0; $q4=0; $q5=0; $q6=0; ?>
<?php for ($c = 0; $c < $all = count($json_data['test']['pictogramas'][$a]['respuestas']); $c++) {?>
<?php
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "1"){ $q1++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "2"){ $q2++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "3"){ $q3++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "4"){ $q4++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "5"){ $q5++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "6"){ $q6++; }
$desempeno= ($q1+$q2*0.75+$q3*0.5)*100/($q1+$q2+$q3+$q4+$q5+$q6);
};?>
<div class="col-sm-6 col-md-4 <?php if ($desempeno >= "90"){ echo ('best'); } else if ($desempeno >= "80"){ echo ('second'); } else if ($desempeno >= "70"){ echo ('average'); }else{ echo ('low'); };?>">
<article>
<div class="row">
<div class="col-xs-3">
<h2 class="<?php if ($desempeno >= "90"){ echo ('cl'); } else if ($desempeno >= "80"){ echo ('l'); } else if ($desempeno >= "70"){ echo ('ml'); }else{ echo ('nl'); };?>"><?php echo (round($desempeno));?>%</h2>
</div>
<div class="col-xs-9 text-right">
  <h2>Performance <span lang="es">Desempeño</span></h2>
</div>
<div class="clearfix"></div>
</div>
<figure class="<?php if ($desempeno >= "90"){ echo ('completamente-logrado'); } else if ($desempeno >= "80"){ echo ('logrado'); } else if ($desempeno >= "70"){ echo ('medianamente-logrado'); }else{ echo ('no-logrado'); };?>">
<img class="picto" src="<?php echo($json_data['test']['pictogramas'][$a]['imagen']);?>"/></figure>
<div class="description">
<h3><?php echo($json_data['test']['pictogramas'][$a]['nombre']);?></h3>
<h4><?echo (count($json_data['test']['pictogramas'][$a]['respuestas']))?> Answer <span lang="es">Respuestas</span></h4>
<!--<h4><a role="button" data-toggle="collapse" href="#collapse<?php echo $a;?>" aria-expanded="false" aria-controls="collapseExample">Details <span lang="es">Detalles</span></a></h4>-->
<!--<div class="collapse collpse-in" id="collapse<?php echo $a;?>">-->
<dl><dt>Correct <span lang="es">| Correcta</span></dt><dd><?php echo ($q1);?></dd></dl>
<dl><dt>Almost correct <span lang="es">| Casi correcta</span></dt><dd><?php echo ($q2);?></dd></dl>
<dl><dt>Doubtful <span lang="es">| Dudosa</span></dt><dd><?php echo ($q3);?></dd></dl>
<dl><dt>Incorrect <span lang="es">| Incorrecta</span></dt><dd><?php echo ($q4);?></dd></dl>
<dl><dt>Opposite meaning <span lang="es">| Significado opuesto</span></dt><dd><?php echo ($q5);?></dd></dl>
<dl><dt>Unanswered <span lang="es">| Sin Respuesta</span></dt><dd><?php echo ($q6);?></dd></dl>
<!--</div>-->
<hr>
<p><?php if ($desempeno >= "90"){ echo ('Due to its high performance, this pictogram could be used.'); } else if ($desempeno >= "80"){ echo ('Due to its performance, this pictogram can be improved.'); } else if ($desempeno >= "70"){ echo ('Due to its performance, this pictogram should be rethought.'); }else{ echo ('Due to its poor performance, this pictogram should be discarded.'); };?></p>
<p lang="es"><?php if ($desempeno >= "90"){ echo ('Debido a su alto desempeño, este pictograma podría ser aprovechado.'); } else if ($desempeno >= "80"){ echo ('Debido a su desempeño, este pictograma puede ser mejorado.'); } else if ($desempeno >= "70"){ echo ('Debido a su desempeño, este pictograma debería replantearse.'); }else{ echo ('Debido a su bajo desempeño, este pictograma debe ser descartado.'); };?></p>
</div>
</article>
</div><!--/col-sm-4-->
<?php };?><!--cierre el for con $a-->
<div class="clearfix"></div>
</div><!--/row-->
</div><!--/container-->
<div class="container-flow">
  <div class="row">
    <div class="col-sm-12">
    <footer><p>Guemil Project by <a href="mailto:rramireo@uc.cl">Rodrigo Ramírez</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</p></footer>
    </div><!--/col-sm-12-->
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#best").click(function(){
        $(".best").show(500);
        $(".second").hide(500);
        $(".average").hide(500);
        $(".low").hide(500);
    });
    $("#second").click(function(){
      $(".best").hide(500);
      $(".second").show(500);
      $(".average").hide(500);
      $(".low").hide(500);
    });
    $("#average").click(function(){
      $(".best").hide(500);
      $(".second").hide(500);
      $(".average").show(500);
      $(".low").hide(500);
    });
    $("#low").click(function(){
      $(".best").hide(500);
      $(".second").hide(500);
      $(".average").hide(500);
      $(".low").show(500);
    });
    $("#all").click(function(){
      $(".best").show(500);
      $(".second").show(500);
      $(".average").show(500);
      $(".low").show(500);
    });
});
</script>
</body>
</html>
