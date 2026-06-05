<?php

abstract class Persona
{
    protected ?int $ci;
    protected ?string $nombre;
    protected ?string $contraseña;
    protected ?string $estado;

    public function __construct(?int $ci = null, ?string $nombre = null, ?string $contraseña = null, ?string $estado = null)
    {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
        $this->estado = $estado;
    }

    public function validarLogin(){
        
    }
}