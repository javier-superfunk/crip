@component('mail::mensaje')
# ¡Hola, {{ $usuario->name }}!

![Bienvenido]({{ asset('assets/img/mails/bienvenida.png') }})
> Ir juntos, es **comenzar**, mantenerse juntos, es **progresar**, trabajar juntos, es **triunfar**.  — Henry Ford.

\
Nos sentimos muy felices de que te te sumes a esta familia, juntos somos mucho mas fuertes.

Pronto recibirás un correo de activación de tu cuenta, debes activarla con la clave temporal, y luego cambiarla.

Usuario para ingreso al sistema: **{{ $usuario->email }}**

Clave temporal: **{{ $password }}**

\
&nbsp;
***
@endcomponent
