<?php

class Cotizaciones
{
    public static function nueva($idCliente, $descripcion, $fecha, $cond_pago, $cond_entrega, $fecha_venc)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into cotizaciones(idUsuario, idCliente, descripcion, fecha, condicion_pago, condicion_entrega, fecha_vencimiento) VALUES (?, ?, ?, ?, ?, ?, ?);");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCliente, $descripcion, $fecha, $cond_pago, $cond_entrega, $fecha_venc]);
    }

    public static function eliminarServicio($idServicio)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete servicios_cotizaciones
from servicios_cotizaciones
       inner join cotizaciones on cotizaciones.idUsuario = ?
                                    and
                                  servicios_cotizaciones.id = ?");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idServicio]);
    }

    public static function eliminarCaracteristica($idCaracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete caracteristicas_cotizaciones 
from caracteristicas_cotizaciones 
inner join cotizaciones on cotizaciones.idUsuario = ? and caracteristicas_cotizaciones.id = ?;");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCaracteristica]);
    }

    public static function obtenerServicioPorId($idServicio)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select servicios_cotizaciones.id, idCotizacion, servicio, costo, cantidad
from servicios_cotizaciones
       inner join cotizaciones on cotizaciones.idUsuario = ? and servicios_cotizaciones.id = ?");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idServicio]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function obtenerCaracteristicaPorId($idCaracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select caracteristicas_cotizaciones.id, idCotizacion, caracteristica
from caracteristicas_cotizaciones
       inner join cotizaciones on cotizaciones.idUsuario = ? and caracteristicas_cotizaciones.id = ?");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCaracteristica]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function serviciosPorId($idCotizacion)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select servicios_cotizaciones.id, servicio, costo, cantidad
from servicios_cotizaciones
       inner join cotizaciones on cotizaciones.id = servicios_cotizaciones.idCotizacion and cotizaciones.id = ?
                                    and cotizaciones.idUsuario = ?;");
        $sentencia->execute([$idCotizacion, SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function caracteristicasPorId($idCotizacion)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select caracteristicas_cotizaciones.id, idCotizacion, caracteristica
from caracteristicas_cotizaciones
       inner join cotizaciones on cotizaciones.id = caracteristicas_cotizaciones.idCotizacion and cotizaciones.id = ? and cotizaciones.idUsuario = ?;");
        $sentencia->execute([$idCotizacion, SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function agregarServicio($idCotizacion, $servicio, $costo, $cantidad)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into servicios_cotizaciones (idCotizacion, servicio, costo, cantidad)
        values ((select id from cotizaciones where cotizaciones.idUsuario = ? and cotizaciones.id = ?), ?, ?, ?);");
        return $sentencia->execute([
            SesionService::obtenerIdUsuarioLogueado(),
            $idCotizacion,
            $servicio,
            $costo,
            $cantidad
        ]);
    }

    public static function agregarCaracteristica($idCotizacion, $caracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("insert into caracteristicas_cotizaciones
        (idCotizacion, caracteristica)
        values
        ((select id from cotizaciones where cotizaciones.idUsuario = ? and cotizaciones.id = ?), ?);");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $idCotizacion, $caracteristica]);
    }

    public static function actualizarServicio($idServicio, $servicio, $costo, $cantidad)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update servicios_cotizaciones
        inner join cotizaciones on servicios_cotizaciones.idCotizacion = cotizaciones.id and cotizaciones.idUsuario = ?
        set servicio        = ?,
            costo           = ?,
            cantidad = ?
        where servicios_cotizaciones.id = ?;");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $servicio, $costo, $cantidad, $idServicio]);
    }

    public static function actualizarCaracteristica($idCaracteristica, $caracteristica)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update caracteristicas_cotizaciones
        inner join cotizaciones on caracteristicas_cotizaciones.idCotizacion = cotizaciones.id and cotizaciones.idUsuario = ?
        set
        caracteristica = ?
        where caracteristicas_cotizaciones.id = ?;");
        return $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $caracteristica, $idCaracteristica]);
    }

    public static function todas()
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select
            cotizaciones.id, clientes.razonSocial, cotizaciones.descripcion, cotizaciones.fecha
            from clientes inner join cotizaciones
            on cotizaciones.idCliente = clientes.id and cotizaciones.idUsuario = ? order by id;");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado()]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public static function porId($id)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("select
            cotizaciones.id, clientes.razonSocial, clientes.nit, clientes.ciudad, cotizaciones.descripcion, cotizaciones.fecha, cotizaciones.condicion_pago, cotizaciones.condicion_entrega, cotizaciones.fecha_vencimiento, cotizaciones.idCliente
            from clientes inner join cotizaciones
            on cotizaciones.idCliente = clientes.id and cotizaciones.idUsuario = ?
            where cotizaciones.id = ?;");
        $sentencia->execute([SesionService::obtenerIdUsuarioLogueado(), $id]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public static function actualizar($id, $idCliente, $descripcion, $fecha, $cond_pago, $cond_entrega, $fecha_venc)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("update cotizaciones set
        idCliente = ?,
        descripcion = ?,
        fecha = ?,
        condicion_pago = ?,
        condicion_entrega = ?,
        fecha_vencimiento = ?
        where id = ? and idUsuario = ?");
        return $sentencia->execute([$idCliente, $descripcion, $fecha, $cond_pago, $cond_entrega, $fecha_venc, $id, SesionService::obtenerIdUsuarioLogueado()]);
    }

    public static function eliminar($id)
    {
        $bd = BD::obtener();
        $sentencia = $bd->prepare("delete from cotizaciones where id = ? and idUsuario = ?;");
        return $sentencia->execute([$id, SesionService::obtenerIdUsuarioLogueado()]);
    }
}
