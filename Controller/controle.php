<?php

 
/*
 * Material utilizado para as aulas práticas da disciplinas da Faculdade de
 * Computação da Universidade Federal de Mato Grosso do Sul (FACOM / UFMS).
 * Seu uso é permitido para fins apenas acadêmicos, todavia mantendo a
 * referência de autoria.
 *
 *
 *
 * Classe controladora que define gerencia do fluxo da aplicação.
 *
 * @author Jane Eleutério 
 * @version 2.0 - 19/Dez/2016
 */


class Controller {

    private $factory;

    public function __construct() {

        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
    }

    public function init() {

        if (isset($_GET['op'])) {
            $op = $_GET['op'];
        } else {
            $op = "";
        }

        switch ($op) {
            case 'tutorial':
                $this->tutorial();
                break;
            case 'cadastra':
                $this->cadastra();
                break;
            case 'lista':
                $this->lista();
                break;
            case 'out':
                $this->out();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index() {
        require 'View/index.php';
    }

    public function tutorial() {
        require 'View/tutorial.php';
    }

    public function cadastra() {
        if (isset($_POST['submit'])) {

            $nome = $_POST['nome'];
            $datansc = $_POST['datansc'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $url = $_POST['homepage'];
            $sucesso = false;
            
            if($url == "" )
                $url = "Não possui";
            if($tel == "")
                $tel = "Não possui";
            
            try {
                if ($nome == "" || $email == "")
                    throw new Exception('Erro');

                $contato = new Contato($nome,$email,$datansc,$tel,$url);

                //consulta o e-mail no banco
                $result = $this->factory->buscar($email);

                // se o resultado for igual a 0 itens, então salva contato
                if (count($result) == 0) {
                    $sucesso = $this->factory->salvar($contato);
                }


                if ($sucesso) {
                    $msg = "<p>O contato " . $nome . " (" . $email . ") foi cadastrado com sucesso!</p>";
                } else if (!$sucesso && count($result) > 0) {
                    $msg = "<p>O contato n&atilde;o foi adicionado. E-mail j&aacute; existente na agenda!</p>";
                } else {
                    $msg = "<p>O contato n&atilde;o foi adicionado. Tente novamente mais tarde!</p>";
                }

                unset($nome);
                unset($email);
                unset($datansc);
                unset($tel);
                unset($url);


                require 'View/mensagem.php';
            } catch (Exception $e) {
                if ($nome == "") {
                    $msg = "O campo <strong>Nome</strong> deve ser preenchido!";
                } else if ($email == "") {
                    $msg = "O campo <strong>E-mail</strong> deve ser preenchido!";
                }
                require 'View/mensagem.php';
            }
        }
    }

    public function lista() {

        $result = $this->factory->listar();
        require 'View/lista.php';
    }

    public function out() {
        

        require 'View/index.php';
    }

}

?>