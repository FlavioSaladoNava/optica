drop PROCEDURE IF EXISTS insertlog;
DELIMITER $$
create procedure insertlog(
    vid_usuario int
    )
begin
    SET @nowxd = (now());
    SET @vusuario = (SELECT usuario from usuarios where id_usuario= vid_usuario);
    update usuarios set estado="Online" where id_usuario= vid_usuario;
    insert into log(id_usuario, usuario, date_entrada, date_salida) values (vid_usuario, @vusuario, @nowxd, '0000-00-00 00:00:00');
END $$
DELIMITER ;

drop PROCEDURE IF EXISTS insertSalida;
DELIMITER $$
create procedure insertSalida(
    vid_usuario int
    )
begin
    SET @nowxd = (now());
    SET @vusuario = (SELECT usuario from usuarios where id_usuario= vid_usuario);
    update usuarios set estado="Offline" where id_usuario= vid_usuario;
    update log set date_salida=@nowxd where usuario = @vusuario and date_salida = '0000-00-00 00:00:00';
END $$
DELIMITER ;


drop PROCEDURE IF EXISTS insertAdmin;
DELIMITER $$
create procedure insertAdmin(
    vnombre varchar(50),
    vapellidos varchar(80),
    vusuario varchar(25),
    vcontrasena text
)
begin

    INSERT INTO usuarios(nombre, apellidos, usuario, contrasena, estado, tipo) VALUES (vnombre, vapellidos, vusuario, vcontrasena, 'Offline', 'Admin');
    SET @last = (SELECT id_usuario from usuarios order by id_usuario desc limit 1);
    
    INSERT INTO actividad(tabla, accion, fecha) VALUES ('Usuarios', CONCAT('Se ha insertado un adminsitrador con el id: ' , @last), now());

END $$
DELIMITER ;




drop PROCEDURE IF EXISTS insertOperador;
DELIMITER $$
create procedure insertOperador(
    vnombre varchar(50),
    vapellidos varchar(80),
    vusuario varchar(25),
    vcontrasena text,
    vid_administrador int
)
begin
    INSERT INTO usuarios(nombre, apellidos, usuario, contrasena, estado, tipo, id_administrador) VALUES (vnombre, vapellidos, vusuario, vcontrasena, 'Offline', 'Operador', vid_administrador);
    INSERT INTO actividad(tabla, accion, fecha) VALUES ('Usuarios', CONCAT('Se ha insertado un operador para el administrador con el id: ',vid_administrador), now());
END $$
DELIMITER ;

drop PROCEDURE IF EXISTS modUsuario;
DELIMITER $$
create procedure modUsuario(
    vnombre varchar(50),
    vapellidos varchar(80),
    vusuario varchar(25),
    vcontrasena text,
    vid_usuario int
)
begin
    UPDATE usuarios SET nombre=vnombre, apellidos=vapellidos, usuario=vusuario, contrasena=vcontrasena where id_usuario=vid_usuario;
    END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS delOperador;
DELIMITER $$
CREATE PROCEDURE delOperador(
    vid_usuario int,
    v_id_usuario int
)
begin
    UPDATE usuarios SET estado = 'Baja' where id_usuario=vid_usuario;
    INSERT INTO bitacora(accion,tabla,time,id_usuario) VALUES (CONCAT('Se ha eliminado un usuario con el id: ' , vid_usuario), 'Usuarios', now(), v_id_usuario);

END $$
DELIMITER ;












