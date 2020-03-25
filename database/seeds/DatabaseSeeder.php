<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pista;
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
        self::seedPistas();
        self::seedMensajes();
        self::seedContactas();
    }

    private function seedUsers(){
        DB::table('users')->delete();

        $usuario = new User();
        $usuario->email = 'cobosmdc@gmail.com';
        $usuario->name = 'admin';
        $usuario->apellidos = 'admin';
        $usuario->edad = 22;
        $usuario->rol = 'admin';
        $usuario->email_verified_at = new DateTime();
        $usuario->password = Hash::make('1234567890');
        $usuario->save();

        $usuario = new User();
        $usuario->email = 'a@gmail.com';
        $usuario->name = 'a';
        $usuario->apellidos = 'a';
        $usuario->edad = 22;
        $usuario->email_verified_at = new DateTime();
        $usuario->password = Hash::make('1234567890');
        $usuario->save();

    }

    private function seedPistas(){
        DB::table('pistas')->delete();

        $pista = new Pista();
        $pista->lugar = 'Moriles';
        $pista->foto = 'imagenes/moriles.jpg';
        $pista->descripcion = 'descripcion';
        $pista->coorX = '123';
        $pista->coorY = '123';
        $pista->save();

        $pista = new Pista();
        $pista->lugar = 'FernanNuñez';
        $pista->foto = 'imagenes/fernannunez.jpg';
        $pista->descripcion = 'descripcion';
        $pista->coorX = '37.44';
        $pista->coorY = '-4.60';
        $pista->save();

    }

    private function seedMensajes(){
        DB::table('mensajes')->delete();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Primer mensaje de prueba';
        $mensaje->user_id = 1;
        $mensaje->pista_id = 1;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Segundo mensaje de prueba';
        $mensaje->user_id = 1;
        $mensaje->pista_id = 2;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Tercer mensaje de prueba';
        $mensaje->user_id = 2;
        $mensaje->pista_id = 2;
        $mensaje->save();

    }

    private function seedContactas(){

        DB::table('contactas')->delete();

        $contacta = new Contacta();
        $contacta->correo = 'a@a.com';
        $contacta->contenido = 'Ejemplo de mensaje desde contacta';
        $contacta->save();

    }

}
