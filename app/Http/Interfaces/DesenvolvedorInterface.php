<?php

namespace App\Http\Interfaces;

interface DesenvolvedorInterface{
    
    function index($params);

    function store($nivel);

    function show($id);

    function update($nivel, $id);

    function destroy($id);
}