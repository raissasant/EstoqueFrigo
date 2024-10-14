<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ResertSenhaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//http://127.0.0.1:8000 
//http://127.0.0.1:8000/login
//http://127.0.0.1:8000/admin #--Para salvar o admin que esta no AdminController --#
//http://127.0.0.1:8000/homeAdmin 
//http://127.0.0.1:8000/cadastro/user
//http://127.0.0.1:8000/login/usuario #-- Usuário fazer o login --#
//http://127.0.0.1:8000 
//http://127.0.0.1:8000/editar/fornecedor/{id}
//http://127.0.0.1:8000/cadastro/fornecedor
//http://127.0.0.1:8000/listagem/produto
//http://127.0.0.1:8000/cadastro/produto 
//http://127.0.0.1:8000


Route::get('/', function () {
    return view('welcome');
});

####################### //----- Rotas do Administrador ----\\ ####################

Route::get('/login',[AdminController::class, 'login'])->name('login'); # -- Login do admin --#
Route::get('/admin',[AdminController::class, 'store'])->name('admin'); #--Para salvar o admin --#
Route::post('/logando',[AdminController::class, 'loginUpdate'])->name('logando');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');


//----Página Home do Administrador-----\\\
Route::get('/homeAdmin',[AdminController::class, 'index'])->name('homeAdmin');

##########################- Rota de Resert Password #################################

# --- Resert senha do Administrador e Usuário ------#
Route::get('/nova/senha', [ResertSenhaController::class, 'NovaSenha'])->name('senha');
Route::post('/enviando',[ResertSenhaController::class, 'PedirSenha'])->name('enviandoSenha');
//- Fim da rota Resert Senha do Administrador e Usuário --\\
############################################################################################



###################### //----- Rotas do usuario ----\\ ####################################
//--Login  e logout do usuário --\\
Route::get('/login/usuario', [UsuarioController::class, 'loginUser'])->name('login-user');
Route::post('/logando/usuario', [UsuarioController::class, 'logandoUser'])->name('logandoUser');
Route::post('logout/usuario',[UsuarioController::class, 'logout'])->name('logoutUser');
//-- Fim --//



// -- CRUD do Usuário --\\
Route::get('/cadastro/user',[UsuarioController::class, 'index'])->name('cadastro/user');
Route::post('/cadastrando/user',[UsuarioController::class, 'store'])->name('cadastrando/user');
Route::get('/listagem/user',[UsuarioController::class, 'listagemUser'])->name('listagem/user');
Route::get('/editar/user/{id}', [UsuarioController::class, 'editUsuario'])->name('editar.usuario');
Route::post('/atualizar/user/{id}', [UsuarioController::class, 'atualizarUsuario'])->name('atualizar.usuario');
Route::get('/deletar/user/{id}', [UsuarioController::class, 'destroy'])->name('deletar.usuario');
// --Fim do  CRUD do Usuário --\\


// ---- Tela home do usuário ---\\
Route::get('/home/usuario',[UsuarioController::class, 'homeUsuario'])->name('homeUsuario');


# ----- Fornecedores ------- #
Route::get('cadastro/fornecedor', [FornecedorController::class, 'indexFornecedor'])->name('indexFornecedor');
Route::post('cadastrando/fornecedor',[FornecedorController::class, 'storeFornecedor'])->name('storeFornecedor');
Route::get('/listagem/fornecedor',[FornecedorController::class, 'listagemFornecedor'])-> name('listagemFornecedor');
Route::get('editar/fornecedor/{id}',[FornecedorController::class, 'EditFornecedor'])->name('EditFornecedor');
Route::post('editando/fornecedor/{id}',[FornecedorController::class, 'AtualizandoFornecedor'])->name('AtualizandoFornecedor');
// --- Pesquisar fornecedores
Route::get('fornecedores/search', [FornecedorController::class, 'searchFornecedores'])->name('searchFornecedores');

Route::get('/deletar/fornecedor/{id}',[FornecedorController::class, 'DeleteFornecedor'])->name('DeleteFornecedor');

///-- Produtos --\\

Route::get('/cadastro/produto',[ProdutoController::class, 'TelaProduto'])->name('cadastroProduto');
Route::post('/cadastrando/produto',[ProdutoController::class, 'storeProduto'])->name('storeProduto');
Route::get('/listagem/produto',[ProdutoController::class, 'ListagemProduto'])->name('ListagemProduto');
Route::get('/atualizar/produto/{id}',[ProdutoController::class, 'editProduto'])->name('editProduto');
Route::post('editando/produto/{id}',[ProdutoController::class, 'AtualizandoProduto'])->name('atualizandoProduto');
Route::delete('/produtos/{id}', [ProdutoController::class, 'deleteProduto'])->name('deleteProduto');
Route::get('/produto/search', [ProdutoController::class, 'SearchProduto'])->name('SearchProduto');