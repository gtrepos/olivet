<?php
// trans.php
function begin()
{
@mysql_query("BEGIN");
}
function commit()
{
@mysql_query("COMMIT");
}
function rollback()
{
@mysql_query("ROLLBACK");
}
?>