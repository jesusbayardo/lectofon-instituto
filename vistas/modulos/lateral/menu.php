<!--=====================================
MENU
======================================-->

<ul class="sidebar-menu">

  <li class="active"><a href="inicio"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

 
<?php

if($_SESSION["perfilUser"]=="comprador"){

echo '
<li><a href="estudiantes"><i class="fa fa-edit"></i> <span>Ingreso estudiantes</span></a></li>
';
}else{
echo '
  <li><a href="mi-perfil"><i class="fa fa-edit"></i> <span>Mi perfil</span></a></li>
  <li><a href="mi-record"><i class="fa fa-leanpub" aria-hidden="true"></i> <span>Mi record</span></a></li>
  <li><a href="ejercitarme"><i class="fa fa-book" aria-hidden="true"></i> <span>Ejercitarme</span></a></li>';
}





?>

  
  






</ul>