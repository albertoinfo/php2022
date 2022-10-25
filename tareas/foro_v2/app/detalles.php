<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen            ($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= contarPalabras    ($_REQUEST['comentario']) ?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= letraMasrepetida  ($_REQUEST['comentario']) ?></td></tr>
<tr><td>Palabra + repetida:</td><td><?= palabraMasrepetida($_REQUEST['comentario']) ?></td></tr>
</table>
</div>

