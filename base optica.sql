drop database opticasucursal;
create database opticasucursal;
use opticasucursal;

create table clinica(
    id_clinica int auto_increment,
    direccion varchar(100),
    estado int,
    PRIMARY KEY (id_clinica)
);

create table medico(
    id_medico int auto_increment,
    cedula varchar(50),
    nombre_medico varchar (50),
    apellidop_medico varchar(50),
    apellidom_medico varchar(50),
    estado int,
    id_clinica int,
    PRIMARY KEY (id_medico),
    CONSTRAINT fk_medico_clinica FOREIGN KEY (id_clinica) REFERENCES clinica(id_clinica)
);



create table laboratorio(
    id_laboratorio int auto_increment,
    direccion varchar(100),
    nombre_lab varchar(50),
    nombre_enc_lab varchar(50),
    apellidop_enc_lab varchar(50),
    apellidom_enc_lab varchar(50),
    telefono_enc varchar(20),
    estado int,
    PRIMARY KEY (id_laboratorio)
);

create table pedido(
    id_pedido int auto_increment,
    id_clinica int,
    id_laboratorio int,
    fecha_entrega date,
    estado ENUM('En Proceso','Pediente','Entregado','Cancelado'),
    PRIMARY KEY(id_pedido),
    CONSTRAINT fk_pedido_clinica FOREIGN KEY (id_clinica) REFERENCES clinica(id_clinica),
    CONSTRAINT fk_pedido_laboratorio FOREIGN KEY (id_laboratorio) REFERENCES laboratorio(id_laboratorio)
);


create table armazon(
    id_armazon int auto_increment,
    stock_armazon int,
    marca varchar(20),
    descripcion varchar(20),
    precio_armazon decimal(7,2),
    imagen varchar(150),
    estado int,
    PRIMARY KEY(id_armazon)
);

create table micas(
    id_micas int auto_increment,
    tipo varchar(50),
    descripcion varchar(50),
    precio_mica decimal(7,2),
    imagen varchar(150),
    estado int,
    PRIMARY KEY(id_micas)
);

create table pedido_armazon(
    id_pedido_armazon int auto_increment,
    id_pedido int,
    id_armazon int,
    cantidad int,
    estado int,
    PRIMARY KEY (id_pedido_armazon),
    CONSTRAINT fk_pedido_armazon_pedido FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
    CONSTRAINT fk_pedido_armazon_armazon FOREIGN KEY (id_armazon) REFERENCES armazon(id_armazon)
);

create table usuarios(
    id_usuario int auto_increment,
    nombre varchar(50) not null,
    apellidos varchar(70) not null,
    usuario varchar(25) unique not null,
    contrasena text not null,
    estado ENUM('Baja', 'Offline', 'Online'),
    tipo ENUM('Admin', 'Operador'),
    id_administrador int,
    id_clinica int,
    PRIMARY KEY (id_usuario),
    CONSTRAINT fk_usuarios_clinica FOREIGN KEY (id_clinica) REFERENCES clinica(id_clinica)
);


create table clinica_laboratorio(
    id_clinica_laboratorio int auto_increment,
    id_clinica int,
    id_laboratorio int,
    PRIMARY KEY(id_clinica_laboratorio),
    CONSTRAINT fk_cl_clinica FOREIGN KEY (id_clinica) REFERENCES clinica(id_clinica),
    CONSTRAINT fk_cl_laboratorio FOREIGN KEY (id_laboratorio) REFERENCES laboratorio(id_laboratorio)

);

create table consulta(
    id_consulta int auto_increment,
    nombre_paciente varchar(50),
    apellidop_paciente varchar(50),
    apellidom_paciente varchar(50),
    time datetime,
    id_clinica int,
    id_medico int,
    estado int DEFAULT 1,
    PRIMARY KEY(id_consulta),
    CONSTRAINT fk_clinica_consulta FOREIGN KEY (id_clinica) REFERENCES clinica(id_clinica),
    CONSTRAINT fk_clinica_medico FOREIGN KEY (id_medico) REFERENCES medico(id_medico)
);

create table receta(
    id_receta int auto_increment,
    id_consulta int,
    id_pedido int,
    id_mica int,
    g_ojo_d varchar(20), 
    g_ojo_i varchar(20),
    id_armazon int,
    costo_graduacion_d decimal(7,2),
    costo_graduacion_i decimal(7,2),
    precio_total decimal(8.2),
    PRIMARY KEY (id_receta),
    CONSTRAINT fk_receta_armazon FOREIGN KEY (id_armazon) REFERENCES armazon(id_armazon),
    CONSTRAINT fk_receta_consulta FOREIGN KEY (id_consulta) REFERENCES consulta(id_consulta),
    CONSTRAINT fk_receta_pedido FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
    CONSTRAINT fk_receta_mica FOREIGN KEY (id_mica) REFERENCES micas(id_micas)
);

create table bitacora(
   id_bitacora int auto_increment,
   accion varchar(150),
   tabla varchar(50),
   time datetime,
   id_usuario int,
   PRIMARY KEY (id_bitacora),
   CONSTRAINT fk_bitacora_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);


create table log(
    id_log int auto_increment,
    id_usuario int not null,
    usuario varchar(25) not null,
    date_entrada DATETIME not null,
    date_salida DATETIME,
    PRIMARY KEY(id_log),
    CONSTRAINT fk_idusuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);