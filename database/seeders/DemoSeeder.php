<?php

namespace Database\Seeders;

use App\Events\PostEvent;
use App\Models\Administrativo;
use App\Models\Alumno;
use App\Models\AlumnoProyecto;
use App\Models\Area;
use App\Models\Curso;
use App\Models\Gestor;
use App\Models\GestorCurso;
use App\Models\GestorProyecto;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\Post;
use App\Models\Presupuesto;
use App\Models\Proyecto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Datos de demostración del Sistema NCIE.
 *
 * Ejecutar:  php artisan db:seed --class=DemoSeeder
 *
 * ATENCIÓN: borra los datos del dominio (áreas, cursos, proyectos, presupuestos,
 * avisos, notificaciones y todos los usuarios excepto los de rol admin) antes de
 * volver a sembrarlos, para poder ejecutarse varias veces sin duplicar.
 * Todos los usuarios creados tienen la contraseña "12345678".
 */
class DemoSeeder extends Seeder
{
    private const PASSWORD = '12345678';

    public function run(): void
    {
        $this->limpiar();

        $hoy = Carbon::today();

        // ------------------------------------------------------------------ Áreas
        $areasData = [
            ['Desarrollo de Software', 'Aplicaciones web y móviles, sistemas de información y automatización de procesos para la academia y la industria.'],
            ['Inteligencia Artificial', 'Análisis de datos, visión por computadora, aprendizaje automático y desarrollo de videojuegos.'],
            ['Realidad Virtual y Aumentada', 'Experiencias inmersivas, simuladores de entrenamiento y aplicaciones de RA para manufactura y educación.'],
            ['Impresión 3D', 'Tecnologías de manufactura aditiva, diseño CAD, prototipado rápido y comunidad maker.'],
            ['Manufactura', 'Retro-acondicionamiento de maquinaria, fabricación de filamento, robótica y procesos de manufactura.'],
            ['Internet de las Cosas (IoT)', 'Monitoreo de condiciones, diseño electrónico, protocolos de comunicación y dispositivos conectados.'],
            ['Energías Renovables', 'Sistemas fotovoltaicos, eficiencia energética y proyectos de sustentabilidad para el campus.'],
        ];
        $areas = collect($areasData)->map(fn ($a) => Area::create(['nombre' => $a[0], 'descripcion' => $a[1]]));

        // --------------------------------------------------------- Administrativos
        $administrativosData = [
            ['María Fernanda', 'Rodríguez Ochoa', '6561234501', 'Ingeniería en Gestión Empresarial', 'Maestría en Administración'],
            ['Jorge Luis', 'Hernández Villa', '6561234502', 'Ingeniería Industrial', 'Maestría en Ingeniería Industrial'],
            ['Ana Karen', 'Salazar Muñoz', '6561234503', 'Licenciatura en Administración', 'Licenciatura'],
        ];
        foreach ($administrativosData as $i => $d) {
            $user = $this->crearUsuario("$d[0] $d[1]", 'admin.ncie' . ($i + 1) . '@itcj.edu.mx', 'administrativo');
            $adm = new Administrativo();
            $adm->nombres = $d[0];
            $adm->apellidos = $d[1];
            $adm->telefono = $d[2];
            $adm->carrera = $d[3];
            $adm->grado_academico = $d[4];
            $adm->user_id = $user->id;
            $adm->save();
        }

        // ---------------------------------------------------------------- Gestores
        // Un gestor por área; cada uno con un horario de atención (el sistema permite uno por gestor)
        $gestoresData = [
            ['Carlos Alberto', 'Mendoza Ruiz', '1988-03-12', '6562001001', 'Ingeniería en Sistemas Computacionales', 'Maestría en Ciencias de la Computación', 'LUNES', '09:00', '13:00'],
            ['Daniela', 'Torres Aguilar', '1990-07-25', '6562001002', 'Ingeniería en Sistemas Computacionales', 'Doctorado en Inteligencia Artificial', 'MARTES', '10:00', '14:00'],
            ['Luis Enrique', 'Padilla Cano', '1992-11-03', '6562001003', 'Ingeniería Mecatrónica', 'Maestría en Realidad Virtual', 'MIERCOLES', '11:00', '15:00'],
            ['Paola', 'Gutiérrez Lara', '1989-01-19', '6562001004', 'Ingeniería Mecánica', 'Maestría en Manufactura Aditiva', 'JUEVES', '09:00', '12:00'],
            ['Ricardo', 'Estrada Núñez', '1985-09-08', '6562001005', 'Ingeniería Industrial', 'Doctorado en Manufactura', 'VIERNES', '08:00', '12:00'],
            ['Alejandra', 'Ramírez Soto', '1993-05-30', '6562001006', 'Ingeniería Electrónica', 'Maestría en Sistemas Embebidos', 'LUNES', '14:00', '18:00'],
            ['Héctor', 'Vázquez Domínguez', '1987-12-14', '6562001007', 'Ingeniería Eléctrica', 'Maestría en Energías Renovables', 'MARTES', '15:00', '18:00'],
        ];
        $gestores = collect();
        foreach ($gestoresData as $i => $d) {
            $user = $this->crearUsuario("$d[0] $d[1]", 'gestor' . ($i + 1) . '@itcj.edu.mx', 'gestor');
            $gestor = Gestor::create([
                'nombres' => $d[0],
                'apellidos' => $d[1],
                'fecha_nacimiento' => $d[2],
                'celular' => $d[3],
                'carrera' => $d[4],
                'grado_academico' => $d[5],
                'user_id' => $user->id,
            ]);
            Horario::create([
                'dia' => $d[6],
                'hora_inicio' => $d[7] . ':00',
                'hora_fin' => $d[8] . ':00',
                'gestor_id' => $gestor->id,
                'area_id' => $areas[$i]->id,
            ]);
            $gestores->push($gestor);
        }

        // ----------------------------------------------------------------- Alumnos
        $carreras = [
            'Ingeniería en Sistemas Computacionales',
            'Ingeniería Mecatrónica',
            'Ingeniería Industrial',
            'Ingeniería Electrónica',
            'Ingeniería en Gestión Empresarial',
            'Ingeniería Eléctrica',
        ];
        $alumnosData = [
            ['Sofía', 'Martínez López', '2003-04-11'],
            ['Diego', 'Chávez Ortega', '2002-09-23'],
            ['Valeria', 'Campos Ibarra', '2004-01-05'],
            ['Emiliano', 'Reyes Cordero', '2003-06-17'],
            ['Regina', 'Flores Quintana', '2002-12-02'],
            ['Santiago', 'Ávila Márquez', '2004-03-28'],
            ['Ximena', 'Delgado Peña', '2003-08-14'],
            ['Mateo', 'Navarro Silva', '2002-05-09'],
            ['Camila', 'Rocha Barraza', '2004-10-21'],
            ['Sebastián', 'Ledezma Ponce', '2003-02-26'],
            ['Fernanda', 'Olivas Terrazas', '2002-07-07'],
            ['Andrés', 'Carrillo Baeza', '2003-11-30'],
        ];
        $alumnos = collect();
        foreach ($alumnosData as $i => $d) {
            $control = '2111' . str_pad((string) ($i + 1), 4, '0', STR_PAD_LEFT); // 8 dígitos
            $user = $this->crearUsuario("$d[0] $d[1]", 'l' . $control . '@cdjuarez.tecnm.mx', 'alumno');
            $alumno = new Alumno();
            $alumno->nombres = $d[0];
            $alumno->apellidos = $d[1];
            $alumno->fecha_nacimiento = $d[2];
            $alumno->celular = '656' . str_pad((string) (3000000 + $i * 1111), 7, '0', STR_PAD_LEFT);
            $alumno->numero_control = $control;
            $alumno->carrera = $carreras[$i % count($carreras)];
            $alumno->semestre = (string) (3 + ($i % 7));
            $alumno->user_id = $user->id;
            $alumno->save();
            $alumnos->push($alumno);
        }

        // ------------------------------------------------ Usuarios de la comunidad
        $usuariosData = [
            ['Laura Beltrán', 'laura.beltran@gmail.com'],
            ['Miguel Ángel Ortiz', 'miguel.ortiz@outlook.com'],
            ['Patricia Quezada', 'paty.quezada@gmail.com'],
            ['Roberto Zamora', 'roberto.zamora@hotmail.com'],
        ];
        $usuarios = collect();
        foreach ($usuariosData as $d) {
            $usuarios->push($this->crearUsuario($d[0], $d[1], 'usuario'));
        }

        // ------------------------------------------------------------------ Cursos
        // [nombre, inicio (días desde hoy), duración días, hora ini, hora fin, lugar, requisitos, modalidad, descripción, índices de gestores]
        $cursosData = [
            ['Introducción a la Impresión 3D', -45, 5, '10:00', '12:00', 'Laboratorio de Impresión 3D', 'Ninguno', 'presencial', 'Fundamentos de manufactura aditiva, laminado y operación de impresoras FDM.', [3]],
            ['Python para Análisis de Datos', -30, 10, '16:00', '18:00', 'Sala de cómputo NCIE', 'Laptop propia', 'en_linea', 'Pandas, NumPy y visualización de datos aplicados a problemas reales.', [1]],
            ['Diseño CAD con Fusion 360', -3, 8, '09:00', '11:00', 'Laboratorio de Impresión 3D', 'Conocimientos básicos de dibujo técnico', 'presencial', 'Modelado paramétrico para prototipado rápido.', [3, 4]],
            ['Desarrollo Web con Laravel', 2, 15, '17:00', '19:00', 'Sala de cómputo NCIE', 'PHP básico', 'en_linea', 'Construcción de aplicaciones web modernas con Laravel 10 y Blade.', [0]],
            ['Arduino e IoT desde cero', 6, 7, '10:00', '13:00', 'Laboratorio de Electrónica', 'Ninguno', 'presencial', 'Sensores, actuadores y comunicación MQTT con ESP32.', [5]],
            ['Visión por Computadora con OpenCV', 12, 10, '15:00', '17:00', 'Sala de cómputo NCIE', 'Python intermedio', 'presencial', 'Detección de objetos y procesamiento de imágenes en tiempo real.', [1]],
            ['Realidad Aumentada con Unity', 18, 12, '11:00', '13:00', 'Laboratorio de Realidad Virtual', 'Programación básica en C#', 'presencial', 'Creación de experiencias de RA para dispositivos móviles.', [2]],
            ['Robótica Educativa', 25, 6, '09:00', '12:00', 'Laboratorio de Manufactura', 'Ninguno', 'presencial', 'Ensamble y programación de robots móviles para nivel básico.', [4]],
            ['Energía Solar Fotovoltaica', 33, 8, '16:00', '18:00', 'Aula NCIE 2', 'Ninguno', 'en_linea', 'Dimensionamiento e instalación de sistemas fotovoltaicos residenciales.', [6]],
            ['Emprendimiento Tecnológico', 40, 5, '18:00', '20:00', 'Aula NCIE 1', 'Ninguno', 'en_linea', 'De la idea al modelo de negocio: Lean Canvas y pitch para proyectos tecnológicos.', [0, 6]],
        ];
        $cursos = collect();
        foreach ($cursosData as $c) {
            $inicio = $hoy->copy()->addDays($c[1]);
            $curso = Curso::create([
                'nombre' => $c[0],
                'fecha_inicio' => $inicio->toDateString(),
                'fecha_fin' => $inicio->copy()->addDays($c[2])->toDateString(),
                'hora_inicio' => $c[3] . ':00',
                'hora_fin' => $c[4] . ':00',
                'lugar' => $c[5],
                'requisitos' => $c[6],
                'modalidad' => $c[7],
                'descripcion' => $c[8],
            ]);
            foreach ($c[9] as $gi) {
                GestorCurso::create(['gestor_id' => $gestores[$gi]->id, 'curso_id' => $curso->id]);
            }
            $cursos->push($curso);
        }

        // ------------------------------------------------------------ Inscripciones
        $participantes = $alumnos->map(fn ($a) => $a->user_id)->merge($usuarios->pluck('id'))->values();
        $inscripciones = [
            // curso index => índices de participantes
            0 => [0, 1, 2, 3, 12],
            1 => [0, 4, 5, 6, 13, 14],
            2 => [1, 2, 7, 8],
            3 => [0, 3, 5, 9, 10, 12, 15],
            4 => [1, 4, 6, 8, 11],
            5 => [2, 5, 7, 9, 13],
            6 => [3, 6, 10, 11],
            7 => [4, 8, 14, 15],
            8 => [0, 9, 12],
            9 => [1, 7, 10, 11, 13, 15],
        ];
        foreach ($inscripciones as $ci => $idxs) {
            foreach ($idxs as $pi) {
                Inscripcion::create(['user_id' => $participantes[$pi], 'curso_id' => $cursos[$ci]->id]);
            }
        }

        // --------------------------------------------------------------- Proyectos
        $proyectosData = [
            ['Sistema de monitoreo de calidad del aire', 'Red de sensores IoT distribuidos en el campus con tablero web en tiempo real.', [5, 0]],
            ['Brazo robótico educativo de bajo costo', 'Diseño e impresión 3D de un brazo de 5 grados de libertad controlado con ESP32.', [3, 4]],
            ['Asistente virtual para trámites escolares', 'Chatbot con procesamiento de lenguaje natural para orientar a estudiantes del ITCJ.', [1]],
            ['Simulador de RV para seguridad industrial', 'Entrenamiento inmersivo en procedimientos de seguridad para empresas maquiladoras.', [2]],
            ['Planta piloto de filamento reciclado', 'Extrusión de filamento PLA a partir de residuos de impresión 3D.', [4, 3]],
            ['Sistema fotovoltaico para el edificio NCIE', 'Dimensionamiento e instalación de 10 kW de paneles solares con monitoreo.', [6]],
            ['Plataforma de gestión de cursos NCIE', 'Sistema web para administrar cursos, inscripciones y proyectos del nodo.', [0]],
            ['Visión artificial para control de calidad', 'Detección automática de defectos en piezas mediante cámaras y aprendizaje profundo.', [1, 4]],
        ];
        // Fotos de demostración: se copian desde la galería pública si aún no existen,
        // así el directorio uploads/ puede quedar fuera del repositorio.
        $fotosDir = public_path('uploads/fotos');
        if (! is_dir($fotosDir)) {
            mkdir($fotosDir, 0775, true);
        }
        foreach (range(1, count($proyectosData)) as $n) {
            $destino = $fotosDir . '/proyecto-' . $n . '.jpg';
            $origen = public_path('assets/img/gallery/galeria-' . $n . '.jpg');
            if (! file_exists($destino) && file_exists($origen)) {
                copy($origen, $destino);
            }
        }

        $proyectos = collect();
        foreach ($proyectosData as $i => $p) {
            $proyecto = Proyecto::create([
                'nombre' => $p[0],
                'descripcion' => $p[1],
                'fotos' => 'uploads/fotos/proyecto-' . ($i + 1) . '.jpg',
            ]);
            foreach ($p[2] as $gi) {
                GestorProyecto::create(['gestor_id' => $gestores[$gi]->id, 'proyecto_id' => $proyecto->id]);
            }
            $proyectos->push($proyecto);
        }

        // ----------------------------------------------------- Alumnos en proyectos
        $tipos = ['residencias', 'servicio_social', 'propio'];
        $asignaciones = [
            [0, 0, 'residencias'], [1, 0, 'servicio_social'], [2, 1, 'propio'], [3, 1, 'residencias'],
            [4, 2, 'servicio_social'], [5, 3, 'residencias'], [6, 4, 'servicio_social'], [7, 5, 'residencias'],
            [8, 6, 'servicio_social'], [9, 7, 'residencias'], [10, 2, 'propio'], [11, 7, 'servicio_social'],
            [0, 6, 'propio'], [3, 4, 'servicio_social'],
        ];
        foreach ($asignaciones as $k => $a) {
            $inicio = $hoy->copy()->subDays(90 - $k * 5);
            AlumnoProyecto::create([
                'alumno_id' => $alumnos[$a[0]]->id,
                'proyecto_id' => $proyectos[$a[1]]->id,
                'tipo' => $a[2],
                'fecha_inicio' => $inicio->toDateString(),
                'fecha_fin' => $inicio->copy()->addMonths($a[2] === 'servicio_social' ? 6 : 4)->toDateString(),
            ]);
        }

        // ------------------------------------------------------------ Presupuestos
        $presupuestosData = [
            ['Compra de filamento PLA y PETG para impresoras 3D', 8450.00, -120],
            ['Kit de desarrollo ESP32 y sensores ambientales (20 pzas)', 12300.50, -95],
            ['Licencias anuales de software CAD para el laboratorio', 24800.00, -80],
            ['Mantenimiento preventivo de impresoras 3D', 5600.00, -60],
            ['Paneles solares y microinversores para proyecto piloto', 96500.00, -45],
            ['Cascos de realidad virtual Meta Quest 3 (2 pzas)', 27980.00, -30],
            ['Material de electrónica y consumibles de soldadura', 3875.75, -18],
            ['Servidor GPU para entrenamiento de modelos de IA', 78900.00, -10],
            ['Reconocimientos y constancias para cursos de verano', 2150.00, -4],
            ['Difusión de convocatoria de cursos (impresos y redes)', 4300.00, 0],
        ];
        foreach ($presupuestosData as $p) {
            Presupuesto::create(['motivo' => $p[0], 'monto' => $p[1], 'fecha' => $hoy->copy()->addDays($p[2])->toDateString()]);
        }

        // ------------------------------------------------------ Avisos y notificaciones
        $admin = User::role('admin')->first();
        $administrativoUser = User::role('administrativo')->first();
        $gestorUser = $gestores[0]->user;

        $avisos = [
            [$admin, 'Bienvenidos al nuevo semestre en el NCIE', 'Iniciamos el semestre con una oferta de 10 cursos y 8 proyectos activos. Revisa el calendario y regístrate a tiempo.', false, -14],
            [$administrativoUser, 'Convocatoria abierta: residencias profesionales', 'Los proyectos del nodo reciben residentes de todas las carreras. Acude con el gestor del área para más información.', false, -9],
            [$gestorUser, 'Cambio de aula: Desarrollo Web con Laravel', 'El curso se impartirá en la Sala de cómputo NCIE a partir de la segunda sesión.', false, -3],
            [$admin, 'Nuevos cursos abiertos a la comunidad', 'Ya puedes inscribirte a Energía Solar Fotovoltaica y Emprendimiento Tecnológico desde el panel.', true, -1],
        ];
        foreach ($avisos as $a) {
            $post = Post::create(['title' => $a[1], 'description' => $a[2], 'user_id' => $a[0]->id]);
            $post->created_at = $hoy->copy()->addDays($a[4])->setTime(10, 30);
            $post->save();
            event(new PostEvent($post, $a[3]));
        }

        // Marcar como leídas algunas notificaciones para que la campana muestre ambas listas
        DB::table('notifications')->whereIn('id', function ($q) {
            $q->select('id')->from('notifications')->orderBy('created_at')->limit(10);
        })->update(['read_at' => now()]);

        $this->command?->info(sprintf(
            'Demo lista: %d áreas, %d gestores, %d administrativos, %d alumnos, %d usuarios, %d cursos, %d inscripciones, %d proyectos, %d presupuestos, %d avisos, %d notificaciones.',
            Area::count(), Gestor::count(), Administrativo::count(), Alumno::count(), User::role('usuario')->count(),
            Curso::count(), Inscripcion::count(), Proyecto::count(), Presupuesto::count(), Post::count(), DB::table('notifications')->count()
        ));
    }

    private function crearUsuario(string $nombre, string $email, string $rol): User
    {
        $user = User::create([
            'name' => $nombre,
            'email' => $email,
            'password' => Hash::make(self::PASSWORD),
            'email_verified_at' => now(),
        ]);
        $user->assignRole($rol);

        return $user;
    }

    private function limpiar(): void
    {
        DB::table('notifications')->delete();
        Post::query()->delete();
        Presupuesto::query()->delete();
        AlumnoProyecto::query()->delete();
        GestorProyecto::query()->delete();
        Proyecto::query()->delete();
        Inscripcion::query()->delete();
        GestorCurso::query()->delete();
        Curso::query()->delete();
        Horario::query()->delete();
        Alumno::query()->delete();
        Gestor::query()->delete();
        Administrativo::query()->delete();
        Area::query()->delete();

        $adminIds = User::role('admin')->pluck('id');
        User::whereNotIn('id', $adminIds)->delete();
    }
}