DROP PROCEDURE IF EXISTS InsertClinica;
DELIMITER //
CREATE PROCEDURE InsertClinica(
 v_direccion varchar(100),
 v_id_usuario int
)
BEGIN
 INSERT INTO clinica(direccion, estado) VALUES (v_direccion, 1);
 SET @clinica = (SELECT id_clinica from clinica order by id_clinica desc limit 1);
 INSERT INTO bitacora(accion,tabla,time,id_usuario) VALUES (CONCAT('Se ha insertado una clinica con el id: ' , @clinica), 'Clinica', now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS UpdateClinica;
DELIMITER //
CREATE PROCEDURE UpdateClinica(
 v_id_clinica int,
 v_direccion varchar(100),
 v_id_usuario int 
)
BEGIN
 UPDATE clinica SET direccion = v_direccion where id_clinica=v_id_clinica;
 INSERT INTO bitacora(accion,tabla,time,id_usuario) VALUES (CONCAT('Se ha modificado la clinica con el id: ' , v_id_clinica), 'Clinica',now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS DeleteClinica;
DELIMITER //
CREATE PROCEDURE DeleteClinica(
 v_id_clinica int,
 v_id_usuario int 
)
BEGIN
 UPDATE clinica SET estado= 0 where id_clinica=v_id_clinica;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha eliminado la clinica con el id: ' , v_id_clinica), 'Clinica', now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS InsertMedico;
DELIMITER //
CREATE PROCEDURE InsertMedico(
 v_nombre varchar (50),
 v_apellidop varchar(50),
 v_apellidom varchar(50),
 v_id_clinica int,
 v_id_usuario int
)
BEGIN
 INSERT INTO medico(nombre_medico, apellidop_medico, apellidom_medico, estado, id_clinica) VALUES (v_nombre, v_apellidop, v_apellidom, 1, v_id_clinica);
 SET @medico = (SELECT id_medico from medico order by id_medico desc limit 1);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha insertado un medico con el id: ' , @medico), 'Medico',now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS UpdateMedico;
DELIMITER //
CREATE PROCEDURE UpdateMedico(
 v_id_medico int,
 v_nombre varchar (50),
 v_apellidop varchar(50),
 v_apellidom varchar(50),
 v_id_clinica int,
 v_id_usuario int
)
BEGIN
 UPDATE medico SET nombre_medico=v_nombre, apellidop_medico=v_apellidop, apellidom_medico=v_apellidom, id_clinica=v_id_clinica where id_medico=v_id_medico;
 INSERT INTO bitacora(accion,tabla,time,id_usuario) VALUES (CONCAT('Se ha modificado un medico con el id: ' , v_id_medico), 'Medico', now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS DeleteMedico;
DELIMITER //
CREATE PROCEDURE DeleteMedico(
 v_id_medico int,
 v_id_usuario int
)
BEGIN
 UPDATE medico SET estado = 0 where id_medico=v_id_medico;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha eliminado un medico con el id: ' , v_id_medico), 'Medico',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS InsertLaboratorio;
DELIMITER //
CREATE PROCEDURE InsertLaboratorio(
 v_direccion varchar(100),
 v_nombre_lab varchar(50),
 v_nombre_enc_lab varchar(50),
 v_apellidop_enc_lab varchar(50),
 v_apellidom_enc_lab varchar(50),
 v_telefono_enc varchar(20),
 v_id_usuario int
)
BEGIN
 INSERT INTO laboratorio(direccion, nombre_lab, nombre_enc_lab, apellidop_enc_lab, apellidom_enc_lab, telefono_enc, estado) VALUES (v_direccion, v_nombre_lab, v_nombre_enc_lab, v_apellidop_enc_lab, v_apellidom_enc_lab, v_telefono_enc, 1);
 SET @laboratorio = (SELECT id_laboratorio from laboratorio order by id_laboratorio desc limit 1);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha insertado un laboratorio con el id: ' , @laboratorio), 'Laboratorio',now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS UpdateLaboratorio;
DELIMITER //
CREATE PROCEDURE UpdateLaboratorio(
 v_id_laboratorio int,
 v_direccion varchar(100),
 v_nombre_lab varchar(50),
 v_nombre_enc_lab varchar(50),
 v_apellidop_enc_lab varchar(50),
 v_apellidom_enc_lab varchar(50),
 v_telefono_enc varchar(20),
 v_id_usuario int
)
BEGIN
 UPDATE laboratorio SET direccion = v_direccion, nombre_lab = v_nombre_lab, nombre_enc_lab = v_nombre_enc_lab, apellidop_enc_lab = v_apellidop_enc_lab, apellidom_enc_lab = v_apellidom_enc_lab , telefono_enc = v_telefono_enc WHERE id_laboratorio = v_id_laboratorio;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha modificado el laboratorio con el id: ' , v_id_laboratorio), 'Laboratorio',now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS DeleteLaboratorio;
DELIMITER //
CREATE PROCEDURE DeleteLaboratorio(
 v_id_laboratorio int,
 v_id_usuario int
)
BEGIN
 UPDATE laboratorio SET estado = 0 WHERE id_laboratorio = v_id_laboratorio;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha eliminado el laboratorio con el id: ' , v_id_laboratorio), 'Laboratorio',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS InsertArmazon;
DELIMITER //
CREATE PROCEDURE InsertArmazon(
 v_stock_armazon int,
 v_marca varchar(20),
 v_descripcion varchar(20),
 v_precio_armazon decimal(7,2),
 v_imagen varchar(150),
 v_id_usuario int
)
BEGIN
 INSERT INTO armazon(stock_armazon, marca, descripcion, precio_armazon, imagen, estado) VALUES (v_stock_armazon, v_marca, v_descripcion, v_precio_armazon, v_imagen, v_estado);
 SET @armazon = (SELECT id_armazon from armazon order by id_armazon desc limit 1);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha insertado un armazon con el id: ' , @armazon), 'Armazon',now(), v_id_usuario);
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS UpdateArmazon;
DELIMITER //
CREATE PROCEDURE UpdateArmazon(
 v_id_armazon int,
 v_stock_armazon int,
 v_marca varchar(20),
 v_descripcion varchar(20),
 v_precio_armazon decimal(7,2),
 v_imagen varchar(150),
 v_id_usuario int
)
BEGIN
 UPDATE armazon SET stock_armazon= v_stock_armazon, marca=v_marca, descripcion=v_descripcion, precio_armazon = v_precio_armazon, imagen=v_imagen WHERE id_armazon = v_id_armazon;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha actualizado el armazon con el id: ' , v_id_armazon), 'Armazon',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS DeleteArmazon;
DELIMITER //
CREATE PROCEDURE DeleteArmazon(
 v_id_armazon int,
 v_id_usuario int
)
BEGIN
 UPDATE armazon SET estado = 0 WHERE id_armazon = v_id_armazon;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha eliminado el armazon con el id: ' , v_id_armazon), 'Armazon',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS SolicitarArmazon;
DELIMITER //
CREATE PROCEDURE SolicitarArmazon(
 v_id_pedido int,
 v_id_armazon int,
 v_cantidad int,
 v_id_usuario int
)
BEGIN
 INSERT INTO pedido_armazon (id_pedido, id_armazon, cantidad, estado) VALUES (v_id_pedido, v_id_armazon, v_cantidad, 1);
 SET @pedido_armazon = (SELECT id_armazon from armazon order by id_armazon desc limit 1);
 
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha solicitado el armazon con el id: ' , v_id_armazon), 'Pedido-Armazon',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS InsertPedido;
DELIMITER //
CREATE PROCEDURE InsertPedido(
 v_id_clinica int,
 v_id_laboratorio int,
 v_fecha_entrega date,
v_id_usuario int
)
BEGIN
 SET @anterior = (SELECT id_pedido from pedido order by id_pedido desc limit 1);
 UPDATE pedido SET estado = 'Pendiente' WHERE id_pedido = @anterior;
 INSERT INTO pedido (id_clinica, id_laboratorio, fecha_entrega, estado) VALUES (v_id_clinica, v_id_laboratorio, v_fecha_entrega, 'En Proceso');
 SET @actual= (SELECT id_pedido from pedido order by id_pedido desc limit 1);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha finalizado el pedido con el id: ' , @anterior), 'Pedido',now(), v_id_usuario);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha iniciado un pedido con el id: ' , @actual), 'Pedido',now(), v_id_usuario);
END //
DELIMITER ;




DROP PROCEDURE IF EXISTS SolicitarArmazon;
DELIMITER //
CREATE PROCEDURE SolicitarArmazon(
 v_id_armazon int,
 v_cantidad int,
 v_id_usuario int
)
BEGIN
 SET @actual= (SELECT id_pedido from pedido order by id_pedido desc limit 1);
 INSERT INTO pedido_armazon (id_pedido, id_armazon, cantidad, estado) VALUES (@actual, v_id_armazon, v_cantidad, 1);
 SET @pedido_armazon = (SELECT id_armazon from armazon order by id_armazon desc limit 1);
 
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha solicitado el armazon con el id: ' , v_id_armazon), 'Pedido-Armazon',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS CancelarArmazon;
DELIMITER //
CREATE PROCEDURE CancelarArmazon(
 v_id_pedido_armazon int,
 v_id_usuario int
)
BEGIN
 UPDATE pedido_armazon SET estado = 0 WHERE id_pedido_armazon= v_id_pedido_armazon;
 SET @armazon = (SELECT id_armazon from pedido_armazon WHERE id_pedido_armazon = v_id_pedido_armazon);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha cancelado el armazon con el id: ', @armazon), 'Pedido-Armazon',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS FinalizarPedidoArmazon;
DELIMITER //
CREATE PROCEDURE FinalizarPedidoArmazon(
 v_id_pedido_armazon int,
 v_id_armazon int,
 v_stock_armazon int,
 v_id_usuario int
)
BEGIN
 UPDATE pedido_armazon SET estado = 0 WHERE id_pedido_armazon = v_id_pedido_armazon;
 UPDATE armazon SET stock_armazon= v_stock_armazon WHERE id_armazon = v_id_armazon;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha actualizado el stock del armazon con el id: ' , v_id_armazon), 'Armazon',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS InsertMica;
DELIMITER //
CREATE PROCEDURE InsertMica(
 v_tipo varchar(50),
 v_descripcion varchar(50),
 v_precio_mica decimal(7,2),
 v_imagen varchar(150),
 v_id_usuario int
)
BEGIN
 INSERT INTO micas(tipo, descripcion, precio_mica, imagen, estado) VALUES (v_tipo, v_descripcion, v_precio_mica, v_imagen, 1);
 SET @mica = (SELECT id_micas from micas order by id_micas desc limit 1);
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha insertado una mica con el id: ' , @mica), 'Micas',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS UpdateMica;
DELIMITER //
CREATE PROCEDURE UpdateMica(
 v_id_mica int,
 v_tipo varchar(50),
 v_descripcion varchar(50),
 v_precio_mica decimal(7,2),
 v_imagen varchar(150),
 v_id_usuario int

)
BEGIN
 UPDATE micas SET tipo=v_tipo, descripcion = v_descripcion , precio_mica = v_precio_mica , imagen=v_imagen WHERE id_micas = v_id_mica;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha actualizado la mica con el id: ' , v_id_mica), 'Micas',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS DeleteMica;
DELIMITER //
CREATE PROCEDURE DeleteMica(
 v_id_mica int,
 v_id_usuario int
)
BEGIN
 UPDATE micas SET estado=0 WHERE id_micas = v_id_mica;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha eliminado la mica con el id: ' , v_id_mica), 'Micas',now(), v_id_usuario);
END //
DELIMITER ;

---------------------------------------------------------------Receta---------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS InsertReceta;
DELIMITER //
CREATE PROCEDURE InsertReceta(
  v_id_consulta int,
  v_id_mica int,
  v_g_ojo_d varchar(20), 
  v_g_ojo_i varchar(20),
  v_id_armazon int,
  v_costo_graduacion_d decimal(7,2),
  v_costo_graduacion_i decimal(7,2),
  v_id_usuario int
)
BEGIN
 SET @costoMica = (SELECT precio_mica from micas where id_micas = v_id_mica);
 SET @costoArmazon = (SELECT precio_armazon FROM armazon where id_armazon = v_id_armazon);
 SET @costoFinal = (@costoMica + @costoArmazon + v_costo_graduacion_d + v_costo_graduacion_i);
 SET @actual= (SELECT id_pedido from pedido order by id_pedido desc limit 1);
 INSERT INTO receta(id_consulta, id_pedido, id_mica, g_ojo_d, g_ojo_i, id_armazon, costo_graduacion_d, costo_graduacion_i, precio_total)
 VALUES (v_id_consulta, @actual, v_id_mica, v_g_ojo_d, v_g_ojo_i, v_id_armazon, v_costo_graduacion_d, v_costo_graduacion_i, @costoFinal);
 SET @receta = (SELECT id_receta from receta order by id_receta desc limit 1);
 
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha creado la receta con el id: ' , @receta), 'Receta',now(), v_id_usuario);
END //
DELIMITER ;




DROP PROCEDURE IF EXISTS InsertConsulta;
DELIMITER //
CREATE PROCEDURE InsertConsulta(
 v_nombre_paciente varchar(50),
 v_apellidop_paciente varchar(50),
 v_apellidom_paciente varchar(50),
 v_time datetime,
 v_id_clinica int,
 v_id_medico int,
 v_id_usuario int
)
BEGIN
 INSERT INTO consulta(nombre_paciente, apellidop_paciente, apellidom_paciente, time, id_clinica, id_medico) VALUES (v_nombre_paciente, v_apellidop_paciente, v_apellidom_paciente, now(), v_id_clinica, v_id_medico);
 SET @consulta= (SELECT id_consulta from consulta order by id_consulta desc limit 1);
 
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha agendado la consulta con el id: ' , @Consulta), 'Consulta',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS ModConsulta;
DELIMITER //
CREATE PROCEDURE ModConsulta(
 v_id_consulta int,
 v_nombre_paciente varchar(50),
 v_apellidop_paciente varchar(50),
 v_apellidom_paciente varchar(50),
 v_time datetime,
 v_id_clinica int,
 v_id_medico int,
 v_id_usuario int
)
BEGIN
 UPDATE consulta set nombre_paciente = v_nombre_paciente, apellidop_paciente = v_apellidop_paciente, apellidom_paciente = v_apellidom_paciente, time = v_time, id_clinica = v_id_clinica, id_medico = v_id_medico where id_consulta=v_id_consulta; 
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha modificado la consulta con el id: ' , v_id_consulta), 'Consulta',now(), v_id_usuario);
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS DelConsulta;
DELIMITER //
CREATE PROCEDURE DelConsulta(
  v_id_consulta int
)
BEGIN
 UPDATE consulta set estado=0 where id_consulta = v_id_consulta;
 INSERT INTO bitacora(accion,tabla,time, id_usuario) VALUES (CONCAT('Se ha eliminado la consulta con el id: ' , v_id_consulta), 'Consulta',now(), v_id_usuario);
END //
DELIMITER ;