<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
class Enemigos
{
  
   public static function cargaEnemigos($idMazmorra)
  {
      $result_array=array();
      $app = App::getSingleton(); 
      $conn = $app->conexionBd();
      $query = sprintf("SELECT *FROM mazmorras,mazmorraenemigo,enemigo WHERE mazmorras.id=%s AND mazmorraenemigo.idMazmorra=mazmorras.id and mazmorraenemigo.idEnemigo=enemigo.id",$idMazmorra);
      $rs = $conn->query($query);
      if ($rs) {
        if ($rs->num_rows > 0) {
            while($row = $rs->fetch_assoc()) {
                array_push($result_array, $row);
            }
            echo json_encode($result_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
        }
      }
      echo $conn->error;
      return false;
  } 
    private function __construct()
  {

  }
}