<?php 
include("../../bd.php");


if($_POST){
            $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
            $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
            $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
            $twitter=(isset($_POST['twitter']))?$_POST['twitter']:"";
            $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
            $linkedin=(isset($_POST['linkedin']))?$_POST['linkedin']:"";

            $fecha_imagen=new DateTime();
            $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

            $tmp_imagen=$_FILES["imagen"]["tmp_name"];
            if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
            }

            $sentencia=$conexion->prepare("INSERT INTO `tbl_equipo` 
            (`ID`, `imagen`,`nombrecompleto`,`puesto`,`twitter`,`facebook`,`linkedin`) 
            VALUES (NULL,:imagen,:nombrecompleto,:puesto,:twitter,:facebook,:linkedin);");

            $sentencia->bindparam(":imagen",$nombre_archivo_imagen);
            $sentencia->bindparam(":nombrecompleto",$nombrecompleto);
            $sentencia->bindparam(":puesto",$puesto);
            $sentencia->bindparam(":twitter",$twitter);
            $sentencia->bindparam(":facebook",$facebook);
            $sentencia->bindparam(":linkedin",$linkedin);
            $sentencia->execute();

            $mensaje="Registro agregado con exito.";
            header("location:index.php?mensaje=".$mensaje);

}

include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Equipo
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
    
    <div class="mb-3">
            <label for="" class="form-label">Nombre completo:</label>
            <input type="text"
                class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="NombreCompleto"/>
        </div>
    
        <div class="mb-3">
            <label for="" class="form-label">Puesto:</label>
            <input type="text"
                class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto"/>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Twitter:</label>
            <input type="text"
                class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter"/>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Facebook:</label>
            <input type="text"
                class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="facebook"/>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">LinkedIn:</label>
            <input type="text"
                class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="LinkedIn"/>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>  
            <input type="file"
                class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="HelpId"/>
         </div>
        
        
        <button type="submit" class="btn btn-success" > Agregar </button>

        <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>

    </form>
        
    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include("../../templates/footer.php");?>