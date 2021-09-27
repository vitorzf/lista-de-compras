<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . "libraries/Format.php";
require APPPATH . 'libraries/RestController.php';

class ItensController extends RestController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Itens_model', 'itens');
    }

	private function valida_parametros($parametros, $obrigatorios, $pos = -1){

		$vazios = [];

		foreach($obrigatorios as $attr){

			if(empty($parametros[$attr])){
				$vazios[] = $attr;
			}else{
				unset($parametros[$attr]);
			}

		}

		if(!empty($vazios)){
			$this->response([
                'message' => "Os seguintes campos estão faltando: " . implode(", ", $vazios)
            ], RestController::HTTP_BAD_REQUEST);
		}else{

			if(!empty($parametros)){
				$this->response([
					'message' => "Parâmetros extras encontrados: " . implode(", ", array_keys($parametros))
				], RestController::HTTP_BAD_REQUEST);
			}
	
			return true;
		}

	}

	public function index_post()
	{

		$obrigatorio = [
			"nome",
			"valor"
		];
		
		$dados = $this->post();

		$this->valida_parametros($dados, $obrigatorio);

		$salvo = $this->itens->salvar_item($dados);
	
		if(!$salvo){
			$this->response([
                'message' => 'Erro ao salvar itens no carrinho'
            ], RestController::HTTP_INTERNAL_ERROR);
		}else{
			$this->response($salvo, RestController::HTTP_OK);
		}

	}

	public function listarItens_get(){
		
		$itens = $this->itens->listar_itens();

		if(!$itens){
			$this->response([
                'message' => 'Nenhum item encontrado'
            ], RestController::HTTP_NOT_FOUND);
		}else{
			$this->response($itens, RestController::HTTP_OK);
		}

	}

	public function listarItem_get($id = 0){

		if($id == 0){
			$this->response([
                'message' => 'ID do item não enviado'
            ], RestController::HTTP_BAD_REQUEST);
		}

		$item = $this->itens->buscar_item($id);

		if(!$item){
			$this->response([
                'message' => 'Item não encontrado'
            ], RestController::HTTP_NOT_FOUND);
		}else{
			$this->response($item, RestController::HTTP_OK);
		}

	}

	public function alterarItem_put($id = 0)
	{

		if($id == 0){
			$this->response([
                'message' => 'ID do item não enviado'
            ], RestController::HTTP_BAD_REQUEST);
		}

		$item = $this->itens->buscar_item($id);

		if(!$item){
			$this->response([
                'message' => 'Item não encontrado'
            ], RestController::HTTP_NOT_FOUND);
		}

		$obrigatorio = [
			"nome",
			"valor"
		];
		
		$dados = $this->put();

		$this->valida_parametros($dados, $obrigatorio);

		$salvo = $this->itens->alterar_item($id, $dados);
	
		if(!$salvo){
			$this->response([
                'message' => 'Erro ao alterar item'
            ], RestController::HTTP_INTERNAL_ERROR);
		}else{
			$this->response($salvo, RestController::HTTP_OK);
		}

	}

	public function removerItem_delete($id = 0){

		if($id == 0){
			$this->response([
                'message' => 'ID do item não enviado'
            ], RestController::HTTP_BAD_REQUEST);
		}

		$item = $this->itens->buscar_item($id);

		if(!$item){
			$this->response([
                'message' => 'Item não encontrado'
            ], RestController::HTTP_NOT_FOUND);
		}

		$removeu = $this->itens->remover_item($id);

		if($removeu){
			$this->response(null, RestController::HTTP_OK);
		}else{
			$this->response(null, RestController::HTTP_INTERNAL_ERROR);
		}

	}

}
