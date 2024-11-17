<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ArmazemController;
use App\Http\Controllers\ResertSenhaController;
use App\Http\Controllers\MovimentacaoController;

############################## Rotas Públicas ##############################
Route::get('/', function () {
    return view('welcome'); // Página inicial pública
});

######################### Rotas de Autenticação ############################
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Exibe o formulário de login
Route::post('/logando', [LoginController::class, 'login'])->name('logando'); // Processa o login para ambos (admin e usuários)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout unificado para ambos

########################### Rotas de Recuperação de Senha ##########################
Route::get('/nova/senha', [ResertSenhaController::class, 'NovaSenha'])->name('senha'); // Exibe o formulário para redefinir senha
Route::post('/enviando', [ResertSenhaController::class, 'PedirSenha'])->name('enviandoSenha'); // Processa o envio do e-mail de redefinição de senha

########################### Rotas do Administrador ##########################
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('homeAdmin'); // Painel de controle do administrador

    // -- CRUD do Usuário --\\
    Route::get('/cadastro/user', [UsuarioController::class, 'index'])->name('cadastro/user');
    Route::post('/cadastrando/user', [UsuarioController::class, 'store'])->name('cadastrando/user');
    Route::get('/listagem/user', [UsuarioController::class, 'listagemUser'])->name('listagem/user');
    Route::get('/editar/user/{id}', [UsuarioController::class, 'editUsuario'])->name('editar.usuario');
    Route::post('/atualizar/user/{id}', [UsuarioController::class, 'atualizarUsuario'])->name('atualizar.usuario');
    Route::get('/deletar/user/{id}', [UsuarioController::class, 'destroy'])->name('deletar.usuario');
    // -- Fim do CRUD do Usuário --\\

    # -- CRUD de Fornecedores (somente administradores) -- #
    Route::get('/cadastro/fornecedor', [FornecedorController::class, 'indexFornecedor'])->name('indexFornecedor');
    Route::post('/cadastrando/fornecedor', [FornecedorController::class, 'storeFornecedor'])->name('storeFornecedor');
    Route::get('/editar/fornecedor/{id}', [FornecedorController::class, 'EditFornecedor'])->name('EditFornecedor');
    Route::post('/editando/fornecedor/{id}', [FornecedorController::class, 'AtualizandoFornecedor'])->name('atualizandoFornecedor');
    Route::delete('/deletar/fornecedor/{id}', [FornecedorController::class, 'DeleteFornecedor'])->name('deleteFornecedor');
});

########################### Rotas Compartilhadas entre Administrador e Usuário Comum ##########################
Route::middleware(['auth'])->group(function () {
    // Rotas para CRUD de Produtos
    Route::get('/cadastro/produto', [ProdutoController::class, 'TelaProduto'])->name('cadastroProduto');
    Route::post('/cadastrando/produto', [ProdutoController::class, 'storeProduto'])->name('storeProduto');
    Route::get('/listagem/produto', [ProdutoController::class, 'listagemProduto'])->name('ListagemProduto');
    Route::get('/atualizar/produto/{id}', [ProdutoController::class, 'editProduto'])->name('editProduto');
    Route::post('/editando/produto/{id}', [ProdutoController::class, 'atualizandoProduto'])->name('atualizandoProduto');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'deleteProduto'])->name('deleteProduto');
    Route::get('/produto/search', [ProdutoController::class, 'SearchProduto'])->name('SearchProduto');
    // Endpoint para obter os dados atualizados de um produto
    Route::get('/produto/{id}/atualizado', [ProdutoController::class, 'getProdutoAtualizado'])->name('produtoAtualizado');

    // Rotas para CRUD de Armazéns
    Route::get('/cadastro/armazem', [ArmazemController::class, 'TelaArmazem'])->name('cadastroArmazem');
    Route::post('/cadastrando/armazem', [ArmazemController::class, 'storeArmazem'])->name('storeArmazem');
    Route::get('/armazens', [ArmazemController::class, 'ListagemArmazem'])->name('ListagemArmazem');
    Route::get('/atualizar/armazem/{id}', [ArmazemController::class, 'editArmazem'])->name('editArmazem');
    Route::post('/editando/armazem/{id}', [ArmazemController::class, 'AtualizandoArmazem'])->name('atualizandoArmazem');
    Route::delete('/delete/armazem/{id}', [ArmazemController::class, 'deleteArmazem'])->name('deleteArmazem');

    // Movimentação de Produtos
    Route::get('/cadastro/movimentacao/{id}', [MovimentacaoController::class, 'TelaMovimentacao'])->name('TelaMovimentacao');
    Route::post('/cadastrando/movimentacao', [MovimentacaoController::class, 'CadastrandoMovimentacao'])->name('CadastrandoMovimentacao');
    Route::get('/consulta/estoque', [MovimentacaoController::class, 'ConsultaEstoque'])->name('ConsultaEstoque');
    Route::get('/listagem/movimentacao', [MovimentacaoController::class, 'ListagemMovimentacao'])->name('ListagemMovimentacao');
    Route::get('/atualizar/movimentacao/{id}', [MovimentacaoController::class, 'editMovimentacao'])->name('editMovimentacao');
    Route::post('editando/movimentacao/{id}', [MovimentacaoController::class, 'AtualizandoMovimentacao'])->name('atualizandoMovimentacao');
    Route::delete('delete/movimentacao/{id}', [MovimentacaoController::class, 'deleteMovimentacao'])->name('deleteMovimentacao');

    
    // Listagem e Pesquisa de Fornecedores
    Route::get('/listagem/fornecedor', [FornecedorController::class, 'listagemFornecedor'])->name('listagemFornecedor');
    Route::get('/fornecedores/search', [FornecedorController::class, 'searchFornecedores'])->name('searchFornecedores');
});

########################### Rotas do Usuário Comum ##########################
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UsuarioController::class, 'homeUsuario'])->name('homeUsuario');
});
