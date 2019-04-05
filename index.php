
<?php

/*
 * Material utilizado para as aulas práticas da disciplinas da Faculdade de
 * Computação da Universidade Federal de Mato Grosso do Sul (FACOM / UFMS).
 * Seu uso é permitido para fins apenas acadêmicos, todavia mantendo a
 * referência de autoria.
 *
 *
 *
 * Instancia a classe controladora.
 *
 * @author Jane Eleutério 
 * @version 2.0 - 19/Dez/2016
 */

error_reporting(E_ALL);
require_once 'Controller/controle.php';

$controller = new Controller();

$controller->init();
