<?php 
include("../../bd.php");
if($_POST){

    $usuarios=(isset($_POST['usuarios']))?$_POST['usuarios']:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";
   
    $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios` 
    (`ID`, `usuarios`, `password`, `correo`) 
    VALUES (NULL, :usuarios, :password, :correo);");
    

    $sentencia->bindparam(":usuarios",$usuarios);
    $sentencia->bindparam(":password",$password);
    $sentencia->bindparam(":correo",$correo);
    $sentencia->execute();
    $mensaje="Registro modificado con exito.";
   header("location:index.php?mensaje=".$mensaje);


}
include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Usuario
    </div>
    <div class="card-body">
       
        <form action="" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Nombre del usuario:</label>
            <input type="text"
                class="form-control" name="usuarios" id="usuarios" aria-describedby="helpId" placeholder="Nombre del usuario"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password:</label>
            <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password"/>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo"/>
        </div>

            <button type="submit" class="btn btn-success" > Agregar </button>

            <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>




        </form>

    </div>
    <div class="card-footer text-muted">
    

    </div>
</div>

<?php include("../../templates/footer.php");?>