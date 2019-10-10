<?php require_once('Connections/empresa.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO habeas (nombres, apellidos, empresa, cargo, cedula, correo, telefono, acepto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombres'], "text"),
                       GetSQLValueString($_POST['apellidos'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['cargo'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['telefono'], "int"),
                       GetSQLValueString(isset($_POST['acepto']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_empresa, $empresa);
  $Result1 = mysql_query($insertSQL, $empresa) or die(mysql_error());

  $insertGoTo = "habeas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_empresa, $empresa);
$query_habeas = "SELECT * FROM habeas";
$habeas = mysql_query($query_habeas, $empresa) or die(mysql_error());
$row_habeas = mysql_fetch_assoc($habeas);
$totalRows_habeas = mysql_num_rows($habeas);
?><!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>Mundo bebes</title>



    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/all.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/brands.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/regular.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/solid.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/solid.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/svg-with-js.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/svg-with-js.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/v4-shims.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-free-5.11.2-web/css/v4-shims.min.css">
                                                        

    <style type="text/css">
<!--
.style1 {font-size: 11px}
-->
    </style>
  <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
            <link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css">
  </head>
    
    <body>
    

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  

    
    

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                      
                        <a href="#" class="logo">
                            <img src="assets/images/logo.png" alt="Softy Pinko" width="90" height="48"/>                        </a>
                        
                        
                        <ul class="nav">
                            <li><a href="index.html">Inicio</a></li>
                            <li><a href="#">Nuestros servicios</a></li>
                            <li><a href="contactenos.html">Contactenos</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="habeas.php" class="active">Habeas Data</a></li>
                            <li><a href="#">Administración</a></li>
                        </ul>
    <a class='menu-trigger'>
                            <span>Menu</span>                        </a>                    </nav>
                </div>
            </div>
        </div>
    </header>
    

    
    <div class="welcome-area" id="welcome">

        
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                        <p>&nbsp;                          </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                      </div>
                </div>
            </div>
        </div>
       
    </div>



    
    
    <section class="section home-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                        <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"></div>



                     
                           </div>
                </div>
            </div>
        </div>
    </section>

            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="margin-bottom-30">&nbsp;</h5>
                    <h5 class="margin-bottom-30">&nbsp;</h5>
                    <h5 class="margin-bottom-30">&nbsp;</h5>
                    <h5 class="margin-bottom-30">&nbsp;</h5>
                    <h1>Formulario Autorización habeas data</h1>
                    <h5 align="center" class="margin-bottom-30">&nbsp;                      </h5>
                    <h5 class="margin-bottom-30">
                      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                        <table width="940" align="center">
                          <tr valign="baseline">
                            <td width="141" align="right" nowrap><p>Nombres:</p></td>
                            <td width="409">&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield1">
                              <input type="text" name="nombres" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg style1">Campo requerido</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Apellidos:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield2">
                              <input type="text" name="apellidos" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg">Campo requerido.</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Empresa:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield3">
                              <input type="text" name="empresa" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Cargo:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield4">
                              <input type="text" name="cargo" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Cedula:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield5">
                            <input type="text" name="cedula" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Correo:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield6">
                            <input type="text" name="correo" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Telefono:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><span id="sprytextfield7">
                              <input type="text" name="telefono" class="form-control" value="" size="32">
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                          </tr>
                          <tr valign="baseline">
                            <td colspan="2" align="right" nowrap>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td align="right" nowrap>&nbsp;</td>
                            <td align="right" nowrap><strong>Sus datos personales han sido y están siendo tratados conforme con nuestra Política de Tratamiento de Datos Personales.</strong></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><p>Términos de uso:</p></td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right"><span id="sprycheckbox1">
                              <input type="checkbox" name="acepto" class="btn-success" value="" >
                            <span class="checkboxRequiredMsg">Please make a selection.</span></span></td>
                            <td><p align="justify" class="style1">Ley de Protección de Datos Personales:</p>
                               
                            <p align="justify" class="style1">“La autorización suministrada en el presente formulario faculta a Deloitte para que dé a sus datos aquí recopilados el tratamiento señalado en la “Política de Privacidad para el Tratamiento de Datos Personales” de Deloitte, el cual incluye, entre otras, el envío de información promocional, así como la invitación a eventos. El titular de los datos podrá, en cualquier momento, solicitar que la información sea modificada, actualizada o retirada de las bases de datos de Mundo Bebés.</p></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap align="right">&nbsp;</td>
                            <td><fieldset>
                                <button type="submit" id="form-submit" class="main-button">ENVIAR</button>
                                <p>&nbsp;</p>
                              </fieldset></td>
                          </tr>
                          </table>
                        <input type="hidden" name="MM_insert" value="form1">
                                              </form>
                      <p>&nbsp;</p>
                    </h5>
              </div>
                <div class="col-lg-8 col-md-6 col-sm-12"></div>

    </div>
        </div>
    </section>

    

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; 2019 Mundo Bebés Company - Design: Mary León</p>
                </div>
            </div>
        </div>
    </footer>
    
    
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    
    
    <script src="assets/js/custom.js"></script>

    <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "email");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($habeas);
?>