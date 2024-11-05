<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ArmazemController;
use App\Http\Controllers\ResertSenhaController; // Controlador para redefinição de senha
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
Route::get('/cadastro/user',[UsuarioController::class, 'index'])->name('cadastro/user');
Route::post('/cadastrando/user',[UsuarioController::class, 'store'])->name('cadastrando/user');
Route::get('/listagem/user',[UsuarioController::class, 'listagemUser'])->name('listagem/user');
Route::get('/editar/user/{id}', [UsuarioController::class, 'editUsuario'])->name('editar.usuario');
Route::post('/atualizar/user/{id}', [UsuarioController::class, 'atualizarUsuario'])->name('atualizar.usuario');
Route::get('/deletar/user/{id}', [UsuarioController::class, 'destroy'])->name('deletar.usuario');
// --Fim do  CRUD do Usuário --\\
    # -- CRUD de Fornecedores (somente administradores) -- #
    Route::get('/cadastro/fornecedor', [FornecedorController::class, 'indexFornecedor'])->name('indexFornecedor'); // Exibe o formulário de cadastro de fornecedor
    Route::post('/cadastrando/fornecedor', [FornecedorController::class, 'storeFornecedor'])->name('storeFornecedor'); // Processa o cadastro de fornecedor
    Route::get('/listagem/fornecedor', [FornecedorController::class, 'listagemFornecedor'])->name('listagemFornecedor'); // Lista todos os fornecedores
    Route::get('/editar/fornecedor/{id}', [FornecedorController::class, 'EditFornecedor'])->name('EditFornecedor'); // Exibe o formulário de edição de fornecedor
    Route::post('/editando/fornecedor/{id}', [FornecedorController::class, 'AtualizandoFornecedor'])->name('atualizandoFornecedor'); // Processa a atualização de fornecedor
    Route::delete('/deletar/fornecedor/{id}', [FornecedorController::class, 'DeleteFornecedor'])->name('deleteFornecedor'); // Exclui um fornecedor
    Route::get('/fornecedores/search', [FornecedorController::class, 'searchFornecedores'])->name('searchFornecedores'); // Busca fornecedores
});

########################### Rotas Compartilhadas entre Administrador e Usuário Comum ##########################
// Rotas para CRUD de Produtos
Route::middleware(['auth'])->group(function () {
    Route::get('/cadastro/produto', [ProdutoController::class, 'TelaProduto'])->name('cadastroProduto'); // Exibe o formulário de cadastro de produto
    Route::post('/cadastrando/produto', [ProdutoController::class, 'storeProduto'])->name('storeProduto'); // Processa o cadastro de produto
    Route::get('/listagem/produto', [ProdutoController::class, 'listagemProduto'])->name('ListagemProduto'); // Lista todos os produtos
    Route::get('/atualizar/produto/{id}', [ProdutoController::class, 'editProduto'])->name('editProduto'); // Exibe o formulário de edição de produto
    Route::post('/editando/produto/{id}', [ProdutoController::class, 'atualizandoProduto'])->name('atualizandoProduto'); // Processa a atualização de produto
    Route::delete('/produtos/{id}', [ProdutoController::class, 'deleteProduto'])->name('deleteProduto'); // Exclui um produto
    Route::get('/produto/search', [ProdutoController::class, 'SearchProduto'])->name('SearchProduto'); // Busca produtos
});

// Rotas para CRUD de Armazéns
Route::middleware(['auth'])->group(function () {
    Route::get('/cadastro/armazem', [ArmazemController::class, 'TelaArmazem'])->name('cadastroArmazem'); // Exibe o formulário de cadastro de armazém
    Route::post('/cadastrando/armazem', [ArmazemController::class, 'storeArmazem'])->name('storeArmazem'); // Processa o cadastro de armazém
    Route::get('/armazens', [ArmazemController::class, 'ListagemArmazem'])->name('ListagemArmazem'); // Lista todos os armazéns
    Route::get('/atualizar/armazem/{id}', [ArmazemController::class, 'editArmazem'])->name('editArmazem'); // Exibe o formulário de edição de armazém
    Route::post('/editando/armazem/{id}', [ArmazemController::class, 'AtualizandoArmazem'])->name('atualizandoArmazem'); // Processa a atualização de armazém
    Route::delete('/delete/armazem/{id}', [ArmazemController::class, 'deleteArmazem'])->name('deleteArmazem'); // Exclui um armazém
});


/// -- Movimentação --\\
Route::middleware(['auth'])->group(function () {
Route::get('/cadastro/movimentação/{id}',[MovimentacaoController::class, 'TelaMovimentacao'])->name('TelaMovimentacao');
Route::post('/cadastrando/movimentação',[MovimentacaoController::class, 'CadastrandoMovimentacao'])->name('CadastrandoMovimentacao');
Route::get('/consulta/estoque', [MovimentacaoController::class, 'ConsultaEstoque'])->name('ConsultaEstoque');
Route::get('/listagem/movimentação',[MovimentacaoController::class, 'ListagemMovimentacao'])->name('ListagemMovimentacao');
Route::get('/atualizar/movimentação/{id}',[MovimentacaoController::class, 'editMovimentacao'])->name('editMovimentacao');
Route::post('editando/movimentação/{id}',[MovimentacaoController::class, 'AtualizandoMovimentacao'])->name('atualizandoMovimentacao');
Route::delete('delete/movimentação/{id}', [MovimentacaoController::class, 'deleteMovimentacao'])->name('deleteMovimentacao');
});

########################### Rotas do Usuário Comum (Somente o Dashboard) ##########################
Route::middleware(['auth'])->group(function () {
    # -- Tela home do usuário comum -- #
    Route::get('/home', [UsuarioController::class, 'homeUsuario'])->name('homeUsuario'); // Painel do usuário comum (tela protegida)
});

