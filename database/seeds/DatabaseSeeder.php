<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Complejo;
use App\Pista;
use App\Chat;
use App\Mensaje;
use App\Contacta;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsers();
        self::complejos();
        self::seedPistas();
        self::seedMensajes();
        self::seedContactas();
        self::seedChats();
    }

    private function seedUsers()
    {
        DB::table('users')->delete();

        $usuario = new User();
        $usuario->email = 'cobosmdc@gmail.com';
        $usuario->name = 'admin';
        $usuario->apellidos = 'admin';
        $usuario->fecha_nac = '719513280';
        $usuario->rol = 'admin';
        $usuario->email_verified_at = new DateTime();
        $usuario->password = Hash::make('1234567890');
        $usuario->save();

        $usuario = new User();
        $usuario->email = 'a@gmail.com';
        $usuario->name = 'a';
        $usuario->apellidos = 'a';
        $usuario->fecha_nac = '719513280';
        $usuario->email_verified_at = new DateTime();
        $usuario->password = Hash::make('1234567890');
        $usuario->save();

    }

    private function complejos()
    {
        DB::table('complejos')->delete();

        $complejo = new Complejo();
        $complejo->lugar = 'Moriles';
        $complejo->direccion = 'Avenida del Deporte';
        $complejo->foto = 'imagenes/moriles.png';
        $complejo->descripcion = 'descripcion';
        $complejo->coorX = '37.439475';
        $complejo->coorY = '-4.604238';
        $complejo->save();

        $complejo = new Complejo();
        $complejo->lugar = 'FernanNuñez';
        $complejo->direccion = 'Carretera la Rambla';
        $complejo->foto = 'imagenes/fernannunez.jpg';
        $complejo->descripcion = 'descripcion';
        $complejo->coorX = '37.665880';
        $complejo->coorY = '-4.727652';
        $complejo->save();

        $complejo = new Complejo();
        $complejo->lugar = 'Lucena';
        $complejo->direccion = 'Calle del Deporte';
        $complejo->foto = 'imagenes/lucena.png';
        $complejo->descripcion = 'descripcion';
        $complejo->coorX = '37.407894';
        $complejo->coorY = '-4.473263';
        $complejo->save();

    }

    private function seedPistas()
    {
        DB::table('pistas')->delete();

        $pista = new Pista();
        $pista->complejo_id = 1;
        $pista->foto = 'imagenes/moriles.jpg';
        $pista->descripcion = 'descripcion';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 2;
        $pista->foto = 'imagenes/fernannunezP.jpg';
        $pista->descripcion = 'descripcion';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 3;
        $pista->foto = 'imagenes/lucena.jpg';
        $pista->descripcion = 'descripcion';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 3;
        $pista->nPista = '2';
        $pista->foto = 'imagenes/lucenaP.jpg';
        $pista->descripcion = 'descripcion';
        $pista->save();

    }

    private function seedMensajes()
    {
        DB::table('mensajes')->delete();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Primer mensaje de prueba';
        $mensaje->user_id = 1;
        $mensaje->complejo_id = 1;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Primer mensaje de prueba';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 1;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Segundo mensaje de prueba';
        $mensaje->user_id = 1;
        $mensaje->complejo_id = 2;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Segundo mensaje de prueba';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 2;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Tercer mensaje de prueba';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 3;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Tercer mensaje de prueba';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 3;
        $mensaje->save();

    }

    private function seedContactas()
    {

        DB::table('contactas')->delete();

        $contacta = new Contacta();
        $contacta->correo = 'a@a.com';
        $contacta->contenido = 'Ejemplo de mensaje desde contacta';
        $contacta->save();

        $contacta = new Contacta();
        $contacta->correo = 'b@b.com';
        $contacta->contenido = 'Segundo ejemplo de mensaje desde contacta';
        $contacta->save();

    }

    private function seedChats()
    {
        DB::table('chats')->delete();

        $mensaje = new Chat();
        $mensaje->contenido = 'Primer chat de prueba';
        $mensaje->user_id = 2;
        $mensaje->admin = 1;
        $mensaje->save();

        $mensaje = new Chat();
        $mensaje->contenido = 'Primer chat de prueba para el admin';
        $mensaje->user_id = 2;
        $mensaje->admin = 0;
        $mensaje->save();

        $mensaje = new Chat();
        $mensaje->contenido = 'Segundo chat de prueba';
        $mensaje->user_id = 2;
        $mensaje->admin = 1;
        $mensaje->save();

        $mensaje = new Chat();
        $mensaje->contenido = 'Segundo chat de prueba para el admin';
        $mensaje->user_id = 2;
        $mensaje->admin = 0;
        $mensaje->save();


    }

}
