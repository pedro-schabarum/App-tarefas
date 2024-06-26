<?php

require "../../app_lista_tarefas/tarefa.model.php";
require "../../app_lista_tarefas/tarefa.service.php";
require "../../app_lista_tarefas/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if($acao =='inserir'){

    //cria nova tarefa
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);
    //cria um instância de conexao
    $conexao = new Conexao();

    //insere os dados na classe
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    header('Location: nova_tarefa.php?inclusao=1');

}else if($acao == 'recuperar'){

    $tarefa = new Tarefa();
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $listaTarefas = $tarefaService->recuperar();

}else if($acao == 'atualizar'){

    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa'])->__set('id', $_POST['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    if($tarefaService->atualizar()){
        header('location: todas_tarefas.php');
    }

}else if($acao == 'remover'){

    
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
   
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();
    header('location: todas_tarefas.php');

}else if($acao == 'marcarRealizada'){

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();

    header('location: todas_tarefas.php');

}else if($acao == 'recuperarTarefasPendentes'){

    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $listaTarefas = $tarefaService->recuperarTarefasPendentes();

}
