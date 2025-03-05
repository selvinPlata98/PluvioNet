@extends('layout/plantilla')

@section('tituloPagina', 'Pagina Principal')
@section('contenido')

<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis maiores tempore veritatis itaque voluptatibus ducimus deleniti rerum sed quibusdam, repellendus, delectus tenetur possimus corporis in, vero quod. Est, nemo illum?</p>
<div class="container">
            <h1 class="display-4">Construye tu propio Pluviómetro Digital</h1>
            <p class="lead">Descubre cómo medir la cantidad de lluvia con un dispositivo hecho con Arduino. ¡Un proyecto educativo y práctico!</p>
            <a href="#proyecto" class=" btn-primary">Explorar el Proyecto</a>
        </div>
    </header>

    <!-- Proyecto Section -->
    <section class="py-5" id="proyecto">
        <div class="container">
            <h2 class="text-center mb-4">¿Qué es un Pluviómetro?</h2>
            <p class="text-center">Un pluviómetro es un dispositivo que mide la cantidad de lluvia caída en un período de tiempo. En este proyecto, utilizaremos Arduino para construir un pluviómetro digital que registre y analice los datos de precipitación.</p>
            
            <div class="row mt-5">
                <div class="col-md-6">
                    <h3>¿Qué aprenderás?</h3>
                    <ul>
                        <li>Cómo usar sensores de lluvia con Arduino.</li>
                        <li>Cómo registrar datos de precipitación.</li>
                        <li>Cómo visualizar los datos en tiempo real.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/500x300" alt="Pluviómetro Arduino" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto Section -->
    <section class="bg-primary text-white py-5" id="contacto">
        <div class="container">
            <h2 class="text-center mb-4">Contáctanos</h2>
            <p class="text-center">¿Tienes preguntas sobre el proyecto? ¡Escríbenos!</p>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="Tu correo electrónico">
                </div>
                <div class="col-12">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" rows="4" placeholder="Escribe tu mensaje aquí"></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-light">Enviar</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2025 Pluviómetro Arduino. Todos los derechos reservados.</p>
    </footer>


@endsection