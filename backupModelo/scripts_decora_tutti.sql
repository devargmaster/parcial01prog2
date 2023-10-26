create table carrito
(
    id         int auto_increment
        primary key,
    fecha      datetime null comment 'defino la fecha y hora  que el cliente compro',
    usuario_id int      null comment 'un carrito para cada cliente',
    estado     int      null comment 'sin procesar - en proceso - finalizado (finalizado me permite generar otro registro para el mismo usuario y queda el historico)'
);

create table categorias
(
    id                    int auto_increment
        primary key,
    categoria_nombre      varchar(250) null,
    categoria_descripcion varchar(500) null
)
    comment 'tabla que contiene la categoria de productos';

create table informacion_adicional
(
    id                    int auto_increment
        primary key,
    caracteristica_nombre varchar(200) null,
    caracteristica_valor  varchar(250) null
)
    comment 'tabla con la distinta informacion de materiales y medidas';

create table marcas
(
    id                int auto_increment
        primary key,
    marca_titulo      varchar(250) null,
    marca_descripcion varchar(500) null
);

create table productos
(
    id                        int auto_increment comment 'id de tabla'
        primary key,
    producto_nombre           varchar(200) null comment 'titulo del producto',
    producto_precio           double       null comment 'define el precio del producto',
    producto_descripcion      varchar(500) null comment 'descripcion del producto',
    producto_imagen           varchar(100) null comment 'ruta al archivo de imagen',
    producto_stock            int          null,
    producto_oferta_id        int          null,
    producto_destacado        int          null,
    producto_nuevo            int          null,
    producto_fecha            date         null,
    producto_inf_adicional_id int          null,
    marca_id                  int          null,
    constraint productos_informacion_adicional_id_fk
        foreign key (producto_inf_adicional_id) references informacion_adicional (id),
    constraint productos_marcas_id_fk
        foreign key (marca_id) references marcas (id)
);

create table ofertas
(
    id                 int auto_increment
        primary key,
    oferta_descripcion varchar(500) null,
    oferta_titulo      varchar(250) null,
    producto_id        int          null,
    constraint ofertas_productos_id_fk
        foreign key (producto_id) references productos (id)
);

create table productos_carrito
(
    producto_id int null,
    carrito_id  int null,
    constraint productos_carrito_carrito_id_fk
        foreign key (carrito_id) references carrito (id),
    constraint productos_carrito_productos_id_fk
        foreign key (producto_id) references productos (id)
)
    comment 'permite ingresar multiples productos a un carrito de usuario';

create table productos_categorias
(
    producto_id  int null,
    categoria_id int null,
    constraint productos_categorias_categorias_id_fk
        foreign key (categoria_id) references categorias (id),
    constraint productos_categorias_productos_id_fk
        foreign key (producto_id) references productos (id)
)
    comment 'genera la relacion de varios productos con varias categorias';

create table subcategorias
(
    id          int auto_increment
        primary key,
    nombre      varchar(250) null,
    descripcion varchar(500) null
)
    comment 'representa una subcategoria desgranando mejor las categorias padre';

create table productos_categorias_subcategorias
(
    producto_id     int null,
    categoria_id    int null,
    subcategoria_id int null,
    constraint productos_categorias_subcategorias_categorias_id_fk
        foreign key (categoria_id) references categorias (id),
    constraint productos_categorias_subcategorias_productos_id_fk
        foreign key (producto_id) references productos (id),
    constraint productos_categorias_subcategorias_subcategorias_id_fk
        foreign key (subcategoria_id) references subcategorias (id)
);

create table usuarios
(
    id       int auto_increment
        primary key,
    nombre   varchar(250) null,
    apellido varchar(250) null,
    email    varchar(300) null,
    usuario  varchar(250) null,
    clave    varchar(250) null
)
    comment 'contiene la base de clientes registrados';


