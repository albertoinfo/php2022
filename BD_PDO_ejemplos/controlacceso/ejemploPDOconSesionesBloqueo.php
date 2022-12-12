<?php
/*
Ejemplo de control de acceso consultando a una base de datos

- Manejando la sesión para conectar y desconectar
- Utilizando un timeout para desconectarse a los 60 sg.
- Bloqueando al usuarios si hay más de tres intentos sucesivos
con el mismo usuario.

*/

session_start();
?>