<?php

interface IConstancia{
    public function obtenerCantidadAdeudo($idAlumno);
    public function obtenerPrestamosVigentes($idAlumno);
}