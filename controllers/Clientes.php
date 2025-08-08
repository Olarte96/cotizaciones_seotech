<?php

class Clientes
{
    public static function nuevo($razonSocial, $nit, $ciudad)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into clientes(razonSocial, nit, ciudad, idUsuario) VALUES (?, ?, ?, ?);");
        return $sentencia->execute([$razonSocial, $nit, $ciudad, SesionService::obtenerIdUsuarioLogueado()]);
    }

    public static function actualizar($id, $razonSocial, $nit, $ciudad)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update clientes set razonSocial = ?, nit = ?, ciudad = ? where id = ? and idUsuario = ?;");
        return $sentencia->execute([$razonSocial, $nit, $ciudad, $id, SesionService::obtenerIdUsuarioLogueado()]);
    }

    public static function todos()
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select id, razonSocial, nit, ciudad from clientes where idUsuario = ?;");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function porId($id)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select id, razonSocial, nit, ciudad from clientes where id = ? and idUsuario = ?;");
        $sentencia->execute([$id, SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function eliminar($id)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete from clientes where id = ? and idUsuario = ?;");
        return $sentencia->execute([$id, SesionService::obtenerIdUsuarioLogueado()]);
    }
}
