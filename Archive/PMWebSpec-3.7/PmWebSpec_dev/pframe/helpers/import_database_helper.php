<?php
function import_database($data) {
 echo '<script> window.location.href = "'.base_url("import_database/database_import.php?hostname=".$data['hostname']."&username=".$data['username']."&pwd=".$data['pwd']."&db=".$data['db']."&file=".$data['file']."").'";</script>'; 
}
?>