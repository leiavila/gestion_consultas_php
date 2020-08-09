<?php
switch ($cardnum) {
    case 1:
        $classcss = "bg-gradient-red";
        $title = "Consultas Pendientes";
        $letter = "P";
        break;
    case 2:
        $classcss = "bg-gradient-orange";
        $title = "Consultas para hoy";
        $letter = "H";
        break;
    case 3:
        $classcss = "bg-gradient-green";
        $title = "Consultas canceladas";
        $letter = "C";
        break;
    case 4: 
        $classcss = "bg-gradient-info";
        $title = "Consultas de la semana";
        $letter = "S";
        break;
  } 
?>

<div class="col-xl-3 col-md-6">
    <div class="card card-stats">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $title ?></h5>
                    <span class="h2 font-weight-bold mb-0">7</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape text-white rounded-circle shadow <?php echo $classcss ?>">
                    <?php echo $letter ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


