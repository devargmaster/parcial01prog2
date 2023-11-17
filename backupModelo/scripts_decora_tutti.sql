create table carrito
(
    id         int auto_increment
        primary key,
    fecha      datetime null comment 'defino la fecha y hora  que el cliente compro',
    usuario_id int      null comment 'un carrito para cada cliente',
    estado     int      null comment 'sin procesar - en proceso - finalizado (finalizado me permite generar otro registro para el mismo usuario y queda el historico)'
);

create index carrito_usuario_id_index
    on carrito (usuario_id);

create table categorias
(
    id          int auto_increment
        primary key,
    nombre      varchar(250) charset utf8mb4 null,
    descripcion varchar(500) charset utf8mb4 null,
    habilitada  int default 0                null
)
    comment 'tabla que contiene la categoria de productos';

create table informacion_adicional
(
    id          int auto_increment
        primary key,
    medidas     varchar(200) charset utf8mb4 null,
    peso        varchar(250) charset utf8mb4 null,
    material    varchar(250)                 null,
    origen      varchar(250)                 null,
    producto_id int                          not null
)
    comment 'tabla con la distinta informacion de materiales y medidas';

create table marcas
(
    id                int auto_increment
        primary key,
    marca_titulo      varchar(250) charset utf8mb4 null,
    marca_descripcion varchar(500) charset utf8mb4 null
);

create table productos
(
    id                   int auto_increment comment 'id de tabla'
        primary key,
    producto_nombre      varchar(200) charset utf8mb4   null comment 'titulo del producto',
    producto_precio      double                         null comment 'define el precio del producto',
    producto_descripcion varchar(500) charset utf8mb4   null comment 'descripcion del producto',
    producto_imagen      varchar(100) charset utf8mb4   null comment 'ruta al archivo de imagen',
    producto_stock       int        default 0           not null,
    producto_destacado   tinyint(1) default 0           null,
    producto_nuevo       tinyint(1) default 1           null,
    producto_fecha       date       default (curdate()) null,
    marca_id             int                            null,
    producto_estado      tinyint(1) default 0           null comment 'se define un estado para no mostrar inmediatamente un producto recien cargado (activo - [noactivo])',
    constraint productos_marcas_id_fk
        foreign key (marca_id) references marcas (id)
);

create table ofertas
(
    id                 int auto_increment
        primary key,
    oferta_descripcion varchar(500) charset utf8mb4 null,
    oferta_titulo      varchar(250) charset utf8mb4 null,
    producto_id        int                          null,
    constraint ofertas_productos_id_fk
        foreign key (producto_id) references productos (id)
            on update cascade
);

create table productos_carrito
(
    producto_id int null,
    carrito_id  int null,
    constraint productos_carrito_carrito_id_fk
        foreign key (carrito_id) references carrito (id)
            on delete cascade,
    constraint productos_carrito_productos_id_fk
        foreign key (producto_id) references productos (id)
            on delete cascade
)
    comment 'permite ingresar multiples productos a un carrito de usuario';

create table productos_categorias
(
    producto_id  int null,
    categoria_id int null,
    id           int auto_increment
        primary key,
    constraint productos_categorias_categorias_id_fk
        foreign key (categoria_id) references categorias (id)
            on delete cascade,
    constraint productos_categorias_productos_id_fk
        foreign key (producto_id) references productos (id)
            on delete cascade
)
    comment 'genera la relacion de varios productos con varias categorias';

create table roles
(
    id              int auto_increment
        primary key,
    rol_descripcion varchar(250) charset utf8mb4 null
);

create table subcategorias
(
    id           int auto_increment
        primary key,
    nombre       varchar(250) charset utf8mb4 null,
    descripcion  varchar(500) charset utf8mb4 null,
    categoria_id int                          not null,
    constraint subcategorias_categorias_id_fk
        foreign key (categoria_id) references categorias (id)
            on update cascade
)
    comment 'representa una subcategoria desgranando mejor las categorias padre';

create table productos_categorias_subcategorias
(
    producto_id     int null,
    subcategoria_id int null,
    id              int auto_increment
        primary key,
    constraint productos_categorias_subcategorias_productos_id_fk
        foreign key (producto_id) references productos (id)
            on update cascade on delete cascade,
    constraint productos_categorias_subcategorias_subcategorias_id_fk
        foreign key (subcategoria_id) references subcategorias (id)
            on update cascade on delete cascade
);

create table usuarios
(
    id       int auto_increment
        primary key,
    nombre   varchar(250) charset utf8mb4 null,
    apellido varchar(250) charset utf8mb4 null,
    email    varchar(300) charset utf8mb4 null,
    usuario  varchar(250) charset utf8mb4 null,
    clave    varchar(250) charset utf8mb4 null,
    rol_id   int                          null
)
    comment 'contiene la base de clientes registrados';

