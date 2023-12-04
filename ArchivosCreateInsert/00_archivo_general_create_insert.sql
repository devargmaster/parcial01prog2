create table carrito
(
    id          int auto_increment
        primary key,
    fecha       datetime null comment 'defino la fecha y hora  que el cliente compro',
    usuario_id  int      null comment 'un carrito para cada cliente',
    estado      int      null comment 'sin procesar - en proceso - finalizado (finalizado me permite generar otro registro para el mismo usuario y queda el historico)',
    producto_id int      null,
    cantidad    int      null,
    precio      double   null,
    total       double   null
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
    fecha_upd            datetime                       null,
    usuario_upd          int                            null,
    constraint productos_marcas_id_fk
        foreign key (marca_id) references marcas (id)
);

create table informacion_adicional
(
    id          int auto_increment
        primary key,
    medidas     varchar(200) charset utf8mb4 null,
    peso        varchar(250) charset utf8mb4 null,
    material    varchar(250)                 null,
    origen      varchar(250)                 null,
    producto_id int                          not null,
    constraint informacion_adicional_productos_id_fk
        foreign key (producto_id) references productos (id)
            on update cascade on delete cascade
)
    comment 'tabla con la distinta informacion de materiales y medidas';

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

create table subcategorias
(
    id           int auto_increment
        primary key,
    nombre       varchar(250) charset utf8mb4 null,
    descripcion  varchar(500) charset utf8mb4 null,
    categoria_id int                          not null,
    esmenu    tinyint(1)                   null,
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
    rol      varchar(150)                 null comment '0 es administador, 1 es cliente',
    estado   tinyint(1) default 1         null
)
    comment 'contiene la base de clientes registrados';

INSERT INTO decotutti.marcas (marca_titulo, marca_descripcion) VALUES ('Floreros Chin', '');
INSERT INTO decotutti.marcas (marca_titulo, marca_descripcion) VALUES ('Tenedorsin', '');
INSERT INTO decotutti.marcas (marca_titulo, marca_descripcion) VALUES ('BazarChon', '');
INSERT INTO decotutti.marcas (marca_titulo, marca_descripcion) VALUES ('Sillonmaster', '');
INSERT INTO decotutti.marcas (marca_titulo, marca_descripcion) VALUES ('Eurekas', '');
INSERT INTO decotutti.marcas (marca_titulo, marca_descripcion) VALUES ('DecoraTutti', 'Marca propia');


INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Florero Tarff Ambar', 29500, 'Espléndido por su forma y por su efecto tipo carey, nuestro florero Tarff está hecho en vidrio en color ámbar. Su diseño, sin dudas, logrará un acento en la decoración de su hogar, ya sea en mesas bajas o mesas de comedor. Disponible en dos tonalidades. Conoce toda nuestra línea de floreros.', '1700676177.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Florero Thay - Small', 19500, 'Florero contemporáneo, hecho íntegramente en liso vidrio transparente en color ámbar. Su forma lo hace perfecto para mostrar un ramo de flores frescas, y sirve a su vez, como elemento decorativo para toda sala de estar o comedor. Disponible en dos medidas. Conoce toda nuestra línea de floreros.', '1700676976.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Florero Leoti - Small', 81300, 'De diseño llamativo, gracias a su patrón rítmico, este florero resaltará la decoración en cualquier hogar aportando mucho estilo y originalidad. Nuestro impresionante florero de vidrio tallado utiliza una forma cilíndrica con base lisa en color café. Los materiales y las formas simples, pero con gran presencia visual facilitan la decoración de mesas y consolas. Disponible en dos medidas. Conoce toda nuestra línea de floreros.', '1700677095.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Florero Oxbo Medium', 81300, 'De diseño llamativo, gracias a su patrón rítmico, este florero resaltará la decoración en cualquier hogar aportando mucho estilo y originalidad. Nuestro impresionante florero de vidrio tallado utiliza una forma cilíndrica con base lisa en color café. Los materiales y las formas simples, pero con gran presencia visual facilitan la decoración de mesas y consolas. Disponible en dos medidas. Conoce toda nuestra línea de floreros.', '1700677150.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Florero Abill', 150000, 'Centrándose en las sutilezas de las formas, nuestro florero Abill está elaborado en vidrio en color blanco opaco. Esta pieza original y sofisticada está pensada para la exhibición de flores o como adorno decorativo en mesas bajas y consolas de espacios modernos. Conoce toda nuestra línea de floreros.', '1700677253.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Cuadro Silueta Fugura 2 - 50x70', 109480, 'El arte lineal se destaca en nuestro elegante cuadro confeccionado con madera de marupa natural en su estructura y lámina pintada a mano con tinta china. El diseño sutil de siluetas hace de este cuadro una obra minimalista y elegante ideal para decorar cualquier pared de su hogar. Mezcle y combine nuestros diferentes cuadros de siluetas y logre una expresión delicada y artística. Dado su trabajo artesanal cada pieza es única. Conoce toda nuestra colección de cuadros.', '1700677671.webp', 10, 1, 1, '2023-11-22', 5, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Alhajero Insecto Acrilico', 107900, 'Inspirado en la naturaleza exótica, nuestro alhajero rectangular con incrustación de insecto dorado está elaborado en resina y caja de acrílico transparente. Diseñado para exhibir artículos personales u objetos pequeños, es un elemento ideal para el tocador, sala de estar o dormitorio.', '1700681931.webp', 2, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Frasco Rocabar Tapa De Metal', 176900, 'Diseñado para contener y almacenar cualquier tipo de elemento, este frasco está elaborado en vidrio tallado con un patrón geométrico de cuadrícula y tapa de bronce opaco. Con reminiscencia a accesorios utilizados en antiguos boticarios, aportará un característico toque vintage con aire moderno a toda decoración. Disponible en dos medidas.', '1700682140.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Banqueta Alta Airman Brown', 794000, 'Banqueta alta inspirada en los asientos de cabina del avión militar americano F-14 Tomcat. Las curvas aerodinámicas están recubiertas en aluminio remachado sometidas a un proceso de cinco etapas de desgaste para crear el exclusivo acabado. El asiento está tapizado en cuero natural y es regulable en altura. El acabado de desgaste puede variar de una pieza a otra. Disponible también en color negro.', '1700682431.webp', 10, 1, 1, '2023-11-22', 4, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Mesa De Comedor Chimay', 794000, 'Mesa de comder Chimay que combina la rusticidad de la madera de roble natural autóctono con pátina negra con el brillo del acero pulido de su estructura, creando un contraste de texturas único. Ideal para otorgar un toque rústico a un comedor sofisticado.', '1700682593.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Lampara De Pie Focus Nickel', 794000, 'De estilo contemporáneo y simple esta lámpara de pie está hecha íntegramente en metal con terminación níquel. Su altura regulable y diseño versátil, permite su uso en distintos espacios y direccionar el haz de luz según preferencia. Utilícela junto a su sillón o sofá como luz de lectura o ambiental. Disponible también con terminación en color broncE. Foco no incluido.', '1700682746.webp', 12, 1, 1, '2023-11-22', 5, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Porta Utensilios Lines', 150000, 'Con su practicidad característica, nuestro porta utensilios a rayas está hecho en mármol pulido en colores blanco y negro. Este organizador de bazar es perfecto para mantener la cocina ordenada de forma elegante y con estilo sofisticado, conteniendo utensilios prácticos para la hora de cocinar. Combina este porta utensilios con nuestra tabla de la misma colección. Las variaciones en el veteado natural hacen que cada pieza de mármol sea única.', '1700682850.webp', 12, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Individual Bouro', 17500, 'Celebrando la belleza de un delicado tejido hecho a mano en seagrass, nuestro individual rico en textura agrega una rusticidad y calidez acogedora a toda mesa de comedor. Conozca todos nuestros individuales confeccionados en fibras naturales.', '1700683016.webp', 10, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Individual Povoa Black', 11000, 'Individual redondo de carácter rústico y moderno. Celebrando la belleza de un delicado tejido hecho a mano en seagrass en color negro, nuestro individual rico en textura agrega una rusticidad y calidez acogedora a toda mesa de comedor. Conozca todos nuestros individuales confeccionados en fibras naturales.', '1700683131.webp', 10, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Canvas Crown', 10500, 'Esta impresión en lienzo es una reproducción de la partitura de Crown Diamonds..', '1700683327.webp', 1, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Salero y Pimentero Nagpu', 69000, 'Nuestro set de salero y pimentero agrega un toque de estilo a lo   esencial de todos los días. Hecho de acero inoxidable, franjas blancas y negras de nácar aportan un diseño atemporal y elegante a cualquier mesa. Incluye caja decorativa perfecta para mantenerlos ordenados o como regalo.', '1700702395.webp', 10, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Posavasos Teak con Caja', 60400, 'Hechos de acero pulido y madera natural de teca, nuestro set de posavasos moderno y atemporal', '1700702410.webp', 10, 1, 1, '2023-11-22', 3, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Lampara De Mesa Ontario Three', 224100, 'Nuestra lámpara de mesa vintage y encanto industrial aporta distinción a cualquier ambiente con su apariencia tradicional y estilo contemporáneo. La campana de vidrio se apoya en una base que muestra bombillas de filamento estilo Edison generando un ambiente de luz tenue y haciendo una declaración refinada y llamativa en la sala de estar, entrada, dormitorio u oficina. Incluye focos tipo vintage; la forma de este puede variar respecto a las imágenes mostradas. Disponible en diferentes medidas', '1700703870.webp', 10, 1, 1, '2023-11-22', 1, 1, null, null);
INSERT INTO decotutti.productos (producto_nombre, producto_precio, producto_descripcion, producto_imagen, producto_stock, producto_destacado, producto_nuevo, producto_fecha, marca_id, producto_estado, fecha_upd, usuario_upd) VALUES ('Set De Cubiertos De Queso Brais', 70000, 'Nuestro set de cubiertos de quesos está elaborado en acero inoxidable con terminación niqueladas y mangos en delicada resina símil hueso. Pensados para una mesa con estilo, este accesorio de bazar es funcional siendo un complemento perfecto para cortar y untar quesos dando un toque único. Nuestro set incluye un juego completo de 2 cuchillos de queso en caja decorativa. No apto para lavavajillas.', '1700703966.webp', 10, 1, 1, '2023-11-22', 2, 1, null, null);


INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('18 x 18 x 30 cm', '2,5 kg', 'Vidrio', 'China', 13);
INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('18 x 18 x 50 cm', '1,5 kg', 'Vidrio', 'China', 14);
INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('', '', '', '', 15);
INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('', '', '', '', 16);
INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('25 x 32 x 32 cm', '3,7 kg', 'Vidrio', 'China', 17);
INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('45x22x22CM', '3,5 kg', 'Vidrio', 'China', 18);
INSERT INTO decotutti.informacion_adicional (medidas, peso, material, origen, producto_id) VALUES ('', '', '', '', 19);

INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Home', 'home', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Catálogo', 'catalogo', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Bazar', 'bazar', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Comedor', 'comedor', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Decor', 'decor', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Iluminación', 'iluminacion', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Mis Datos', 'datos_alumno', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Contactanos!', 'contacto', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Carrito', 'carrito', 1);
INSERT INTO decotutti.categorias (nombre, descripcion, habilitada) VALUES ('Usuario', 'usuario', 1);

INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Utensillos', 'utensillos', 3, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Textiles', 'textiles', 3, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Floreros', 'floreros', 5, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Ingresar', 'login', 10, 1);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Salir', 'logout', 10, 1);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Cuadros', 'cuadros', 5, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Almacenaje', 'almacenaje', 5, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Sillas', 'sillas', 4, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Mesas', 'mesas', 4, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Iluminacion de pie', 'iluminacion_pie', 6, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Iluminación de Mesa', 'iluminacion_mesa', 6, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Carteles', 'carteles', 5, 0);
INSERT INTO decotutti.subcategorias (nombre, descripcion, categoria_id, esmenu) VALUES ('Accesorios', 'accesorios', 3, 0);


INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (13, 3);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (14, 3);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (15, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (16, 3);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (17, 3);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (3, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (1, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (2, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (4, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (5, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (6, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (7, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (8, 5);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (11, 6);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (9, 4);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (10, 4);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (12, 3);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (18, 6);
INSERT INTO decotutti.productos_categorias (producto_id, categoria_id) VALUES (19, 3);


INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (1, 3);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (2, 3);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (3, 3);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (4, 3);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (5, 3);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (7, 7);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (8, 7);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (17, 13);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (16, 13);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (11, 10);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (6, 6);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (15, 12);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (9, 8);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (10, 9);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (13, 2);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (14, 2);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (12, 13);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (18, 11);
INSERT INTO decotutti.productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (19, 1);


INSERT INTO decotutti.usuarios (nombre, apellido, email, usuario, clave, rol, estado) VALUES ('Walter', 'Arce', 'walter.arce@davinci.edu.ar', 'warce2', '$2y$10$t9ebat3Ioe0g38zM3td40uroHuvCSS9ozIhWNqqetjQD1bsEZBGCu', 'administrador', 1);
INSERT INTO decotutti.usuarios (nombre, apellido, email, usuario, clave, rol, estado) VALUES ('Walter', 'Arce', 'walterarce@gmail.com', 'warce', '$2y$10$fi.RBksNtVNk8qz.YX.M6erIZ5HgHCXE9IXSmVJfl1RnkDONs8CCq', 'usuario', 1);
