<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperar los datos de ID correspodniente o selccionado
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_entradas WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registros=$sentencia->fetch(PDO::FETCH_LAZY);


    $fecha=$registros['fecha'];
    $titulo=$registros['titulo'];
    $descripcion=$registros['descripcion'];
    $imagen=$registros['imagen'];
}
if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
 
    $sentencia=$conexion->prepare("UPDATE `tbl_entradas` 
    SET fecha=:fecha,titulo=:titulo,descripcion=:descripcion WHERE id=:id");

    $sentencia->bindparam(":fecha",$fecha);
    $sentencia->bindparam(":titulo",$titulo);
    $sentencia->bindparam(":descripcion",$descripcion);
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();

    
    if($_FILES["imagen"]["tmp_name"]!=""){

        $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";
    
        $tmp_imagen=$_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmp_imagen,"../../../assets/img/about/".$nombre_archivo_imagen);        
        //borrado archivo anterior
        $sentencia=$conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id ");
        $sentencia->bindparam(":id",$txtID);
        $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
        $sentencia->execute();
        $registros_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    
        if(isset($registros_imagen["imagen"])){
            if(file_exists("../../../assets/img/about/".$registros_imagen["imagen"])){
                unlink("../../../assets/img/about/".$registros_imagen["imagen"]);
            }
        }
        
        $sentencia=$conexion->prepare("UPDATE tbl_entradas SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindparam(":imagen",$nombre_archivo_imagen);
        $sentencia->bindparam(":id",$txtID);
        $sentencia->execute();
        $imagen=$nombre_archivo_imagen;
    }
    
    $mensaje="Registro modificado con exito.";
    header("location:index.php?mensaje=".$mensaje);
    
}

   
include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Entradas
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
            <label for="" class="form-label">ID:</label>
            <input type="text"
                class="form-control" readonly value="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID"/>
        </div>
    
    <div class="mb-3">
            <label for="" class="form-label">Fecha:</label>
            <input type="date"
                class="form-control" value="<?php echo $fecha;?>" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha"/>
        </div>
    
        <div class="mb-3">
            <label for="" class="form-label">Titulo:</label>
            <input type="text"
                class="form-control" value="<?php echo $titulo;?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo"/>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Descripción:</label>
            <input type="text"
                class="form-control" value="<?php echo $descripcion;?>"name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción"/>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <img width="50" src="../../../assets/img/about/<?php echo $imagen;?>"/>
            <input type="file"
                class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId"/>
         </div>
        
        
        <button type="submit" class="btn btn-success" > Actualizar </button>

        <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>

    </form>
        
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>


<?php include("../../templates/footer.php");?>