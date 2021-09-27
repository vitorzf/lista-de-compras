<?php
class Itens_model extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
	}

	public function salvar_item($item){

		$dados = [
			"nome" => (string) trim($item["nome"]),
			"valor" => (float) $item['valor']
		];

		if($this->db->insert("itens", $dados)){
			$id = $this->db->insert_id();

			return $this->buscar_item($id);
		}else{
			return false;
		}

	}

	public function buscar_item($id){

		return $this->db->query("SELECT id, nome, valor FROM itens WHERE id = ?", [$id])->row();

	}

	public function listar_itens(){

		$itens = $this->db->query("SELECT nome, valor FROM itens")->result();

		if(empty($itens)){
			return false;
		}

		$retorno = [];
		$valor_total = 0;

		foreach($itens as $item){
			$retorno["itens"][] = $item->nome;
			$valor_total += $item->valor;
		}

		$retorno["total_value"] = $valor_total;

		return $retorno;
		

	}

	public function alterar_item($id, $item){

		$alterar = $this->db->update("itens", $item, ["id" => $id]);

		if(!$alterar){
			return false;
		}else{

			return $this->buscar_item($id);

		}

	}

	public function remover_item($id){

		return $this->db->delete("itens", ["id" => $id]);

	}

}
