<div style="text-align: center; margin-bottom:50px">
  <img src="assets/logos/logo_pet_shop.png" alt="Logo_Doggy_Friends">
</div>

# Tienda Online Doggy Friends

Bienvenido a nuestra tienda online especializada en productos para perros. Nuestro sitio web ofrece una amplia variedad de productos para satisfacer las necesidades de tu mascota, desde alimentos nutritivos hasta juguetes divertidos.

## Características del Sitio

- **Navegación Dinámica**: Nuestro sitio cuenta con un navbar dinámico que se adapta según el rol del usuario (Administrador, Depósito, Cliente).
- **Gestión de Usuarios**: Permite a los administradores crear y gestionar usuarios, asignar roles y actualizar información.
- **Carrito de Compras**: Panel lateral que muestra los productos seleccionados, permite modificar cantidades o eliminar productos, y calcula el precio final.
- **Comentarios y Valoraciones**: Los clientes pueden dejar comentarios y valoraciones sobre los productos comprados, ayudando a otros usuarios a tomar decisiones informadas.
- **Cambio de Roles**: Los usuarios pueden cambiar entre los roles asignados a su cuenta según sea necesario.
- **Actualizar panel menu**: Permite a los administradores gestionar los items del navbar

# Tecnologías Utilizadas en el Proyecto

Para el desarrollo de este proyecto se han utilizado las siguientes tecnologías:

### Lenguajes de Programación

- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
  ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

### Frameworks

- ![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=flat-square&logo=bootstrap&logoColor=white)

### Bibliotecas

- ![jQuery](https://img.shields.io/badge/jQuery-0769AD?style=flat-square&logo=jquery&logoColor=white)
  ![SweetAlert2](https://img.shields.io/badge/SweetAlert2-44CC11?style=flat-square&logo=sweetalert&logoColor=white)
  ![AJAX](https://img.shields.io/badge/AJAX-FF6C37?style=flat-square&logo=ajax&logoColor=white)

### Bases de Datos

- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
  ![phpMyAdmin](https://img.shields.io/badge/phpMyAdmin-6C78AF?style=flat-square&logo=phpmyadmin&logoColor=white)

### Librerías PHP

- ![phpdotenv](https://img.shields.io/badge/phpdotenv-4F5B93?style=flat-square&logo=phpdotenv&logoColor=white)
  ![PHPMailer](https://img.shields.io/badge/PHPMailer-3498DB?style=flat-square&logo=phpmailer&logoColor=white)
  ![stripe-php](https://img.shields.io/badge/stripe--php-6772E5?style=flat-square&logo=stripe&logoColor=white)

## Variables de Entorno

El proyecto utiliza archivos de entorno para manejar configuraciones sensibles y específicas del entorno.

- .env: Archivo principal de configuración de entorno que contiene las variables de entorno reales.

- .env.example: Archivo de ejemplo que muestra las variables de entorno necesarias sin los valores sensibles. Útil para configurar el entorno en diferentes máquinas.

**Nota:** Antes de comenzar con las instalaciones, revise el archivo .env.example y complete su propio archivo .env con las variables de entorno necesarias.

## Instalación

Para poner en marcha el proyecto, sigue los siguientes pasos:

1. Configurar XAMPP:

- Asegúrate de tener XAMPP instalado en tu máquina
- Inicia el servidor Apache y MySQL desde el panel de control de XAMPP

2. Posicionarse en la carpeta `htdocs`:

- Abre tu terminal y navega a la carpeta `htdocs` de XAMPP:

```bash
cd /path/to/xampp/htdocs
```

3. Clonar el repositorio:

- Clona el repositorio del proyecto en la carpeta `htdocs`:

```bash
git clone git@github.com:NachoCayuqueo/PWD_TPFinal.git
```

4. Importar la base de datos:

- Abre phpMyAdmin en tu navegador
- Crea una nueva base datos con el nombre que especificaste en tu archivo `.env`
- Importa el archivo `bdcarritocompras.sql` que se encuentra en la carpeta `sql` del proyecto.

  1. Selecciona la base de datos creada
  2. Ve a la pestaña "Importar" y selecciona el archivo `bdcarritocompras.sql`

5. Acceder al sitio Web:

- Abre tu navegador y navega a la siguiente URL para acceder a la página principal de la tienda:

```bash
http://localhost/PWD_TPFinal/app/views/home
```

## Configuración de Permisos para Imágenes de Productos

Asegúrate de que las siguientes carpetas tengan permisos de lectura y escritura para poder crear y editar archivos:

- `assets/images/products/accessories`
- `assets/images/products/food`
- `assets/images/products/toys`

### Configuración de Permisos

En sistemas Unix, utiliza los siguientes comandos:

```bash
chmod -R 777 assets/images/products/accessories
chmod -R 777 assets/images/products/food
chmod -R 777 assets/images/products/toys
```

## Cuentas de Testeo

Para facilitar el proceso de prueba, proporcionamos las siguientes cuentas de prueba:

### Usuarios Administradores Test

- **Email**: adminNacho@gmail.com - **Contraseña**: admin103149
- **Email**: adminPablo@gmail.com - **Contraseña**: admin114550

### Usuario Deposito Test

- **Email**: deposito@gmail.com - **Contraseña**: deposito123456

### Usuarios Cliente Test

Los correos electrónicos para los clientes de prueba siguen el formato `<nombre>@gmail.com`, donde `<nombre>` puede ser sustituido por el nombre del cliente específico.
La contraseña utiliza el siguiente formato: `cliente<nombre>`

- Ejemplo:
  - **Email**: luis@gmail.com - **Contraseña**: clienteluis

### Tarjeta Aprobada para pruebas con Stripe

[Stripe Testing](https://docs.stripe.com/testing?locale=es-419)

- Tarjeta Visa Argentina (AR)
  - **Número**: 4000000320000021

## Documentación Técnica

Para más detalles técnicos sobre la implementación del sitio, por favor consulta el archivo PDF de documentación técnica incluido en el proyecto.

La documentación técnica se encuentra en el siguiente directorio del proyecto: `docs/documentacion_tecnica.pdf`

## Autores

Somos dos desarrolladores apasionados por la tecnología y los perros. Ambos tenemos perros como mascotas, lo que nos inspiró a crear este proyecto.

- [@pabloaldana](https://github.com/pabloaldana)
- [@NachoCayuqueo](https://github.com/NachoCayuqueo)
