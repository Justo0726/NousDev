<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //brecuperar los datos de ID correspodniente o selccionado
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registros=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuarios=$registros['usuarios'];
    $correo=$registros['correo'];
    $password=$registros['password'];
}
if($_POST){

   //recepcionamos los valores del formulario
   $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
   $usuarios=(isset($_POST['usuarios']))?$_POST['usuarios']:"";
   $correo=(isset($_POST['correo']))?$_POST['correo']:"";
   $password=(isset($_POST['password']))?$_POST['password']:"";

   $sentencia=$conexion->prepare("UPDATE tbl_usuarios
   SET 
   usuarios=:usuarios, 
   correo=:correo, 
   password=:password
   WHERE id=:id");

   $sentencia->bindparam(":usuarios",$usuarios);
   $sentencia->bindparam(":correo",$correo);
   $sentencia->bindparam(":password",$password);
   $sentencia->bindparam(":id",$txtID);
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
            <label for="txtID" class="form-label">ID:</label>
            <input readonly type="text"
                class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID"/>
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Nombre del usuario:</label>
            <input type="text"
                class="form-control" value="<?php echo $usuarios;?>" name="usuarios" id="usuarios" aria-describedby="helpId" placeholder="Nombre del usuario"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password:</label>
            <input type="password"
                class="form-control" value="<?php echo $password;?>" name="password" id="password" aria-describedby="helpId" placeholder="Password"/>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email"
                class="form-control" value="<?php echo $correo;?>" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo"/>
        </div>

            <button type="submit" class="btn btn-success" > Actualizar </button>

            <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>




        </form>

    </div>
    <div class="card-footer text-muted">
    

    </div>
</div>



<?php include("../../templates/footer.php");?>