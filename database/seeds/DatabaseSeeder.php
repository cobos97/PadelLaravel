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
        $usuario->name = 'Antonio';
        $usuario->apellidos = 'Cobos';
        $usuario->fecha_nac = '719513280';
        $usuario->email_verified_at = new DateTime();
        $usuario->password = Hash::make('1234567890');
        $usuario->save();

        $usuario = new User();
        $usuario->email = 'b@gmail.com';
        $usuario->name = 'Andrea';
        $usuario->apellidos = 'Sanchez';
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
        $complejo->descripcion = 'Complejo de acceso gratuito. Dispone de baños y duchas, aunque las duchas no siempre
         están disponibles. No hay servicio de barra.';
        $complejo->coorX = '37.439475';
        $complejo->coorY = '-4.604238';
        $complejo->save();

        $complejo = new Complejo();
        $complejo->lugar = 'FernanNuñez';
        $complejo->direccion = 'Carretera la Rambla';
        $complejo->foto = 'imagenes/fernannunez.jpg';
        $complejo->descripcion = 'En FernanNuñez el acceso es gratuito, aunque tienen prioridad los miembros del
         club. Se pueden utilizar los baños del pabellon que se encuentran justo a la entrada del complejo y tienen
          duchas. No dispone de servicio de barra.';
        $complejo->coorX = '37.665880';
        $complejo->coorY = '-4.727652';
        $complejo->save();

        $complejo = new Complejo();
        $complejo->lugar = 'Lucena';
        $complejo->direccion = 'Calle del Deporte';
        $complejo->foto = 'imagenes/lucena.png';
        $complejo->descripcion = 'La entrada en este complejo no es gratuita. Los baños si desponen de duchas. Este
         complejo no dispone de servicio de barra pero si encontramos máquinas expendedoras en la entrada.';
        $complejo->coorX = '37.407894';
        $complejo->coorY = '-4.473263';
        $complejo->save();

        $complejo = new Complejo();
        $complejo->lugar = 'Monturque';
        $complejo->direccion = 'Calle de los Reyes Católicos';
        $complejo->foto = 'imagenes/complejo_monturk.PNG';
        $complejo->descripcion = 'La entrada en este complejo no es gratuita, pero el precio es simbólico. Los baños si
         desponen de duchas. También dispone de servicio de barra.';
        $complejo->coorX = '37.466635';
        $complejo->coorY = '-4.579129';
        $complejo->save();

    }

    private function seedPistas()
    {
        DB::table('pistas')->delete();

        $pista = new Pista();
        $pista->complejo_id = 1;
        $pista->foto = 'imagenes/moriles.jpg';
        $pista->descripcion = 'Cesped de color verde, con las paredes de metacrilato y mas arena de la media. La pista tiene apenas 1 año y esta en perfectas condiciones.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 2;
        $pista->foto = 'imagenes/fernannunezP.jpg';
        $pista->descripcion = 'Cesped de color verde, con las paredes de metacrilato. Ambas pistas son idénticas.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 2;
        $pista->foto = 'imagenes/fernannunezP.jpg';
        $pista->descripcion = 'Cesped de color verde, con las paredes de metacrilato. Ambas pistas son idénticas.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 3;
        $pista->foto = 'imagenes/lucena.jpg';
        $pista->descripcion = 'Cesped de color azul, con paredes de metacrilato. Esta pista esta situada a un lado
         del complejo, por lo que las bolas que se cuelen entre paredes se dan por perdidas.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 3;
        $pista->nPista = '2';
        $pista->foto = 'imagenes/lucenaP.jpg';
        $pista->descripcion = 'Cesped de color rojo, con paredes de metacrilato. Esta pista esta situada en la parte
         central del complejo.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 3;
        $pista->nPista = '3';
        $pista->foto = 'imagenes/lucenaP.jpg';
        $pista->descripcion = 'Cesped de color azul, con paredes de metacrilato. Esta pista esta situada a un lado
         del complejo, por lo que las bolas que se cuelen entre paredes se dan por perdidas.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 4;
        $pista->foto = 'imagenes/pista_1_monturk.jpg';
        $pista->descripcion = 'Cesped de color azul, con paredes de metacrilato. Cesped renovado justo antes del 
        confinamiento, por lo que apenas ha sido estrenado.';
        $pista->save();

        $pista = new Pista();
        $pista->complejo_id = 4;
        $pista->nPista = '2';
        $pista->foto = 'imagenes/pista_2_monturk.jpg';
        $pista->descripcion = 'Cesped de color verde, con paredes de metacrilato. Cesped en bastante mal estado
         porque tiene mucho tiempo y esta muy gastado, esto ayuda a que la bola salga mucho más.';
        $pista->save();

    }

    private function seedMensajes()
    {
        DB::table('mensajes')->delete();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Buenos días, nos falta uno para esta tarde a las 17:00';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 2;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Me apunto, contad conmigo';
        $mensaje->user_id = 3;
        $mensaje->complejo_id = 2;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = '¿Alguien se olvido ayer una sudadera en la pista?';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 1;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Si Antonio, es mía. Guardamela por favor, y gracias';
        $mensaje->user_id = 3;
        $mensaje->complejo_id = 1;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Me comentan en Lucena que se va a organizar un torneo pronto. Para apuntaros solo
         teneis que hablar con el chico de la entrada.';
        $mensaje->user_id = 1;
        $mensaje->complejo_id = 3;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Graciaaas';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 3;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = 'Gracias';
        $mensaje->user_id = 3;
        $mensaje->complejo_id = 3;
        $mensaje->save();

        $mensaje = new Mensaje();
        $mensaje->contenido = '¿Quién se apunta a estrenar la pista nueva?';
        $mensaje->user_id = 2;
        $mensaje->complejo_id = 4;
        $mensaje->save();

    }

    private function seedContactas()
    {

        DB::table('contactas')->delete();

        $contacta = new Contacta();
        $contacta->correo = 'a@a.com';
        $contacta->contenido = 'Hola, me registre hace unos días y no me llega el mensaje de confirmación de correo. 
        ¿Podrían cambiarme el correo dwdw@gmail.com al que les envio ahora en el mensaje?';
        $contacta->save();

        $contacta = new Contacta();
        $contacta->correo = 'b@b.com';
        $contacta->contenido = 'SOy nuevo con los ordenadores. ¿Cçomo podría registrarme en su página?';
        $contacta->save();

    }

    private function seedChats()
    {
        DB::table('chats')->delete();

        $mensaje = new Chat();
        $mensaje->contenido = 'Me comentan en Moriles que dejasteis basura tirada por el suelo la última vez,
         a la próxima me veré obligado a penalizarte pues eras el responsable en ese momento';
        $mensaje->user_id = 2;
        $mensaje->admin = 1;
        $mensaje->save();

        $mensaje = new Chat();
        $mensaje->contenido = 'Perdón, no volverá a pasar';
        $mensaje->user_id = 2;
        $mensaje->admin = 0;
        $mensaje->save();

        $mensaje = new Chat();
        $mensaje->contenido = 'Hola admin, me gustaría saber cuando introducirán los demás complejos de Lucena';
        $mensaje->user_id = 3;
        $mensaje->admin = 0;
        $mensaje->save();

        $mensaje = new Chat();
        $mensaje->contenido = 'Estamos hablando con ellos para ponernos de acuerdo';
        $mensaje->user_id = 3;
        $mensaje->admin = 1;
        $mensaje->save();


    }

}
